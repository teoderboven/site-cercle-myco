<?php

namespace App\Services;

use Illuminate\Support\Facades\File;

class SvgHelper
{
    /**
     * Get the viewBox attribute from an SVG file.
     * The svg files are expected to be located in the resources/svg directory.
     *
     * @param string $filename The name of the SVG file (without path).
     * @return string The viewBox value or a default if not found.
     */
    public static function getViewBox(string $filename): string
    {
        $fullPath = resource_path('svg/' . $filename);

        if (File::exists($fullPath)) {
            $content = File::get($fullPath);

            if (preg_match('/viewBox="([^"]+)"/i', $content, $matches)) {
                return $matches[1];
            }
        }

        return '0 0 24 24';
    }
}
