<?php

namespace App\Http\Middleware;


use Illuminate\Foundation\Http\Middleware\TransformsRequest;

class StringifiedValues extends TransformsRequest
{
    /**
     * Transform the given value.
     *
     * @param  string  $key
     * @param  mixed  $value
     * @return mixed
     */
    protected function transform($key, $value)
    {
        if($value === 'null'){
            return null;
        }

        if($value === "true" || $value === "false"){
            return $value === "true";
        }

        return $value;
    }
}
