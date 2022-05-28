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

        if (isset($accounts->errors)) {
            $warningMessage = '15分お待ち頂いてからご利用ください';
            CleanArchitectureMiddleware::$view = view('pages.twitter.follow.follow_wait', compact('warningMessage'));
        }

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
                CleanArchitectureMiddleware::$view = view('pages.twitter.follow.follow_wait', compact('warningMessage'));
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


    public function tweetsData($searchKey, $sinceTime, $untilTime, $loopNumber)
    {
        date_default_timezone_set('Asia/Tokyo'); //https://blog.codecamp.jp/php-datetime参考

        // 取得オプション
        $options = array('q' => $searchKey, 'lang' => 'en', 'count' => 100, 'result_type' => 'resent', 'since' => $sinceTime, 'until' => $untilTime,);
        // 取得
        $request_loop = $loopNumber;
        $tweet_results = array();
        $results = $this->connection->get("search/tweets", $options);



        for ($i = 0; $i < $request_loop; $i++) {
            foreach ($results->statuses as $val) {
                $tweet_results[]['text'] = $val->text;
            }

            // 次のツイートデータがあれば処理を続ける
            if (isset($results->search_metadata->next_results)) {
                //次ページのmax_id値を取得
                $max_id = preg_replace('/.*?max_id=([\d]+)&.*/', '$1', $results->search_metadata->next_results);
                $options['max_id'] = $max_id;
            } else {
                // これ以上ツイートがなければ抜ける
                break;
            }
        }

        return $tweet_results;
    }
}
