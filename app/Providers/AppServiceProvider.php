<?php

namespace App\Providers;

use App\Entity\Brand;
use App\Entity\Category;
use App\Entity\Product;
use App\Entity\Shop\Cart;
use App\Entity\Vendor;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('admin.layouts._sidebar', function($view){
            $view->with('countProducts', Product::count());
        });

        view()->composer('admin.layouts._sidebar', function($view){
            $view->with('countCategories', Category::count());
        });

        view()->composer('admin.layouts._sidebar', function($view){
            $view->with('countVendors', Vendor::count());
        });

        view()->composer('admin.layouts._sidebar', function($view){
            $view->with('countBrands', Brand::count());
        });


    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
