<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use Abraham\TwitterOAuth\TwitterOAuth;
use Laravel\Socialite\Facades\Socialite;

class Twitter
{
    private $client_id;
    private $client_secret;
    private $access_token;
    private $access_token_secret;
    private $connection;

    public function __construct()
    {
        $this->client_id = config('services.twitter.client_id');
        $this->client_secret = config('services.twitter.client_secret');
        $this->access_token = config('services.twitter.access_token');
        $this->access_token_secret = config('services.twitter.access_token_secret');
        $this->connection = new TwitterOAuth($this->client_id, $this->client_secret, $this->access_token, $this->access_token_secret);
    }

    public function getConnection()
    {
        return $this->connection;
    }

    public function connectUserAuth()
    {
        $twitterUser = Socialite::driver('twitter')->user();
        return $twitterUser;
    }

    public function followAccounts()
    {
        $accounts = $this->connection->get('users/search', array(
            "q" => "仮想通貨",
            "page" => 1,
            "count" => 20,
            "tweet_mode" => "extended",
            "include_entities" => true,
        ));

        return $accounts;
    }

    public function clickFollow($userId)
    {
        Log::info($userId);
        $response = $this->connection->post('friendships/create', array(
            "user_id" => $userId,
        ));

        if (isset($response->error) && $response->error != '') {
            return $response->error;
        } else {
            return $response;
        }
    }
}
