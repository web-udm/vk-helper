<?php

namespace App\Http\Controllers;

use App\Helpers\VkTokenHelper;
use App\Models\Liking;
use App\Validators\LinksValidator;
use Illuminate\Http\Request;
use App\Jobs\AddLikerTask;

class LikerController extends Controller
{
    public function home()
    {
        return view('liker.home');
    }

    public function addTask(Request $request,
                           LinksValidator $linksValidator)
    {
        if (VkTokenHelper::isTokenInSession()) {
            $request->session()->get('vk_token');
        }

        $groupUrls = explode("\r\n", $request->vk_links);
        $linksValidator->validate($groupUrls);

        $token = $request->session()->get('vk_token');
        $maxLikes = $request->get('max_likes');

        AddLikerTask::dispatch($groupUrls, $maxLikes, $token);

        return redirect()->route('liker-result');
    }

    public function result()
    {
        $likingTasks = Liking::all()
            ->sortByDesc('date')
            ->map(function($likingTask) {
                $date = date_create($likingTask->date);
                date_modify($date, '4 hours');
                $likingTask->date = date_format($date, 'd.m.Y H:i:m');;

                return $likingTask;
            });


        return view('liker.result', [
            'likingTasks' => $likingTasks
        ]);
    }
}


