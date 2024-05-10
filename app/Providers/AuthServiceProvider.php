<?php

namespace App\Providers;

 use Illuminate\Support\Facades\App;
 use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{

    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Gate::define('category-list',  'App\Policies\CategoryPolicy@view');
        Gate::define('category-add',  'App\Policies\CategoryPolicy@create');
        Gate::define('category-edit',  'App\Policies\CategoryPolicy@update');
        Gate::define('category-delete',  'App\Policies\CategoryPolicy@delete');




        Gate::define('menu-list', function ($user) {
            return $user->checkPermissionAccess(config('permissions.access.list-menu'));
        });
        Gate::define('slider-list', function ($user) {
            return $user->checkPermissionAccess(config('permissions.access.list-slider'));
        });
        Gate::define('product-list', function ($user) {
            return $user->checkPermissionAccess(config('permissions.access.list-product'));
        });
        Gate::define('setting-list', function ($user) {
            return $user->checkPermissionAccess(config('permissions.access.list-setting'));
        });
        Gate::define('user-list', function ($user) {
            return $user->checkPermissionAccess(config('permissions.access.list-user'));
        });
        Gate::define('role-list', function ($user) {
            return $user->checkPermissionAccess(config('permissions.access.list-role'));
        });
    }
}
