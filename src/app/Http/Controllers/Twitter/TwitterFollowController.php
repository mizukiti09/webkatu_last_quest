<?php

namespace App\Http\Controllers\Twitter;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Middleware\CleanArchitectureMiddleware;
use packages\UseCase\Twitter\Follow\TwitterAutoFollowUseCaseInterface;
use packages\UseCase\Twitter\Follow\TwitterClickFollowUseCaseInterface;

class TwitterFollowController extends Controller
{
    // フォローページ表示
    public function index()
    {
        CleanArchitectureMiddleware::$view = view('pages.twitter.follow');
    }

    // ユーザーが一つずつフォロー
    public function clickFollow(Request $request, TwitterClickFollowUseCaseInterface $interactor)
    {
        $interactor->followHandle($request->nickname);
    }

    // 自動フォロー
    public function autoFollow(TwitterAutoFollowUseCaseInterface $interactor)
    {
        $interactor->autoFollowHandle();
    }
}
