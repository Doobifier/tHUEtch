<?php

class ClientThread extends Thread {

    private $_running;
    private $_complete;
    private $_server;
    private $_data;

    public function __construct($server=null){
        $this->_running = false;
        $this->_complete = false;
        $this->_server = $server;
    }

    public function setServer($server){
        $this->_server = $server;
    }

    public function isRunning(){
        return $this->_running;
    }

    public function finished(){
        return $this->_complete;
    }

    public function getCommand(){
        return $this->_data;
    }

    public function run(){
        $this->_running = true;
        $client = @stream_socket_accept($this->_server);
        socket_set_timeout($client,5);
        $this->_data = stream_socket_recvfrom($client, 10);
        fclose($client);
        $this->_complete = true;
        return;
    }


}
