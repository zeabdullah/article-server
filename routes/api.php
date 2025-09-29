<?php
require_once(__DIR__ . '/../helpers/helpers.php');

//Routing starts here (Mapping between the request and the controller & method names)
//It's an key-value array where the value is an key-value array
//----------------------------------------------------------
$apis = [
    '/_run_migrations' => [
        'controller' => 'AdminController',
        'method' => 'runMigrations'
    ],

    '/create_article' => [
        'controller' => 'ArticleController',
        'method' => 'createArticle'
    ],
    '/article' => [
        'controller' => 'ArticleController',
        'method' => 'getArticleById'
    ],
    '/articles' => [
        'controller' => 'ArticleController',
        'method' => 'getAllArticles'
    ],
    '/delete_article' => [
        'controller' => 'ArticleController',
        'method' => 'deleteArticleById'
    ],
    '/delete_articles' => [
        'controller' => 'ArticleController',
        'method' => 'deleteAllArticles'
    ],
    '/update_article' => [
        'controller' => 'ArticleController',
        'method' => 'updateArticle'
    ],

    '/category' => [
        'controller' => 'CategoryController',
        'method' => 'getCategoryById'
    ],
    '/categories' => [
        'controller' => 'CategoryController',
        'method' => 'getAllCategories'
    ],
    '/create_category' => [
        'controller' => 'CategoryController',
        'method' => 'createCategory'
    ],
    '/update_category' => [
        'controller' => 'CategoryController',
        'method' => 'updateCategory'
    ],
    '/delete_category' => [
        'controller' => 'CategoryController',
        'method' => 'deleteCategoryById'
    ],
    '/delete_categories' => [
        'controller' => 'CategoryController',
        'method' => 'deleteAllCategories'
    ],
];

function runApi(string $request)
{
    global $apis;
    if (isset($apis[$request])) {
        $controller_name = $apis[$request]['controller']; //if $request == /articles, then the $controller_name will be "ArticleController" 
        $method = $apis[$request]['method'];
        require_once __DIR__ . "/../controllers/{$controller_name}.php";

        $controller = new $controller_name();

        if (method_exists($controller, $method)) {
            $controller->$method(getRequestBodyAsJson());
        } else {
            echo "Error: Method {$method} not found in {$controller_name}.";
        }
    } else {
        echo "404 Not Found";
    }
}


