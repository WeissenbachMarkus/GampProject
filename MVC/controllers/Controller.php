<?php

class Controller{
    
    private  $model;
    private  $view;
    
    
    public function __construct() {
       
        echo  $_GET['url'];
    }
    
    function load(){
        include $this->model.'.php';
        
    }
    
   
}

$c=new Controller();

