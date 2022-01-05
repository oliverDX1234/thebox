<?php
namespace App\Exceptions;


use Exception;
use Throwable;

class ApiException extends Exception
{
    protected $statusCode = 500;

    public function __construct($message, $statusCode, Throwable $previous = null)
    {
        parent::__construct($message, 0, $previous);
        $this->statusCode = $statusCode;
    }

    public function render()
    {
        return response()->api(null, $this->statusCode, $this->message);
    }

//    public function report()
//    {
////        TODO implement proper logging with extra information
////        Log::error("API Exception thrown:");
//    }
}
