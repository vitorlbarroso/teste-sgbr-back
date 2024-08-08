<?php

namespace App\Helpers;

class SlugHelper
{
    public static function format_slug($slug)
    {
        $slug = strtolower($slug);

        $slug = preg_replace('/[^a-z0-9\s-]/', '', $slug);
        $slug = preg_replace('/[\s-]+/', ' ', $slug);
        $slug = trim($slug);
        $slug = str_replace(' ', '-', $slug);

        return $slug;
    }
}
