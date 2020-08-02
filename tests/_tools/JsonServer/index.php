<?php

/* Créditos pelo json-server:
 * https://devpleno.com/servidor-json-simples-em-php-parte-1/
 * https://jsonplaceholder.typicode.com/guide.html
 */

$router = new class {
    private $getRoutes;
    private $postRoutes;
    private $putRoutes;
    private $patchRoutes;
    private $deleteRoutes;

    public function __call($method, $args){
        $property = "${method}Routes";
        $this->$property[$args[0]] = $args[1];
    }

    public function handler(){
        $method = strtolower($_SERVER['REQUEST_METHOD']);
        $path = $_SERVER['PATH_INFO'] ?? '/';

        $body = file_get_contents('php://input');

        if(strlen($path) > 1)
            $path = rtrim($path, '/');

        $routers = "{$method}Routes";

        if(array_key_exists($path, $this->$routers))
            return $this->$routers[$path]();

        http_response_code(404);
    }
};

// caso existisse um bd.json
//$GLOBALS['bd'] = json_decode(
//    file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'bd.json'),
//    true
//);

$router->get('/posts', function(){
    // caso existisse um bd.json
    // echo json_encode($GLOBALS['bd']);

    header('Content-type: application/json');
    echo json_encode([
        [ "id" => 1, "title" => "json-server", "author" => "typicode" ],
        [ "id" => 2, "title" => "json-php-server", "author" => "dev-pleno" ],
        [ "id" => 3, "title" => "another-json-php-server", "author" => "nenitf" ]
    ]);
});

$router->get('/posts/1', function(){
    header('Content-type: application/json');
    echo json_encode([
        "id" => 1, "title" => "json-server", "author" => "typicode",
    ]);
});

$router->post('/posts', function(){
    header('Content-type: application/json');
    echo json_encode([
        "title" => "new-post", "author" => "your name" ,
    ]);
});

$router->put('/posts/4', function(){
    header('Content-type: application/json');
    echo json_encode([
        "title" => "edited-post", "author" => "your name" ,
    ]);
});

$router->patch('/posts/4', function(){
    header('Content-type: application/json');
    echo json_encode([
        "title" => "half-edited-post", "author" => "your name" ,
    ]);
});

$router->delete('/posts/4', function($request){
    http_response_code(204);
    // empty body
});

$router->handler();
