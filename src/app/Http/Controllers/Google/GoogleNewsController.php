<?php

namespace App\Http\Controllers\Google;

use App\Facades\Google;
use App\Http\Controllers\Controller;
use App\Http\Middleware\CleanArchitectureMiddleware;


class GoogleNewsController extends Controller
{
    public function index()
    {
        $list_gn = Google::news();
        CleanArchitectureMiddleware::$view = view('pages.google.news', compact('list_gn'));
    }
}
