<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

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
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('isSuperAdmin', function ($user) {
            return $user->type === 'super-admin';
        });

        Gate::define('isAdmin', function ($user) {
            return $user->type === 'admin';
        });

        Gate::define('isEngagementLead', function ($user) {
            return $user->type === 'engagement-lead';
        });

        Gate::define('isFinanceUser', function ($user) {
            return $user->type === 'financeuser';
        });

        Gate::define('isStakeholder', function ($user) {
            return $user->type === 'stakeholder';
        });
    }
}
