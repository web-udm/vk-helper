<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckerController extends Controller
{
    public function home(Request $request)
    {
        return view('checker.home');
    }

    public function results(Request $request)
    {
        try {
            if (isset($_COOKIE['token'])) {
                $token = $_COOKIE['token'];
            } else {
                throw new \Exception("Кука сдохла");
            }

            $links = explode("\n", $request->getContent()['links']);
            var_dump($links);die;

            $postsNumber = ($request->getParsedBody()['posts_number']);

            if (empty($links[0])) {
                throw new \Exception('Ты забыла записать ссылки');
            }

            if ($postsNumber == 'миллион') {
                throw new \Exception(
                    "Ты сломала сервер" .
                    "<br>" .
                    "<img src='img/9150e4e5ly1fh3mcehmamg2088088qlf.gif'>"
                );
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

            return $this->twig->render($response, 'home/results.twig',['groupsData' => $serializePosts]);
        } catch (\Exception $e) {
            return $this->twig->render($response, 'home/error.twig', ['errorMessage' => $e->getMessage()]);
        }
    }
}
