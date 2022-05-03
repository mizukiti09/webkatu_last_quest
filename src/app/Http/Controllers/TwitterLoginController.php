<?php
namespace App\Http\Controllers;

use App\Facades\Twitter;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;
use packages\Domain\Domain\User\TwitterAuth\UserTwitterAuthRepositoryInterface;

class TwitterLoginController extends Controller
{
/**
 * Twitterの認証ページヘユーザーをリダイレクト
 *
 * @return \Illuminate\Http\Response
 */
    public function redirectToProvider()
    {
        return Socialite::driver('twitter')->redirect();
    }
/**
 * Twitterからユーザー情報を取得(Callback先)
 */
    public function handleProviderCallback(UserTwitterAuthRepositoryInterface $userRepository)
    {
        $twitterAuth = Twitter::connectUserAuth();

        $userRepository->save($twitterAuth);
        Log::info('Twitterから取得しました。', ['user' => $twitterAuth]);
        Auth::login(Auth::user());
        return redirect('/twitter/follow');
    }
}
