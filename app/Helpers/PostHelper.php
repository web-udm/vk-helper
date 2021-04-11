<?php

namespace App\Helpers;

use Hidehalo\Emoji\Parser;

class PostHelper
{
    public function calculateHashtags(string $text)
    {
        preg_match_all('/#\w+/u', $text, $matches);

        return $matches[0];
    }

    public function calculateEmojies(string $text)
    {
        $parser = new Parser();
        $emojies = $parser->parse($text);

        return $emojies !== false ? $emojies : [];
    }
}
