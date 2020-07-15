<?php

namespace App\Providers;

use App\Cart;
use App\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
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
     *
     Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
            // Using Closure based composers...
            View::composer('layouts/app', function ($view) {

                if (Auth::check()) {
                $cartItems = Cart::where('buyer_id', Auth::user()->id)->get();
                $view->with('cartItems', count($cartItems) );
                }
            });

    }
}
