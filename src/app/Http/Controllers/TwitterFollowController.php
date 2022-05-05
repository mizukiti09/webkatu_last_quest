<?php

namespace App\Http\Controllers;

use App\Http\Middleware\CleanArchitectureMiddleware;

class TwitterFollowController extends Controller
{
    // public function index(TwitterFollowPresenterInterface $presenter)
    // {
    //     $presenter->handle();
    // }
    public function index()
    {
        CleanArchitectureMiddleware::$view = view('pages.twitter.follow');
    }
}
