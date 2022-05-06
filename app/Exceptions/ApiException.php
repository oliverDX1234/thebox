<?php

namespace App\Exceptions;

use Exception;
use Throwable;

class ApiException extends Exception
{
    private $statusCode;
    private $data;

    public function __construct($message = "generic_api_error", $statusCode = 500, $data = null, Throwable $previous = null)
    {
        parent::__construct($message, 0, $previous);
        $this->statusCode = $statusCode;

        if((int)$this->statusCode === 23000){
            $this->statusCode = 405;
            $this->message = "global.dependencies";
        }

        $this->data = $data;
    }

    public function render()
    {
        return response()->api($this->data, $this->message, $this->statusCode);
    }

//    public function report()
//    {
////        TODO implement proper logging with extra information
////        Log::error("API Exception thrown:");
//    }
}
