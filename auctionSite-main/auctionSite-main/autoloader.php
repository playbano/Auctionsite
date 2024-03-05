<?php

spl_autoload_register(function ($class) {

    $path = str_replace ('\\ ', '/', $class ) . '.php';
    //Ersätt med Loop
    if (file_exists(__DIR__.DIRECTORY_SEPARATOR."controller".DIRECTORY_SEPARATOR.$path)) {
        include __DIR__.DIRECTORY_SEPARATOR."controller".DIRECTORY_SEPARATOR.$path;
    
    }

    else if (file_exists(__DIR__.DIRECTORY_SEPARATOR."dao".DIRECTORY_SEPARATOR.DIRECTORY_SEPARATOR.$path)) {
        include __DIR__.DIRECTORY_SEPARATOR."dao".DIRECTORY_SEPARATOR.DIRECTORY_SEPARATOR.$path;
    
    }

    else if (file_exists(__DIR__.DIRECTORY_SEPARATOR."model".DIRECTORY_SEPARATOR.$path)) {
        include __DIR__.DIRECTORY_SEPARATOR."model".DIRECTORY_SEPARATOR.$path;
    
    }
    
    else if (file_exists(__DIR__.DIRECTORY_SEPARATOR."model".DIRECTORY_SEPARATOR."entity".DIRECTORY_SEPARATOR. $path)) {
        include __DIR__.DIRECTORY_SEPARATOR."model".DIRECTORY_SEPARATOR."entity".DIRECTORY_SEPARATOR. $path;
    
    }

    else if (file_exists(__DIR__.DIRECTORY_SEPARATOR."model".DIRECTORY_SEPARATOR."service".DIRECTORY_SEPARATOR. $path)) {
        include __DIR__.DIRECTORY_SEPARATOR."model".DIRECTORY_SEPARATOR."service".DIRECTORY_SEPARATOR. $path;
    
    }

    else if (file_exists(__DIR__.DIRECTORY_SEPARATOR. $path)) {
        include __DIR__.DIRECTORY_SEPARATOR. $path;
    
    }
    
    else if (file_exists($path)) {
        include $path;
    }
    
    else {
        
        echo "Cant find: ".$path;
        
    }
    }

);

?>