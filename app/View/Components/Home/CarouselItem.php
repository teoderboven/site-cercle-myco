<?php

namespace App\View\Components\Home;

use App\View\HomeCarouselContext;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CarouselItem extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public HomeCarouselContext $context,
        public string $route,
        public string $image,
        public string $title,
    )
    {
        $this->context->increment();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        return view('components.home.carousel-item');
    }
}
