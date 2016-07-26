<?php
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Origin:*");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization");

session_start();


//require __DIR__.'/control/controle.php';


require 'Slim/Slim.php';
\Slim\Slim::registerAutoloader();
$app = new \Slim\Slim(array(
    'debug' => true
        ));

$app->contentType("application/json");

$app->error(function ( Exception $e = null) use ($app) {
         echo '{"error":{"text":"'. $e->getMessage() .'"}}';
        });

//GET pode possuir um parametro na URL
$app->get('/:controller/:action(/:parameter)', function ($controller, $action, $parameter = null) use($app) {
            
            include_once "control/{$controller}.php";
            $classe = new $controller();
            $retorno = call_user_func_array(array($classe, "get_" . $action), array($parameter));
            echo '{"result":' . json_encode($retorno) . '}';
        });

//POST não possui parâmetros na URL, e sim na requisição

$app->post('/:controller/:action', function ($controller, $action) use ($app) {
    
            $request = json_decode(\Slim\Slim::getInstance()->request()->getBody());           
            include_once "control/{$controller}.php";
            $classe = new $controller();
            
            $retorno = call_user_func_array(array($classe, "post_" . $action), array($request));
             echo '{"result":' . json_encode($retorno) . '}';       });

$app->run();

if($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
   header( "HTTP/1.1 200 OK" );
   exit();
}