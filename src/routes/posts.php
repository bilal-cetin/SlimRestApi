<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$app = new \Slim\App;

$app->get('/posts', function (Request $request, Response $response) {

   $db = new Db();

   try{
      $db = $db->connect();
      echo "herşey yolunda";
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
