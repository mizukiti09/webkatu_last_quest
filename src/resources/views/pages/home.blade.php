@extends('app') @section('content') @include('layouts.hero')
<div class="c-contents u-inner">
    <div class="p-worry f-section">
        <div class="c-section__title">
            <h1>こんなお悩みないですか?</h1>
        </div>
        <div class="p-worry__img">
            <img class="u-img" src="{{ asset('images/worry.png') }}" alt="worry">
        </div>
        <div class="p-worry__description">
            <p>これからますます実用化が進む仮想通貨。<br><br> そんな時代にいち早く良い情報を仕入れることは、将来の生活を豊かにする為に重要なことの一つです。<br> <br> C Checker ではTwitterを介して<br>仮想通貨に関連するツイートを各コイン都度に閲覧できたり、 仮想通貨に関連するアカウントを自動フォローなど、<br> これから仮想通貨を効率良く運用する為の情報を提供しております。

            </p>
        </div>
    </div>

    <div class="p-strong f-section">
        <div class="c-section__title">
            <h1>C Checkerの３つの強み</h1>
        </div>

        <ul class="p-strong__container">
            <li class="p-strong__point">
                <div class="p-strong__img"></div>
                <div class="p-strong__descritption"></div>
            </li>
            <li class="p-strong__point">
                <div class="p-strong__img"></div>
                <div class="p-strong__descritption"></div>
            </li>
            <li class="p-strong__point">
                <div class="p-strong__img"></div>
                <div class="p-strong__descritption"></div>
            </li>
        </ul>
    </div>

    @include('layouts.startMenu')

</div>



@endsection