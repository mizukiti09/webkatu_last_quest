<?php

namespace App\Services;

use Exception;
use Laravel\Socialite\Facades\Socialite;

class TwitterAuth
{
    public function connect()
    {
        try {
            $twitterUser = Socialite::driver('twitter')->user();
            return $twitterUser;
        } catch (Exception $e) {
            return redirect('auth/twitter');
        }
    }
}
