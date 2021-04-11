<?php

namespace App\Exceptions;

use Exception;

class MillionPostsException extends Exception
{
    public function render()
    {
        $randomShibaImg = asset('img/jokes/') . '/siba_' . rand(1, 2) . ".gif";

        return response()->view('errors.joke', ['shibaImg' => $randomShibaImg], 500);
    }
}
