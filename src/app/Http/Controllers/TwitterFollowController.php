<?php

namespace App\Http\Controllers;

class TwitterFollowController extends Controller
{
    public function index()
    {
        return view('pages.twitter.follow');
    }
}
