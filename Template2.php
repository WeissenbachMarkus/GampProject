<?php

class Template2 {

    private $template = '';
    private $leftDelim = '###';
    private $rightDelim = '###';
    private $templateDir = 'templates/';
    private $templateFile = '';

    public function load($name)
    {
        $this->templateFile=$this->templateDir.$name;
        if(file_exists($this->templateFile))
        {
            $this->template= file_get_contents($this->templateFile);
            
        }else
        {
            //todo: Exception Handling
            $this->template='';
            echo 'Ist nicht gut gegangen';
        }
        
      
        
    }
    
    public function assign($replace, $replaycment)
    {
       $this-> template=str_replace($this->leftDelim.$replace.$this->rightDelim, $replaycment, $this->template);
    }
    
    public function display()
    {
        echo $this->template;
    }
}
