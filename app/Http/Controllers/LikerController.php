<?php

namespace App\Http\Controllers;

use App\Helpers\VkTokenHelper;
use App\Models\Liking;
use App\Services\VkApiService;
use App\Validators\LinksValidator;
use Illuminate\Http\Request;
use App\Jobs\AddLikerTask;

class LikerController extends Controller
{
    public function home()
    {
        return view('liker.home');
    }

    public function result(Request $request,
                           LinksValidator $linksValidator)
    {
        if (VkTokenHelper::isTokenInSession()) {
            $request->session()->get('vk_token');
        }

        $groupUrls = explode("\r\n", $request->vk_links);
        $linksValidator->validate($groupUrls);

        $token = $request->session()->get('vk_token');

        AddLikerTask::dispatch($groupUrls, $token);

        $likingTasks = Liking::all()->sortByDesc('date');

        return view('liker.result', [
            'likingTasks' => $likingTasks
        ]);
    }
}


