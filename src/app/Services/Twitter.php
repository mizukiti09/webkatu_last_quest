<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Abraham\TwitterOAuth\TwitterOAuth;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Middleware\CleanArchitectureMiddleware;

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

    // twitterAPI接続
    public function getConnection()
    {
        return $this->connection;
    }

    // twitter認証ユーザーの情報を取得
    public function connectUserAuth()
    {
        $twitterUser = Socialite::driver('twitter')->user();
        return $twitterUser;
    }

    // 認証ユーザーのフォローしている他ユーザーの情報を取得
    private function currentFollows()
    {
        $authUser = Auth::user();
        $nickname = $authUser->nickname;

        $followAccounts = $this->connection->get('friends/ids', array(
            'screen_name' => $nickname,
        ));

        return $followAccounts;
    }

    // フォローできるアカウント
    public function followAccounts()
    {
        $page = mt_rand(1, 51);
        $accounts = $this->connection->get('users/search', array(
            "q" => "仮想通貨",
            "page" => $page,
            "count" => 15,
            "tweet_mode" => "extended",
            "include_entities" => true,
        ));

        return $accounts;
    }


    // フォローページにてまだフォローしていないアカウントを選別
    public function followCheck($accounts)
    {
        if (count($accounts) === 0) {
            $page = mt_rand(1, 51);

            $accounts = $this->connection->get('users/search', array(
                "q" => "仮想通貨",
                "page" => $page,
                "count" => 15,
                "tweet_mode" => "extended",
                "include_entities" => true,
            ));

            return $accounts;
        } else {
            $currentFollows = $this->currentFollows();

            if (isset($currentFollows->errors)) {
                $warningMessage = '15分お待ち頂いてからご利用ください';
                CleanArchitectureMiddleware::$view = view('pages.twitter.follow_wait', compact('warningMessage'));
            }

            $yetFollows = [];
            // // まだフォローしていないアカウントを選別してそれを返す
            foreach ($accounts as $target) {
                if (!in_array($target->id, $currentFollows->ids)) {
                    array_push($yetFollows, $target);
                }
            }
            return $yetFollows;
        }
    }
}
