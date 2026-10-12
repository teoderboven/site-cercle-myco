<?php

namespace App\View;

/**
 * Class HomeCarouselContext
 *
 * This class is used to maintain the context of a home carousel component.
 */
class HomeCarouselContext
{
    private int $count = 0;

    /**
     * Increment the count by 1.
     */
    public function increment(): void
    {
        $this->count++;
    }

    /**
     * Get the current count.
     */
    public function getCount(): int
    {
        return $this->count;
    }
}