<?php
//Routing starts here (Mapping between the request and the controller & method names)
//It's an key-value array where the value is an key-value array
//----------------------------------------------------------

$apis = [
    '/create_article' => [
        'controller' => 'ArticleController',
        'method' => 'createArticle'
    ],
    '/articles' => [
        'controller' => 'ArticleController',
        'method' => 'getAllArticles'
    ],
    '/delete_articles' => [
        'controller' => 'ArticleController',
        'method' => 'deleteAllArticles'
    ],
];

function initApi(string $request)
{
    global $apis;
    if (isset($apis[$request])) {
        $controller_name = $apis[$request]['controller']; //if $request == /articles, then the $controller_name will be "ArticleController" 
        $method = $apis[$request]['method'];
        require_once "controllers/{$controller_name}.php";

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


