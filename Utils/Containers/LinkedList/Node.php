<?php

class Node {

    private $_data;
    private $_next;

    public function __construct($data){
        $this->_data = $data;
        $this->_next = null;
    }

    public function setNext($next){
        $this->_next = $next;
    }

    public function getNext(){
        return $this->_next;
    }

    public function getData(){
        return $this->_data;
    }
}