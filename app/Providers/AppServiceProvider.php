<?php

namespace CodeDelivery\Providers;

use Dmitrovskiy\IonicPush\PushProcessor;
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
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(PushProcessor::class,function(){
            return new PushProcessor(env('IONIC_PROFILE'), env('IONIC_JWT_TOKEN'));
        });
    }
}
