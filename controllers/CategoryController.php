<?php
require(__DIR__ . "/../services/ResponseService.php");
require(__DIR__ . "/../models/Category.php");
require(__DIR__ . "/../services/CategoryService.php");

class CategoryController
{
    public function getAllCategories()
    {
        try {
            $categories = Category::all();
            $categoriesArr = CategoryService::categoriesToArray($categories);
            echo ResponseService::ok($categoriesArr);
        } catch (\Throwable $th) {
            echo ResponseService::internalErr([
                'message' => $th->getMessage(),
            ]);
        }
    }

    public function getCategoryById()
    {
        try {
            if (!isset($_GET['id']) || $_GET['id'] === '') {
                echo ResponseService::badRequest("param `id` is required");
                return;
            }

            $id = (int) $_GET['id'];
            $cat = Category::find($id);
            if (!isset($cat)) {
                echo ResponseService::notFound("category of id `$id` not found");
                return;
            }

            $cat = $cat->toArray();
            echo ResponseService::ok($cat);
        } catch (\Throwable $th) {
            echo ResponseService::internalErr([
                'message' => $th->getMessage(),
            ]);
        }
    }
    public function createcategory(object $json)
    {
        try {
            $cat = Category::create(['name' => $json->name]);
            echo ResponseService::created($cat->toArray());
        } catch (\Throwable $th) {
            echo ResponseService::internalErr([
                'message' => $th->getMessage(),
            ]);
        }
    }

    // public function updatecategory(object $json)
    // {
    //     try {
    //         if (!isset($_GET["id"]) || $_GET['id'] === '') {
    //             echo ResponseService::badRequest("param `id` is required");
    //             return;
    //         }

    //         $id = (int) $_GET['id'];
    //         $cat = Category::find($id);

    //         if (!isset($cat)) {
    //             echo ResponseService::notFound("Category of id `$id` not found");
    //             return;
    //         }

    //         // This JSON should be validated of course... but it'll pass for now.
    //         $success = $cat->update(get_object_vars($json));

    //         echo $success ?
    //             ResponseService::ok("Updated category of id `$id` successfully.")
    //             : ResponseService::internalErr("Update category unsuccessful. Something went wrong from our side.");
    //     } catch (\Throwable $th) {
    //         echo ResponseService::internalErr([
    //             'message' => $th->getMessage(),
    //         ]);
    //     }
    // }
}