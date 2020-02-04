<?php

namespace App\Exceptions;

use Exception;

class HttpResponseException extends Exception
{
    public function render()
    {
        $content['messages'] = json_decode($this->getMessage());

        return response()->json($content, $this->getCode());
    }
}
