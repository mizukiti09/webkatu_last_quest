<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;
use SebastianBergmann\CliParser\Exception;

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
 *
 * @return \Illuminate\Http\Response
 */
    public function handleProviderCallback()
    {
        try {
            $twitterUser = Socialite::driver('twitter')->user();
        } catch (Exception $e) {
            return redirect('auth/twitter');
        }

        $user = Auth::user();
        //ユーザーに必要な情報
        $user->profile_photo_path = $twitterUser->getAvatar();
        $user->twitter = true;
        $user->nickname = $twitterUser->getNickname();
        $user->save();

        Log::info('Twitterから取得しました。', ['user' => $twitterUser]);
        Auth::login($user);
        return redirect('/twitter');
    }
}
