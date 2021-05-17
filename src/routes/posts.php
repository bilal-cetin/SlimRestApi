<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$app = new \Slim\App;

$app->get('/posts', function (Request $request, Response $response) {

   $db = new Db();

   try{
      $db = $db->connect();
      
      $posts = $db->query("SELECT * FROM posts")->fetchAll(PDO::FETCH_OBJ);

      return $response
         ->withStatus(200)
         ->withHeader("Content-Type", 'application/json')
         ->withJson($posts);



   }catch(PDOException $e){
      return $response->withJson(
         array(
            "error" => array(
               "text" => $e->getMessage(),
               "code" => $e->getCode()
            )
         )
      );
   }



   $db = null;
});
