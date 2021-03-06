<?php

namespace App\Exceptions;

use Exception;

class IllegalArgumentException extends Exception
{
    
    
    public function __construct($message){
        $this->message = $message;
    }

    public function render(){
        return [
            'errors' => $this->message
        ];
    }

}
