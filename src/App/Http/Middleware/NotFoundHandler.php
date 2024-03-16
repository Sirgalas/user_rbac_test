<?php

namespace App\Http\Middleware;

use Framework\Template\TemplateRenderer;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\JsonResponse;

class NotFoundHandler implements RequestHandlerInterface
{


    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        return new JsonResponse(['error' => 'Not Found',404]);
    }
}
