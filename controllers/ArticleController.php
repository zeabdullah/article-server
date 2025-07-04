<?php

require(__DIR__ . "/../models/Article.php");
require(__DIR__ . "/../services/ArticleService.php");
require(__DIR__ . "/../services/ResponseService.php");

class ArticleController
{
    public function createArticle(object $json)
    {
        try {
            $article = Article::create([
                'name' => $json->name,
                'author' => $json->author,
                'description' => $json->description,
            ]);
            echo ResponseService::created($article->toArray());
        } catch (\Throwable $th) {
            echo ResponseService::internalErr([
                'message' => $th->getMessage(),
            ]);
        }
    }

    public function getArticleById()
    {
        try {
            if (!isset($_GET["id"]) || $_GET['id'] === '') {
                echo ResponseService::badRequest("param `id` is required");
                return;
            }

            $id = $_GET["id"];
            $article = Article::find($id);
            if (!isset($article)) {
                echo ResponseService::notFound("Article of id `$id` not found");
                return;
            }
            $article = $article->toArray();
            echo ResponseService::ok($article);
        } catch (\Throwable $th) {
            echo ResponseService::internalErr([
                'message' => $th->getMessage(),
            ]);
        }
    }
    public function getAllArticles()
    {
        try {
            $articles = Article::all();
            $articles_array = ArticleService::articlesToArray($articles);
            echo ResponseService::ok($articles_array);
        } catch (\Throwable $th) {
            echo ResponseService::internalErr([
                'message' => $th->getMessage(),
            ]);
        }
    }

    public function deleteAllArticles()
    {
        try {
            $success = Article::deleteAll();
            echo $success ?
                ResponseService::ok("Deleted all articles successfully.")
                : ResponseService::internalErr("Deleting articles unsuccessful. Something went wrong from our side.");
        } catch (\Throwable $th) {
            echo ResponseService::badRequest([
                'message' => $th->getMessage()
            ]);
        }
    }
    public function deleteArticleById()
    {
        try {
            if (!isset($_GET["id"]) || $_GET['id'] === '') {
                echo ResponseService::badRequest("param `id` is required");
                return;
            }

            $id = $_GET['id'];
            $article = Article::find($id);

            if (!isset($article)) {
                echo ResponseService::notFound("Article of id `$id` not found");
                return;
            }

            $success = Article::deleteById($id);
            echo $success ?
                ResponseService::ok("Deleted article of id `$id` successfully.")
                : ResponseService::internalErr("Deleting articles unsuccessful. Something went wrong from our side.");
        } catch (\Throwable $th) {
            echo ResponseService::internalErr([
                'message' => $th->getMessage(),
            ]);
        }
    }
}

//To-Do:

//1- Try/Catch in controllers ONLY!!! 
//2- Find a way to remove the hard coded response code (from ResponseService.php)
//3- Include the routes file (api.php) in the (index.php) -- In other words, seperate the routing from the index (which is the engine)
//4- Create a BaseController and clean some imports 