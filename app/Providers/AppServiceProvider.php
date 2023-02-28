<?php

namespace App\Providers;

use App\Models\User;
use App\Services\MailchimpNewsletter;
use App\Services\Newsletter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use MailchimpMarketing\ApiClient;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(Newsletter::class, function () {
            $client = new ApiClient();
            $client->setConfig([
                'apiKey' => config('services.mailchimp.key'),
                'server' => 'us18'
            ]);

            return new MailchimpNewsletter($client);
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        /**
         * Use different default style for any component
         */
        //Paginator::useBootstrapFive();
        Model::unguard();

        Gate::define('admin', function (User $user) {
            return $user->is_admin === 1 || $user->username === 'nmatja';
        });

        /**
         * Guests can register.
         */
        Gate::define('user_register', function (?User $user) {
            return true;
        });

        Blade::if('admin', function () {
            return request()->user()?->can('admin');
        });

        /**
         * Share data with all the views for the current user followers.
         */
          View::composer('*', function($view) {
            if (Auth::check()) {
              $user = Auth::user();
              $view->with('userFollowers', $user->followers);
              $view->with('userFollowing', $user->followings);
            }
          });

    }
}
