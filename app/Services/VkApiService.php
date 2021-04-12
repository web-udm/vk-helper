<?php

namespace App\Services;

use App\Helpers\LinkEditHelper;
use VK\Client\VKApiClient;

class VkApiService
{
    private VKApiClient $vkApiClient;

    private string $token;

    public function __construct(VKApiClient $vkApiClient)
    {
        $this->vkApiClient = $vkApiClient;
    }

    public function setToken(string $token): void
    {
        $this->token = $token;
    }

    public function getPosts(array $groupUrls, int $postsNumber): array
    {
        $posts = [];

        foreach ($groupUrls as $groupUrl) {
            $posts = array_merge($posts, $this->getPost($groupUrl, $postsNumber));
        }

        return $posts;
    }

    public function getPost(string $groupUrl, int $postsNumber): array
    {
        $groupName = LinkEditHelper::getGroupName($groupUrl);

        $groupData = $this->vkApiClient->wall()->get($this->token, [
             //todo немного тяжеловатая конструкция, лучше переписать
             preg_match('#^\d+$#', $groupName) == 1 ? 'owner_id' : 'domain' => $groupName,
            'count' => $postsNumber
        ]);

        return [$groupName => $groupData['items']];
    }

    public function likePosts(array $groupUrls, int $postsNumber)
    {

    }

    public function likePost()
    {

    }
}
