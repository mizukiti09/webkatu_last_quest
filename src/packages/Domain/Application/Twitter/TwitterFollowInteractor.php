<?php

namespace packages\Domain\Application\Twitter;

use App\Facades\Twitter;
use Illuminate\Support\Facades\Log;
use packages\UseCase\Twitter\Follow\TwitterAutoFollowUseCaseInterface;
use packages\UseCase\Twitter\Follow\TwitterClickFollowUseCaseInterface;
use packages\Domain\Domain\User\TwitterAuth\UserTwitterFollowRepositoryInterface;


class TwitterFollowInteractor implements TwitterClickFollowUseCaseInterface, TwitterAutoFollowUseCaseInterface
{
    private $repository;

    public function __construct(UserTwitterFollowRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function followHandle($nickname)
    {
        $this->repository->userFollowCountResetBy24HoursAgo();
        if ($this->repository->followCountUpperCheck() == true) {
            Log::info($nickname);
            $response = Twitter::getConnection()->post('friendships/create', array(
                "screen_name" => $nickname,
            ));

            if (isset($response->error) && $response->error != '') {
                return $response->error;
            } else {
                $this->repository->followCountSave();
                return $response;
            }
        } else {
            return;
        }
    }

    public function autoFollowHandle()
    {
        $this->repository->userFollowCountResetBy24HoursAgo();
        if ($this->repository->followCountUpperCheck() == true) {
            $accounts = Twitter::followAccounts();

            foreach ($accounts as $account) {
                $response = Twitter::getConnection()->post('friendships/create', array(
                    "screen_name" => $account->screen_name,
                ));

                if (isset($response->error) && $response->error != '') {
                    return $response->error;
                } else {
                    $this->repository->followCountSave();
                    return $response;
                }

                sleep(60);
            }
        } else {
            return;
        }
    }
}
