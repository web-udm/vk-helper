<?php

namespace App\Http\Controllers;

use App\Services\VkTokenService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class VkTokenController
{
    /**
     * @param VkTokenService $vkTokenService
     * @return RedirectResponse
     */
    public function getToken(VkTokenService $vkTokenService): RedirectResponse
    {
        if (env('APP_ENV') == 'local') {
            $redirectUri = $vkTokenService->getTokenOnLocal();
        } else {
            $redirectUri = $vkTokenService->getTokenOnProd();
        }

        return redirect()->away($redirectUri);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function setToken(Request $request): RedirectResponse
    {
        session(['token' => $request->input()['vk_token']]);
        session()->flash('gotToken', 'Ура, мы получили токен');

        return redirect()->route('checker-home');
    }
}
