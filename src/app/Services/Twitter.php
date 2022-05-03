<?php

namespace App\Services;

use Abraham\TwitterOAuth\TwitterOAuth;
use Exception;
use Laravel\Socialite\Facades\Socialite;

class Twitter
{
    private $client_id;
    private $client_secret;
    private $access_token;
    private $access_token_secret;

    public function __construct()
    {
        $this->client_id = config('services.twitter.client_id');
        $this->client_secret = config('services.twitter.client_secret');
        $this->access_token = config('services.twitter.access_token');
        $this->access_token_secret = config('services.twitter.access_token_secret');
    }

    public function connectUserAuth()
    {
        try {
            $twitterUser = Socialite::driver('twitter')->user();
            return $twitterUser;
        } catch (Exception $e) {
            return redirect('auth/twitter');
        }
    }

    public function followAccount()
    {
        $connection = new TwitterOAuth($this->client_id, $this->client_secret, $this->access_token, $this->access_token_secret);
        $accounts = $connection->get('users/search', array("q" => "仮想通貨", "count" => 15));

        return $accounts;

    }
}
