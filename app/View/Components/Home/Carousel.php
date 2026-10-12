<?php

namespace App\View\Components\Home;

use App\View\HomeCarouselContext;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

/**
 * Class Carousel
 *
 * This class represents a carousel component in the home view.
 */
class Carousel extends Component
{
    public HomeCarouselContext $context;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->context = new HomeCarouselContext();
        app()->instance(HomeCarouselContext::class, $this->context);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        return view('components.home.carousel');
    }
}
