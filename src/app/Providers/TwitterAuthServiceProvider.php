<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use packages\Domain\Domain\User\TwitterAuth\UserTwitterAuthRepositoryInterface;
use packages\Infrastructure\User\TwitterAuth\UserTwitterAuthRepository;

class TwitterAuthServiceProvider extends ServiceProvider
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
        $this->app->bind('twitterAuth', 'App\Services\TwitterAuth');
    }
    /**
     * 登録する必要のある全コンテナ結合
     *
     * @var array
     */
    public $bindings = [
        UserTwitterAuthRepositoryInterface::class => UserTwitterAuthRepository::class,
    ];
}
