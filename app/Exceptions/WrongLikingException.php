<?php

namespace App\Exceptions;

use Exception;
use Throwable;

class WrongLikingException extends Exception
{
    private string $vkErrorMessage;

    public function __construct($vkErrorMessage, $message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);

        $this->vkErrorMessage = $vkErrorMessage;
    }

    public function report()
    {

    }

    public function render()
    {
        return response()->view('errors.error', ['error_message' => 'Что-то не то произошло во время лайкинга'], 500);
    }
}
