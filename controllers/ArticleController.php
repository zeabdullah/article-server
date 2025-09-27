<?php

require(__DIR__ . "/../models/Article.php");
require(__DIR__ . "/../services/ArticleService.php");

class ArticleController extends Controller
{
    public function createArticle(object $json)
    {
        try {
            $article = Article::create([
                'name' => $json->name,
                'author' => $json->author,
                'description' => $json->description,
            ]);
            echo $this->createdResponse($article->toArray());
        } catch (\Throwable $th) {
            echo $this->internalErrResponse([
                'message' => $th->getMessage(),
            ]);
        }
    }

    public function getArticleById()
    {
        try {
            if (!isset($_GET['id']) || $_GET['id'] === '') {
                echo $this->badRequestResponse("param `id` is required");
                return;
            }

            $id = (int) $_GET['id'];
            $article = Article::find($id);
            if (!isset($article)) {
                echo $this->notFoundResponse("Article of id `$id` not found");
                return;
            }
            $article = $article->toArray();
            echo $this->okResponse($article);
        } catch (\Throwable $th) {
            echo $this->internalErrResponse([
                'message' => $th->getMessage(),
            ]);
        }
    }
    public function getAllArticles()
    {
        try {
            $articles = Article::all();
            $articles_array = ArticleService::articlesToArray($articles);
            echo $this->okResponse($articles_array);
        } catch (\Throwable $th) {
            echo $this->internalErrResponse([
                'message' => $th->getMessage(),
            ]);
        }
    }

    public function deleteAllArticles()
    {
        try {
            $success = Article::deleteAll();
            echo $success ?
                $this->okResponse("Deleted all articles successfully.")
                : $this->internalErrResponse("Deleting articles unsuccessful. Something went wrong from our side.");
        } catch (\Throwable $th) {
            echo $this->badRequestResponse([
                'message' => $th->getMessage()
            ]);
        }
    }
    public function deleteArticleById()
    {
        try {
            if (!isset($_GET['id']) || $_GET['id'] === '') {
                echo $this->badRequestResponse("param `id` is required");
                return;
            }

            $id = (int) $_GET['id'];
            $article = Article::find($id);

            if (!isset($article)) {
                echo $this->notFoundResponse("Article of id `$id` not found");
                return;
            }

            $success = Article::deleteById($id);
            echo $success ?
                $this->okResponse("Deleted article of id `$id` successfully.")
                : $this->internalErrResponse("Deleting article unsuccessful. Something went wrong from our side.");
        } catch (\Throwable $th) {
            echo $this->internalErrResponse([
                'message' => $th->getMessage(),
            ]);
        }
    }

    public function updateArticle(object $json)
    {
        try {
            if (!isset($_GET["id"]) || $_GET['id'] === '') {
                echo $this->badRequestResponse("param `id` is required");
                return;
            }

            $id = (int) $_GET['id'];
            $article = Article::find($id);

            if (!isset($article)) {
                echo $this->notFoundResponse("Article of id `$id` not found");
                return;
            }

            $success = $article->update(get_object_vars($json));

            echo $success ?
                $this->okResponse("Updated article of id `$id` successfully.")
                : $this->internalErrResponse("Update article unsuccessful. Something went wrong from our side.");
        } catch (\Throwable $th) {
            echo $this->internalErrResponse([
                'message' => $th->getMessage(),
            ]);
        }
    }
}

//To-Do:

//4- Create a BaseController and clean some imports 