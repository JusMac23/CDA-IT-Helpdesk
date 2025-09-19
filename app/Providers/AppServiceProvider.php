<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use SocialiteProviders\Manager\SocialiteWasCalled;
use SocialiteProviders\Authentik\AuthentikExtendSocialite;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Hook Authentik into Socialite
        $this->app->events->listen(
            SocialiteWasCalled::class,
            [AuthentikExtendSocialite::class, 'handle']
        );
    }
}
