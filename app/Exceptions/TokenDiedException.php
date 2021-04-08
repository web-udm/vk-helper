<?php

namespace App\Exceptions;

use Exception;

class TokenDiedException extends Exception
{
    public function report()
    {

    }

    public function render()
    {
        return response()->view('errors.error', ['error_message' => 'Токен сдох'], 500);
    }
}
