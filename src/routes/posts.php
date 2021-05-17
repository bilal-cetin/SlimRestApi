<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$app = new \Slim\App;

$app->get('/posts', function (Request $request, Response $response) {
   echo " Postlarrr";
});
