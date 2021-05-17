<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$app = new \Slim\App;

//Posts

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

//Comments

$app->get('/comments', function (Request $request, Response $response) {

   $db = new Db();

   try{
      $db = $db->connect();
      
      $comments = $db->query("SELECT * FROM comments")->fetchAll(PDO::FETCH_OBJ);

      return $response
         ->withStatus(200)
         ->withHeader("Content-Type", 'application/json')
         ->withJson($comments);



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

//Comments who belongs to post id
$app->get('/posts/{post_id}/comments', function (Request $request, Response $response) {

   $post_id = $request->getAttribute("post_id");
   $db = new Db();

   try{
      $db = $db->connect();
      
      $pcomments = $db->query("SELECT * FROM comments WHERE postId = $post_id")->fetchAll(PDO::FETCH_OBJ);

      return $response
         ->withStatus(200)
         ->withHeader("Content-Type", 'application/json')
         ->withJson($pcomments);



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

