<?php

namespace Joselfonseca\LaravelAdmin\Services\Slug;

/**
 * Class SlugGeneratorTrait
 * @package Joselfonseca\LaravelAdmin\Services\Slug
 */
trait SlugGeneratorTrait {

    /**
     * Generate a Slug
     * @param $title
     * @return string
     */
    protected function generateSlug($title) {
        $slug = str_slug($title);
        $slugCount = count($this->model->whereRaw("slug REGEXP '^{$slug}(-[0-9]*)?$'")->get());
        return ($slugCount > 0) ? "{$slug}-{$slugCount}" : $slug;
    }

}