<?php

namespace App\Providers;

use App\Models\EcomCustomerCart;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('navbar', function($view){

            if(auth('customers') -> check()){

                $ecomCsutomerId = auth('customers') -> user() -> id;
    
                $allItemCart = EcomCustomerCart::where('ecom_cs_id', $ecomCsutomerId) -> get();
    
                $cartAllQuantity = $allItemCart -> sum('quantity');
            }

            $view -> with('cartAllQuantity', $cartAllQuantity);

        });
    }
}
