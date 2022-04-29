<?php

namespace App\Http\Controllers;

class TwitterController extends Controller
{
    public function index()
    {
        return view('pages.twitter.follow');
    }
}
