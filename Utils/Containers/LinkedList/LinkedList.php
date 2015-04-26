<?php

include_once 'Node.php';

class LinkedList {

    /** @var  Node */
    private $_head;
    /** @var  Node */
    private $_current;
    /** @var  Node */
    private $_tail;
    private $_count;

    public function __construct(){
        $this->_head = null;
        $this->_current = null;
        $this->_tail= null;
        $this->_count = 0;
    }

    /**
     * @param $data
     *
     * Adds the $data to be added to the list (FIFO).
     */

    public function push($data){
        $node = new Node($data);
        if($this->_count == 0){
            //create first node
            $this->_head = $node;
            $this->_current = $this->_head;
            $this->_count++;
        }else{
            $this->_current->setNext($node);
            $this->_current = $node;
            $this->_count++;
        }
    }

    /**
     * @return mixed
     *
     * Returns the head nodes data (FIFO).
     */

    public function pop(){
        $delete = $this->_head;
        $data = $delete->getData();
        $this->_head = $delete->getNext();
        $this->_count--;
        $delete = null;
        return $data;
    }

    /**
     * @param $key int
     * @param $data mixed
     *
     * Inserts into the list at the $key - 1 position.
     */

    public function insert($key,$data){
        $this->traverse($key - 1);
        $node = new Node($data);
        if($key >= $this->length()){
            $this->_current->setNext($node);
            $this->_count++;
        }else{
            $nextNode = $this->_current->getNext();
            $node->setNext($nextNode);
            $this->_current->setNext($node);
            $this->_current = $nextNode;
            $this->_count++;
        }
    }

    /**
     * @param $key int
     *
     * Inserts into the list at the $key - 1 position.
     */

    public function delete($key){
        $this->traverse($key - 1);
        if($key <= $this->length()){
            /** @var  $delete Node */
            $delete = $this->_current->getNext();
            if($key == $this->length()){
                $delete = null;
                $this->_current->setNext(null);
                $this->_count--;
            }else{
                $postDelete = $delete->getNext();
                $this->_current->setNext($postDelete);
                $delete = null;
                $this->_count--;
            }
        }
    }

    /**
     * @param $key int
     *
     * Traverse the list to the $key value.
     */
    private function traverse($key){
        $this->_current = $this->_head;
        if($key <= $this->length()) {
            $i = 0;
            while ($i != $key) {
                $this->_current = $this->_current->getNext();
                $i++;
            }
        }
    }

    /**
     * A printing function for debugging.
     */

    public function debug(){
        $this->_current = $this->_head;
        for($i = 0; $i < $this->length(); $i++){
            $data = $this->_current->getData();
            if($this->_current->getNext() != null) {
                $this->_current = $this->_current->getNext();
            }
            echo "LinkedList[{$i}] => {$data}\n";
        }
    }

    /**
     * @return mixed
     *
     * Returns the size of the LinkedList.
     */

    public function length(){
        return $this->_count;
    }


}