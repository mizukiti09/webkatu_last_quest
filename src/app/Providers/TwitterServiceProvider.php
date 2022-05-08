<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Http\ViewComposers\UserComposer;
use App\Http\Presenters\Twitter\TwitterFollowPresenter;
use App\Http\ViewComposers\TwitterFollowAccountComposer;
use packages\Domain\Application\Twitter\TwitterAuthInteractor;
use packages\UseCase\Twitter\Auth\TwitterAuthUseCaseInterface;
use packages\UseCase\Twitter\Follow\TwitterFollowPresenterInterface;
use packages\Domain\Application\Twitter\TwitterClickFollowInteractor;
use packages\Infrastructure\User\TwitterAuth\UserTwitterAuthRepository;
use packages\UseCase\Twitter\Follow\TwitterClickFollowUseCaseInterface;
use packages\Domain\Domain\User\TwitterAuth\UserTwitterAuthRepositoryInterface;

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
        TwitterFollowPresenterInterface::class => TwitterFollowPresenter::class,
        TwitterAuthUseCaseInterface::class => TwitterAuthInteractor::class,
        TwitterClickFollowUseCaseInterface::class => TwitterClickFollowInteractor::class,
    ];
}
