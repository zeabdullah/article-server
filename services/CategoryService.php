<?php

class CategoryService
{
    public static function categoriesToArray($categories_db)
    {
        $results = [];
        foreach ($categories_db as $cat) {
            $results[] = $cat->toArray();
        }
        return $results;
    }
}