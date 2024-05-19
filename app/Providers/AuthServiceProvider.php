<?php

namespace App\Providers;

 use App\Models\Product;
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
        $this->defineGateCategory();
        $this->defineGateMenu();
        $this->defineGateSlider();

        //demo ! co the them lai vao productPolicy roi sau lai
//        Gate::define('product-edit', function ($user,$id) {
//            $product = Product::find($id);
//            if ($user->checkPermissionAccess('product_edit') && $user->id === $product->user_id) {
//                return true;
//            }
//            return false;
//        });

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
    public  function defineGateCategory()
    {
        Gate::define('category-list',  'App\Policies\CategoryPolicy@view');
        Gate::define('category-add',  'App\Policies\CategoryPolicy@create');
        Gate::define('category-edit',  'App\Policies\CategoryPolicy@update');
        Gate::define('category-delete',  'App\Policies\CategoryPolicy@delete');
    }
    public  function defineGateMenu()
    {
        Gate::define('Menu-list',  'App\Policies\MenuPolicy@view');
        Gate::define('Menu-add',  'App\Policies\MenuPolicy@create');
        Gate::define('Menu-edit',  'App\Policies\MenuPolicy@update');
        Gate::define('Menu-delete',  'App\Policies\MenuPolicy@update');
    }
    public  function defineGateSlider()
    {
        Gate::define('Slider-list',  'App\Policies\SliderPolicy@view');
        Gate::define('Slider-add',  'App\Policies\SliderPolicy@create');
        Gate::define('Slider-edit',  'App\Policies\SliderPolicy@update');
        Gate::define('Slider-delete',  'App\Policies\SliderPolicy@update');
    }
}
