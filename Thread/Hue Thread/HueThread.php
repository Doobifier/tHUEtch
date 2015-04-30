<?php

class HueThread extends Thread {

    private $_running;
    private $_command;

    public function __construct($command = null){
        $this->_running = false;
        $this->_command = $command;
    }

    public function setCommand($command){
        $this->_command = $command;
    }

    public function isRunning(){
        return $this->_running;
    }

    public function run(){
        $this->_running = true;
        echo $this->_command."\n";
        sleep(10);
        $this->_running = false;
    }

}