<?php

namespace App\Helpers;

class LinkEditHelper
{
    /**
     * Вырезает из полной ссылки на группу ее название или ID
     *
     * @param string $groupUrl
     * @return string
     */
    static public function getGroupName(string $groupUrl): string
    {
        preg_match('#vk\.com/(.+)#', $groupUrl, $match);
        $groupPath = $match[1];

        if (preg_match('#(?:id|public)(\d+)#', $groupPath, $match)) {
            return $match[1];
        }

        return $groupPath;
    }
}
