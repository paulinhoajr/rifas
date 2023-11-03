<?php

namespace App\Http\Composers;

use App\Slider;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;


class NavigationComposer
{
    public function __construct()
    {

    }

    public function compose(View $view)
    {
        $sliders = Slider::orderBY('ordem', 'desc')->get();
        $view->with('sliders', $sliders);
    }
}
