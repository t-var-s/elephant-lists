<?php
class Queue{ // first elephant to arrive is the first to go, the next of tail is always null
    public $length;
    public $head;
    public $tail;
    function __construct(){
        $this->length = 0;
        $this->head = null;
        $this->tail = null;
    }
    function toArray(){
        $array = array();
        $current = $this->head;
        while($current !== null){
            array_push($array, $current['value']);
            $current = $current['next'];
        }
        return $array;
    }
    function createNode($value){
        return array( 'value' => $value, 'next' => null);
    }
    function peak(){
        return $this->head ? $this->head['value'] : null;
    }
    function enqueue($value){
        $node = $this->createNode($value);
        if($this->length === 0){
            $this->head = &$node;
            $this->tail = &$node;
            return $this->length++;
        }
        $this->tail['next'] = &$node;
        $this->tail = &$node;
        return $this->length++;
    }
    function dequeue(){
        if($this->length === 0){
            return null;
        }
        $current = $this->head;
        $this->head = $this->head['next'];
        $this->length--;
        return $current['value'];
    }
    function test(){
        if($this->length > 0 || $this->peak() !== null){ return false; }
        $array = array('alpha', 'beta', 'charlie', 'delta');
        foreach($array as $value){ $this->enqueue($value); }
        $matching_array = $this->toArray();
        if(array_shift($array) !== $this->dequeue()){ return false; }
        return count(array_diff($array, $matching_array)) === 0;
    }
}