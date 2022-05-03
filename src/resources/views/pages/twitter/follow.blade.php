@section('title', 'C Checker / 一括フォロー')@extends('app') @section('content')

<div class="c-contents">
    <section class="p-follow f-section">
        <div class="c-section__title">
            <h1>Follow all together</h1>
        </div>
        <div class="c-page__description">
            <h2>Twitter上の『仮想通貨』関連ユーザーをフォローし、<br>情報のキャッチアップを効率的に行いましょう。</h2>
            <br>
            <span>* Follow Start ! ONにすると15分に一度、自動フォローを実施します。</span>
        </div>


        <button class="c-btn-follow" type="submit">
            Follow Start !!
          </button>

        <div class="p-follow__account__container">
            <div class="p-follow__account">
                <div class="p-follow__info">
                    <div class="p-follow__avatar">
                        <img src="" alt="">
                    </div>
                    <div class="p-follow__name">銀二</div>
                    <div class="p-follow__nickname">@mizukiti_mind</div>
                    <div class="p-follow__status">
                        <div class="p-follow__followCount">100 フォロー中</div>
                        <div class="p-follow__followerCount">200 フォロワー数</div>
                    </div>
                </div>
                <div class="p-follow__info">
                    <div class="p-follow__prof">
                        <div class="p-follow__title">
                            プロフィール
                        </div>
                        <p>リードに繋がれたペット(お金を貰ってる人間) ではなく ▶️ 飼い主 (お金を稼いでいる人間) になる努力を、 経歴《ベーシスト、ホームレス、スカウト業 、 webエンジニア》 25age</p>
                    </div>
                    <div class="p-follow__tweet">
                        <div class="p-follow__title">
                            最新のツイート
                        </div>
                        <p>tweet.tweet.tweet.tweet.tweet. tweet.tweet.tweet.tweet.tweet.tweet.tweet.tweet.tweet.tweet. tweet.tweet.tweet.tweet.tweet.tweet.tweet.tweet.tweet.tweet. tweet.tweet.tweet.tweet.tweet.tweet.tweet.tweet.tweet.tweet. tweet.tweet.tweet.tweet.tweet.tweet.tweet.tweet.tweet.tweet.
                            tweet.tweet.tweet.tweet.tweet.tweet.tweet.tweet.tweet.tweet. tweet.tweet.tweet.tweet.tweet.
                        </p>
                    </div>
                </div>


            </div>
            <div class="p-follow__account">
            </div>
            <div class="p-follow__account">
            </div>
            <div class="p-follow__account">
            </div>
            <div class="p-follow__account">
            </div>
        </div>
    </section>


</div>
@endsection