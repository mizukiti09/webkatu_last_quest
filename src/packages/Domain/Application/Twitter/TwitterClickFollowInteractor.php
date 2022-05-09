<?php

namespace packages\Domain\Application\Twitter;

use App\Facades\Twitter;
use packages\UseCase\Twitter\Follow\TwitterClickFollowUseCaseInterface;


class TwitterClickFollowInteractor implements TwitterClickFollowUseCaseInterface
{


    public function followHandle($nickname)
    {
        Twitter::clickFollow($nickname);
    }
}
