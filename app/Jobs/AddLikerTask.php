<?php

namespace App\Jobs;

use App\Models\Liking;
use App\Services\VkApiService;
use App\Validators\LinksValidator;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class AddLikerTask implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private array $groupUrls;

    private string $token;

    /**
     * Create a new job instance.
     *
     * @param array $groupUrls
     * @param string $token
     */
    public function __construct(array $groupUrls, string $token)
    {
        $this->groupUrls = $groupUrls;
        $this->token = $token;
    }

    /**
     * Execute the job.
     *
     * @param LinksValidator $linksValidator
     * @param VkApiService $vkApiService
     * @return void
     */
    public function handle(VkApiService $vkApiService)
    {
        $dateOfStart = date('Y:m:d H:i:s', time());
        Liking::createNewLiking($dateOfStart);

        $vkApiService->setToken($this->token);
        $vkApiService->likePostsFromAllGroups($this->groupUrls);

        Liking::changeStatusToCompleted($dateOfStart);
    }
}
