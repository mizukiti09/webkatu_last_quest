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
            <twitter-account :accounts="{{ json_encode($accounts) }}"></twitter-account>
        </div>
    </section>


</div>
@endsection