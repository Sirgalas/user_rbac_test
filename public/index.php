<?php

use Laminas\Diactoros\Response\HtmlResponse;
use Laminas\Diactoros\ServerRequestFactory;
use Laminas\HttpHandlerRunner\Emitter\SapiEmitter;
use UserRbacFramework\Route\AuraRouterAdapter;
use UserRbacFramework\Route\Exeption\RequestNotMatchedException;
use UserRbacFramework\ActionResolver;

chdir(dirname(__DIR__));
require 'vendor/autoload.php';
require_once 'config/bootstrap.php';
$routes = require 'config/route.php';


$router = new AuraRouterAdapter($routes);
$resolver = new ActionResolver();
$request = ServerRequestFactory::fromGlobals();

try {
    $result = $router->match($request);
    foreach ($result->getAttributes() as $attribute => $value) {
        $request = $request->withAttribute($attribute, $value);
    }
    $handler = $result->getHandler();
    /** @var callable $action */
    $action = $resolver->resolve($result->getHandler());
    $response = $action($request);
} catch (RequestNotMatchedException $e){
    $response = new HtmlResponse('Undefined page', 404);
}



$emitter = new SapiEmitter();
$emitter->emit($response);

