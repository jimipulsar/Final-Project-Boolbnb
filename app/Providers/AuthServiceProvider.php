<?php

namespace App\Providers;

use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Auth;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
     public function boot(GateContract $gate)
       {
           parent::registerPolicies($gate);

           $gate->define('update-post', function ($user, $post) {
                   return $user->id === $post->user_id;
           });

           $gate->define('mod-update-post', function ($user, $subreddit) {
               return $user->id === $subreddit->user_id;
           });
       }
}
