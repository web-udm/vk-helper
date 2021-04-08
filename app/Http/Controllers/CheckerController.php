<?php

namespace App\Http\Controllers;

use App\Exceptions\MillionPostsException;
use App\Helpers\VkTokenHelper;
use App\Validators\LinksValidator;
use Illuminate\Http\Request;

class CheckerController extends Controller
{
    public function home(Request $request)
    {
        return view('checker.home');
    }

    public function result(Request $request, LinksValidator $linksValidator)
    {
        VkTokenHelper::isTokenInSession();

        $links = explode("\n", $request->vk_links);
        $linksValidator->validate($links);

        $postsNumber = $request->posts_number;

        if ($postsNumber == 'миллион') {
            throw new MillionPostsException();
        }

        $posts = [];

        foreach ($links as $link) {
            preg_match('#vk\.com/(.+)#', $link, $match);

            if (empty($match[1])) {
                throw new \Exception("Косячная ссылка: $link");
            }

            $groupId = trim($match[1]); //убираем символ переноса строки, обусловлено вводом пользователя в форму

            $this->vkSender->setApiToken($token);
            $posts[] = $this->vkSender->getPosts($groupId, $postsNumber);
            usleep(500000);
        }

        $serializePosts = $this->postSerializer->serialize($posts);

        return $this->twig->render($response, 'home/results.twig', ['groupsData' => $serializePosts]);
    }
}
