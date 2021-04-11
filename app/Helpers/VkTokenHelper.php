<?php

namespace App\Helpers;

use App\Exceptions\TokenDiedException;

class VkTokenHelper
{
    static public function isTokenInSession(): bool
    {
        return session()->has('vk_token') ? true : throw new TokenDiedException();
    }
}
