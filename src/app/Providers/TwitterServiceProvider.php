<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Http\ViewComposers\UserComposer;
use App\Http\Presenters\Twitter\TwitterFollowPresenter;
use App\Http\ViewComposers\TwitterFollowAccountComposer;
use packages\Domain\Application\Twitter\TwitterAuthInteractor;
use packages\UseCase\Twitter\Auth\TwitterAuthUseCaseInterface;
use packages\Domain\Application\Twitter\TwitterFollowInteractor;
use packages\UseCase\Twitter\Follow\TwitterFollowPresenterInterface;
use packages\UseCase\Twitter\Follow\TwitterAutoFollowUseCaseInterface;
use packages\Infrastructure\User\TwitterAuth\UserTwitterAuthRepository;
use packages\UseCase\Twitter\Follow\TwitterClickFollowUseCaseInterface;
use packages\Infrastructure\User\TwitterAuth\UserTwitterFollowRepository;
use packages\Domain\Domain\User\TwitterAuth\UserTwitterAuthRepositoryInterface;
use packages\Domain\Domain\User\TwitterAuth\UserTwitterFollowRepositoryInterface;

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
        View::composers([
            TwitterFollowAccountComposer::class => 'pages.twitter.*',
            UserComposer::class => 'app',
        ]);
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
        UserTwitterFollowRepositoryInterface::class => UserTwitterFollowRepository::class,
        TwitterFollowPresenterInterface::class => TwitterFollowPresenter::class,
        TwitterAuthUseCaseInterface::class => TwitterAuthInteractor::class,
        TwitterClickFollowUseCaseInterface::class => TwitterFollowInteractor::class,
        TwitterAutoFollowUseCaseInterface::class => TwitterFollowInteractor::class,
    ];
}
