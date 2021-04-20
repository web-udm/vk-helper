<?php

namespace App\Http\Controllers;

use App\Exceptions\MillionPostsException;
use App\Helpers\VkTokenHelper;
use App\Serializers\PostSerializer;
use App\Services\VkApiService;
use App\Validators\LinksValidator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckerController extends Controller
{
    public function home()
    {
        return view('checker.home');
    }

    public function result(Request $request,
                           LinksValidator $linksValidator,
                           VkApiService $vkApiService,
                           PostSerializer $postSerializer
    )
    {
        if (VkTokenHelper::isTokenInSession()) {
            $token = $request->session()->get('vk_token');
        }

        $postsNumber = $request->posts_number;

        if ($postsNumber == 'миллион') {
            throw new MillionPostsException();
        }

        $groupUrls = explode("\r\n", $request->vk_links);
        $linksValidator->validate($groupUrls);

        $vkApiService->setToken($token);
        $posts = $vkApiService->getPostsFromAllGroups($groupUrls, $postsNumber);
        $serializePosts = $postSerializer->serialize($posts);

        return view('checker.result', [
            'groupsData' => $serializePosts,
        ]);
    }
}
