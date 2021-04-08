<?php

namespace App\Validators;

use App\Exceptions\EmptyLinksListException;
use App\Exceptions\InvalidLinkException;

class LinksValidator
{
    public function validate(array $links): bool
    {
        if (empty($links[0])) {
            throw new EmptyLinksListException();
        }

        for ($i = 0; $i < count($links); $i++) {
            $reg = '#https://vk.com/.*#';

            if (preg_match($reg, $links[$i]) === 0) {
                throw new InvalidLinkException(linkNumber: $i + 1);
            }
        }

        return true;
    }
}
