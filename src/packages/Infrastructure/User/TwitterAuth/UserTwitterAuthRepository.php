<?php

namespace packages\Infrastructure\User\TwitterAuth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use packages\Domain\Domain\User\TwitterAuth\UserTwitterAuthRepositoryInterface;

class UserTwitterAuthRepository implements UserTwitterAuthRepositoryInterface
{
    /**
     * @param $twitterAuth
     */
    public function save($twitterAuth)
    {
        DB::table('users')
            ->where('id', Auth::id())
            ->update([
                'twitter' => true,
                'profile_photo_path' => $twitterAuth->getAvatar(),
                'nickname' => $twitterAuth->getNickname(),
            ]);
    }

}
