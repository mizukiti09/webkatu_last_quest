<?php

namespace App\Http\Controllers\Twitter;

use App\Http\Controllers\Controller;
use packages\UseCase\Twitter\Auth\TwitterAuthUseCaseInterface;

class TwitterLogoutController extends Controller
{
    public function handle(TwitterAuthUseCaseInterface $interactor)
    {
        $interactor->logoutHandle();
        return redirect()->route('home');
    }
}
