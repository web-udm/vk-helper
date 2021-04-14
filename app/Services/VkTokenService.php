<?php

namespace App\Services;

use Illuminate\Http\Request;
use VK\Client\VKApiClient;
use VK\OAuth\Scopes\VKOAuthUserScope;
use VK\OAuth\VKOAuth;
use VK\OAuth\VKOAuthDisplay;
use VK\OAuth\VKOAuthResponseType;

class VkTokenService
{
    public function getTokenOnProd() : string
    {
        $oauth = new VKOAuth();
        $client_id = 7751109;
        $redirect_uri = 'https://oauth.vk.com/blank.htm';
        $display = VKOAuthDisplay::PAGE;
        $scope = array(VKOAuthUserScope::WALL, VKOAuthUserScope::GROUPS);
        $state = 'POPldpjU2CoJj8MoDk2P';

        return $oauth->getAuthorizeUrl(VKOAuthResponseType::CODE, $client_id, $redirect_uri, $display, $scope, $state);
    }

    public function getTokenOnLocal() : string
    {
        $oauth = new VKOAuth();
        $client_id = 7511602;
        $redirect_uri = 'https://oauth.vk.com/blank.htm';
        $display = VKOAuthDisplay::PAGE;
        $scope = array(VKOAuthUserScope::WALL, VKOAuthUserScope::GROUPS);
        $state = 'h23Gvs7gBYxlLc0jWoql';
        $revoke_auth = true;

        return $oauth->getAuthorizeUrl(VKOAuthResponseType::TOKEN, $client_id, $redirect_uri, $display, $scope, $state, null, $revoke_auth);
    }
}
