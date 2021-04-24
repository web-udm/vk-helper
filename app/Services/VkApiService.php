<?php

namespace App\Services;

use App\Exceptions\WrongLikingException;
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

    public function getPostsFromAllGroups(array $groupUrls, int $postsNumber): array
    {
        $posts = [];

        foreach ($groupUrls as $groupUrl) {
            $posts = array_merge($posts, [
                LinkEditHelper::getGroupName($groupUrl) => $this->getPostsFromOneGroup($groupUrl, $postsNumber),
            ]);
            sleep(2);
        }

        return $posts;
    }

    private function getPostsFromOneGroup(string $groupUrl, int $postsNumber): array
    {
        $groupName = LinkEditHelper::getGroupName($groupUrl);

        $groupData = $this->vkApiClient->wall()->get($this->token, [
            preg_match('#^\d+$#', $groupName) == 1 ? 'owner_id' : 'domain' => $groupName,
            'count' => $postsNumber
        ]);

        return $groupData['items'];
    }

    /**
     * Лайкинг постов из переданных массивом ссылок групп
     */
    public function likePostsFromAllGroups(array $groupUrls, int $maxLikes)
    {
        foreach ($groupUrls as $groupUrl) {
            $this->likePostsFromOneGroup($groupUrl, $maxLikes);
        }
    }

    /**
     * Лайкаем посты в указанной по ссылке группе. Лайкинг идет до первого залайканного пользователем поста.
     * Закреп пропускается.
     *
     */
    private function likePostsFromOneGroup(string $groupUrl, int $maxLikes)
    {
        $posts = $this->getPostsFromOneGroup($groupUrl, $maxLikes);

        $vkApiClient = new VKApiClient();

        $res = [];

        foreach ($posts as $post) {
            if (isset($post['is_pinned'])) {
                continue;
            }

            if ($post['likes']['user_likes'] > 0) {
                break;
            }

            $res[] = $vkApiClient->likes()->add($this->token, [
                'type' => 'post',
                'owner_id' => $post['owner_id'],
                'item_id' => $post['id'],
            ]);
            sleep(5);
        }

        return $res;
    }
}
