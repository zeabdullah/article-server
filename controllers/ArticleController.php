<?php

require(__DIR__ . "/../models/Article.php");
require(__DIR__ . "/../services/ArticleService.php");
require(__DIR__ . "/../services/ResponseService.php");

class ArticleController
{
    public function createArticle(object $json)
    {
        $article = Article::create([
            'name' => $json->name,
            'author' => $json->author,
            'description' => $json->description,
        ]);
        echo ResponseService::created($article->toArray());
    }

    public function getArticleById()
    {
        if (!isset($_GET["id"]) || $_GET['id'] === '') {
            echo ResponseService::badRequest('param `id` is required');
            return;
        }

        $id = $_GET["id"];
        $article = Article::find($id);

        if (isset($article)) {
            $article = $article->toArray();
            echo ResponseService::ok($article);
        } else {
            echo ResponseService::notFound("Article of id `$id` not found");
        }
    }
    public function getAllArticles()
    {
        $articles = Article::all();
        $articles_array = ArticleService::articlesToArray($articles);
        echo ResponseService::ok($articles_array);
    }

    public function deleteAllArticles()
    {
        die("Deleting...");
    }
}

//To-Do:

//1- Try/Catch in controllers ONLY!!! 
//2- Find a way to remove the hard coded response code (from ResponseService.php)
//3- Include the routes file (api.php) in the (index.php) -- In other words, seperate the routing from the index (which is the engine)
//4- Create a BaseController and clean some imports 