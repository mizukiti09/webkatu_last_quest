@extends('app') @section('content')

<div class="c-contents u-inner">
    <section class="c-form__container">
        <div class="c-section__title">
            <h1>{{ __('Register') }}</h1>
        </div>

        <div class="c-form__list">
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="c-form__item">
                    <label for="name" class="c-form__label">{{ __('Name') }}</label>
                    <div class="c-form__body">
                        @error('name')
                        <span class="c-form__input--feedback" role="alert">
                                <strong>{{ $message }}</strong>
                        </span> @enderror
                        <input id="name" type="text" class="c-form__input @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                    </div>
                </div>

                <div class="c-form__item">
                    <label for="email" class="c-form__label">{{ __('E-Mail Address') }}</label>
                    <div class="c-form__body">
                        @error('email')
                        <span class="c-form__input--feedback" role="alert">
                                <strong>{{ $message }}</strong>
                        </span> @enderror
                        <input id="email" type="text" class="c-form__input @error('name') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    </div>
                </div>

                <div class="c-form__item">
                    <label for="password-confirm" class="c-form__label">{{ __('Confirm Password') }}</label>
                    <div class="c-form__body">
                        @error('password-confirm')
                        <span class="c-form__input--feedback" role="alert">
                                <strong>{{ $message }}</strong>
                        </span> @enderror
                        <input id="password-confirm" type="text" class="c-form__input @error('name') is-invalid @enderror" name="password-confirm" value="{{ old('password-confirm') }}" required autocomplete="password-confirm" autofocus>
                    </div>
                </div>

                <div class="c-form__item">
                    <button type="submit" class="c-form__button">
                            {{ __('Register') }}
                        </button>
                </div>
            </form>
        </div>

    </section>
</div>

@endsection