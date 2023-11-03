<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider
{

    public function boot()
    {
        $this->comsoserNavigation();
    }

    public function comsoserNavigation()
    {
        view()->composer(['site._partials.nav', 'site._partials.slider'], 'App\Http\Composers\NavigationComposer');
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
