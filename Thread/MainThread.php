<?php
include_once 'Properties/PropertyManager.php';
include_once 'Utils/LinkedList/LinkedList.php';
include_once 'Client Thread/ClientThread.php';
include_once 'Hue Thread/HueThread.php';

$properties = PropertyManager::getInstance();
$server     = stream_socket_server("tcp://127.0.0.1:1337", $errno, $errormsg);
if($server === false){
    throw new Exception("Could not bind to socket: {$errorMessage}");
}else{
    $live = true;
    $queue = new LinkedList();
    $hueThread = new HueThread();
    $clients = array();
    //TODO Add properties section for number of active listeners.
    for($i = 0; $i < 5; $i++){
        $clients[] = new ClientThread($server);
    }
    while($live){
        //check for property updates
        $properties->updates();
        //check if live condition has changed
        //TODO Add live update logic and clean up for thread termination
        foreach($clients as $client){
            /** @var $client ClientThread */
            //if the client is not running and not finished
            if(!$client->isRunning() && !$client->finished()){
                //run the client
                //socket timeout is 5 seconds
                $client->run();
            //if the client is complete
            }else if($client->finished()){
                //get the command sent
                $command = $client->getCommand();
                //not worried about a bad command, further validation will be needed.
                $queue->push($command);
            //if the client is not running and it is finished
            }else if(!$client->isRunning() && $client->finished()){
                //reallocate the client in this position
                //may not be necessary but will require testing
                $client = new ClientThread($server);
            }
        }
        //if the queue is not empty we get a command and run it.
        if($queue->length() != 0){
            $command = $queue->pop();
            $hueThread->setCommand($command);
            if(!$hueThread->isRunning()){
                $hueThread->run();
            }
        }
    }
}
