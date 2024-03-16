<?php

declare(strict_types=1);

namespace App\Http\Action\User\One;

use App\UseCase\User\One;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\JsonResponse;

class Action implements RequestHandlerInterface
{
    private $handler;

    public function __construct(One\UserHandler $handler)
    {
        $this->handler = $handler;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $data = new One\RequestData($request->getAttributes());
        return new JsonResponse($this->handler->handle($data));
    }
}