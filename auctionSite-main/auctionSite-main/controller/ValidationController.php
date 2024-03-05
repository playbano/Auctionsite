<?php

class ValidationController
{
    private $exceptions = array();

    function __construct($exceptions = null)
    {
        $this->exceptions = $exceptions;
    }

    public function getExceptions() {
        return $this->exceptions;
    }

    //körs i controller
    public function setExceptions($exceptions) {
        $_SESSION['exceptions'] = $exceptions;
        $this->exceptions = $exceptions;
    }
    
    //Körs i view
    public function displayExceptions() {
        foreach ($_SESSION['exceptions'] as $e) {
                echo $e->getMessage() . '<br>';
            }
            unset($_SESSION['exceptions']);
    }
}


/*foreach ($exceptionCollect as $e) {
                echo $e->getMessage() . '<br>';
            }
            return false; */