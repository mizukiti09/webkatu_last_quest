<?php

namespace packages\Domain\Domain\User\TwitterAuth;

interface UserTwitterFollowRepositoryInterface
{
    // フォローした数を１ずつcountする
    public function followCountSave();

    // follow_count_first_unit_timeから24時間経っていたら
    // follow_count を0 に更新
    // follow_count_first_unit_time を現在のUnixタイムに更新
    public function userFollowCountResetBy24HoursAgo();

    // 1日のフォロー上限のチェックをする(1日にフォローできる上限が1000フォロー)
    public function followCountUpperCheck();
}
