<?php

namespace App\Exceptions;

use Exception;

class EmptyLinksListException extends Exception
{
    public function report()
    {

    }

    public function render()
    {
        return response()->view('errors.error', ['error_message' => 'Ты забыла записать ссылки'], 500);
    }
}
