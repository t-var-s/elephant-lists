<?php
class Stack{ // last elephant to arrive is the first to go, the next of head is always null
    public $length;
    public $head;
    function __construct(){
        $this->length = 0;
        $this->head = null;
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
    function push($value){
        $node = $this->createNode($value);
        if($this->length === 0){
            $this->head = &$node;
            return $this->length++;
        }
        $node['next'] = &$this->head;
        $this->head = &$node;
        return $this->length++;        
    }
    function pop(){
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
        $arriving_array = array('alpha', 'beta', 'charlie', 'delta');
        $stacked_array = array('delta', 'charlie', 'beta', 'alpha');
        foreach($arriving_array as $value){ $this->push($value); }
        if(array_shift($stacked_array) !== $this->pop()){ return false; }
        if($stacked_array[0] !== $this->peak()){ return false; }
        $matching_array = $this->toArray();
        return count(array_diff($stacked_array, $matching_array)) === 0;
    }
}