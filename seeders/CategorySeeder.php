<?php
require('../models/Category.php');

class CategorySeeder
{
    private array $categories;

    public function __construct(...$categoriesAssoc)
    {
        $this->categories = $categoriesAssoc;
    }

    public function seed()
    {
        $categoryObjs = [];
        foreach ($this->categories as $cat) {
            $categoryObjs[] = Category::create($cat);
        }
        return $categoryObjs;
    }
}

