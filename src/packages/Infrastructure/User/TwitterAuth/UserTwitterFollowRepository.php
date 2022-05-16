<?php

namespace packages\Infrastructure\User\TwitterAuth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use packages\Domain\Domain\User\TwitterAuth\UserTwitterFollowRepositoryInterface;

class UserTwitterFollowRepository implements UserTwitterFollowRepositoryInterface
{
    public function followCountSave()
    {
        DB::table('users')
            ->where('id', Auth::id())
            ->increment('follow_count');
    }

    public function userFollowCountResetBy24HoursAgo()
    {
        // follow_countが１の時のUnixタイム
        $followCountFirstUnixTime = DB::table('users')
            ->where('id', Auth::id())
            ->select('follow_count_first_unix_time')
            ->get()
            ->first();

        // // 現在のUnixタイム
        $currentTime = time();

        if ($followCountFirstUnixTime !== null) {
            // 86400 は 1日あたりのUnixタイム
            if (($followCountFirstUnixTime + 86400) < $currentTime) {
                DB::table('users')
                    ->where('id', Auth::id())
                    ->update([
                        'follow_count' => 0,
                        'follow_count_first_unix_time' => time(),
                    ]);
            }
        } else {
            //  ユーザーが初めてフォローする時は$followCountFirstUnixTime は nullになるので
            // こちらの処理がされる
            DB::table('users')
                ->where('id', Auth::id())
                ->update([
                    'follow_count_first_unix_time' => time(),
                ]);
        }
    }

    public function followCountUpperCheck()
    {
        $followCount = DB::table('users')
            ->where('id', Auth::id())
            ->select('follow_count')
            ->get()
            ->first();

        if ($followCount < 1000) {
            return true;
        } else {
            return false;
        }
    }
}
