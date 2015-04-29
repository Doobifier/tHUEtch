<?php
include_once 'Properties/PropertyManager.php';
include_once 'Utils/LinkedList/LinkedList.php';

$properties = PropertyManager::getInstance();
$server     = stream_socket_server("tcp://127.0.0.1:1337", $errno, $errormsg);
$queue      = new LinkedList();
$thread     = new HueThread();
if($server === false){
    throw new Exception("Could not bind to socket: {$errorMessage}");
}else{
    $live = true;
    while($live){
        //listen for client connection
        $client = @stream_socket_accept($server);
        //if a connection exists
        if($client) {
            //check for property changes
            $properties->updates();
            //get command from client
            $command = stream_socket_recvfrom($client, 10);
            //close the client connection, leave server open
            fclose($client);
            //queue the command in case the thread is busy
            $queue->push($command);
            //if the thread is not running, run it
            if(!$thread->isRunning()){
                $thread->setCommand($queue->pop());
                $thread->run();
            }
        }

    }
}
