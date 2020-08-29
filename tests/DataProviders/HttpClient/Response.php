<?php

namespace Tests\DataProviders\HttpClient;

class Response {
    protected $baseUrl = "http://localhost:7845";
    public function caminhosFelizes() {

        $endpoint = "{$this->baseUrl}/posts";

        yield "get for {$endpoint}/posts" => [
            "get", $endpoint, [
                [ "id" => 1, "title" => "json-server", "author" => "typicode" ],
                [ "id" => 2, "title" => "json-php-server", "author" => "dev-pleno" ],
                [ "id" => 3, "title" => "another-json-php-server", "author" => "nenitf" ]
            ]
        ];

        $endpoint = "{$this->baseUrl}/posts/1";
        yield "get for $endpoint" => [
            "get", $endpoint, [ "id" => 1, "title" => "json-server", "author" => "typicode" ],
        ];
    }
}
