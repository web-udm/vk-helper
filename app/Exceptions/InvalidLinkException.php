<?php

namespace App\Exceptions;

use Exception;
use Throwable;

class InvalidLinkException extends Exception
{
    private int $linkNumber;

    public function __construct($linkNumber, $message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);

        $this->linkNumber = $linkNumber;
    }

    public function report()
    {

    }

    public function render()
    {
        return response()->view('errors.error', ['error_message' => "{$this->linkNumber}-я ссылка введена неверно"], 500);
    }
}
