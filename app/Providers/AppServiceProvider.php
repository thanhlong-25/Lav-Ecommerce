<?php

namespace App\Providers;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Order;
use App\Models\Banner;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*', function($view){

        $count_product = Product::all()->count();
        $count_cate = Category::all()->count();
        $count_brand = Brand::all()->count();
        $count_order = Order::all()->count();
        $banner = Banner::where('banner_status', '1')->get();

        $view->with(compact('count_product', 'count_cate', 'count_brand', 'count_order', 'banner'));});
    }
}
