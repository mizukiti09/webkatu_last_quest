<?php

namespace App\Http\Controllers\Twitter;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Middleware\CleanArchitectureMiddleware;
use packages\UseCase\Twitter\Follow\TwitterClickFollowUseCaseInterface;

class TwitterFollowController extends Controller
{
    public function index()
    {
        CleanArchitectureMiddleware::$view = view('pages.twitter.follow');
    }

    public function clickFollow(Request $request, TwitterClickFollowUseCaseInterface $interactor)
    {
        $interactor->followHandle($request->nickname);
    }
}
