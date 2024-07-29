<?php

namespace App\Providers;

use App\Events\UserRegistered;
use App\InterfaceRepository\InterfaceAuthRepository;
use App\Listeners\SendVerificationEmail;
use Illuminate\Support\ServiceProvider;
use App\Repository\AuthRepository;
use Monolog\Handler\SendGridHandler;

class AppServiceProvider extends ServiceProvider
{
    // protected $listen = [
    //     UserRegistered::class => [
    //         SendVerificationEmail::class
    //     ],
    // ];
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(InterfaceAuthRepository::class, AuthRepository::class);
        $this->app->bind(UserRegistered::class, SendVerificationEmail::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
