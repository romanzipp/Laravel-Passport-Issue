<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;
use ReflectionClass;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        $this->app['router']->matched(function (\Illuminate\Routing\Events\RouteMatched $event) {

            if ( ! in_array('api', $event->route->middleware())) {
                return;
            }

            $this->app['auth']->shouldUse('api');

            if ( ! request()->headers->has('Authorization') && request()->user()) {

                //
                // +++++++++++++++++++++++++++++++++++++++++
                // COMMENT THE FOLLOWING LINE FOR DEBUG DUMP
                return;
                // +++++++++++++++++++++++++++++++++++++++++
                //

                $reflection = new ReflectionClass($this->app['auth']);

                $property = $reflection->getProperty('guards');
                $property->setAccessible(true);

                $guards = $property->getValue($this->app['auth']);

                dd([
                    'authenticated-before' => $guards['api']->check(),
                    'authenticated-after'  => $guards['api']->validate(['request' => request()]),
                ]);
            }
        });

        Passport::routes();

        Passport::tokensExpireIn(now()->addDays(30));
        Passport::refreshTokensExpireIn(now()->addMonths(6));
    }
}
