<?php
$tests = array();
foreach(array('Queue', 'Stack') as $class_name){
    require_once $class_name.'.php';
    $tests[$class_name] = new $class_name();
    $tests[$class_name] = $tests[$class_name]->test();
}
var_dump($tests);