<?php

namespace App\Http\Controllers;

use packages\UseCase\Twitter\Follow\TwitterFollowPresenterInterface;

class TwitterFollowController extends Controller
{
    public function index(TwitterFollowPresenterInterface $presenter)
    {
        $presenter->handle();
    }
}
