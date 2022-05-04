<?php

namespace App\Providers;

use App\Http\Presenters\Twitter\TwitterFollowPresenter;
use Illuminate\Support\ServiceProvider;
use packages\Domain\Domain\User\TwitterAuth\UserTwitterAuthRepositoryInterface;
use packages\Infrastructure\User\TwitterAuth\UserTwitterAuthRepository;
use packages\UseCase\Twitter\Follow\TwitterFollowPresenterInterface;

class TwitterServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerForFacade();
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    private function registerForFacade()
    {
        $this->app->bind('twitter', 'App\Services\Twitter');
    }
    /**
     * 登録する必要のある全コンテナ結合
     *
     * @var array
     */
    public $bindings = [
        UserTwitterAuthRepositoryInterface::class => UserTwitterAuthRepository::class,
        TwitterFollowPresenterInterface::class => TwitterFollowPresenter::class,
    ];
}
