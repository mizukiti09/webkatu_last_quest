<?php

namespace packages\Domain\Application\Twitter;

use App\Facades\Twitter;
use Illuminate\Support\Facades\Log;
use packages\UseCase\Twitter\Follow\TwitterAutoFollowUseCaseInterface;
use packages\UseCase\Twitter\Follow\TwitterClickFollowUseCaseInterface;


class TwitterFollowInteractor implements TwitterClickFollowUseCaseInterface, TwitterAutoFollowUseCaseInterface
{
    public function followHandle($nickname)
    {
        Log::info($nickname);
        $response = Twitter::getConnection()->post('friendships/create', array(
            "screen_name" => $nickname,
        ));

        if (isset($response->error) && $response->error != '') {
            return $response->error;
        } else {
            return $response;
        }
    }

    public function autoFollowHandle()
    {
        $accounts = Twitter::followAccounts();

        foreach ($accounts as $account) {
            $response = Twitter::getConnection()->post('friendships/create', array(
                "screen_name" => $account->screen_name,
            ));

            if (isset($response->error) && $response->error != '') {
                return $response->error;
            }

            sleep(10);
        }
    }
}
