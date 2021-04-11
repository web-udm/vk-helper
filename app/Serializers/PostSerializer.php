<?php

namespace App\Serializers;

use App\Helpers\PostHelper;

class PostSerializer
{
    protected PostHelper $postHelper;

    public function __construct(PostHelper $postHelper)
    {
       $this->postHelper = $postHelper;
    }

    public function serialize(array $groupsData): array
    {
        $serializePosts = [];

        foreach ($groupsData as $groupName => $groupData) {
            foreach ($groupData as $post) {
                $groupId = $post['from_id'];
                $postId = $post['id'];

                $serializePosts[$groupName][$postId]['link'] = "https://vk.com/$groupName?w=wall{$groupId}_{$postId}";
                $serializePosts[$groupName][$postId]['date'] = $post['date'];
                //TODO решить проблему с проверкой текста. Сейчас в Speller летит слишком большой текст и возникает ошибка
                $serializePosts[$groupName][$postId]['text'] = $post['text'];
                $serializePosts[$groupName][$postId]['hashtags'] = $this->postHelper->calculateHashtags($post['text']);
                $serializePosts[$groupName][$postId]['emojies'] = $this->postHelper->calculateEmojies($post['text']);

                if (isset($post['attachments'])) {
                    foreach ($post['attachments'] as $attachment) {
                        if ($attachment['type'] == 'photo') {
                            $serializePosts[$groupName][$postId]['images'][] = array_pop($attachment['photo']['sizes'])['url'];
                        }
                    }
                }
            }
        }

        return $serializePosts;
    }
}
