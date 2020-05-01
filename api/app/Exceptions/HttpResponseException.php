<?php

namespace App\Exceptions;

use Exception;

class HttpResponseException extends Exception
{
    public function render()
    {
        $messages = json_decode($this->getMessage());

        if (json_last_error() != JSON_ERROR_NONE) {
            $messages = [$this->getMessage()];
        }

        $content = ['messages' => $messages];

        return response()->json($content, $this->getCode());
    }
}
