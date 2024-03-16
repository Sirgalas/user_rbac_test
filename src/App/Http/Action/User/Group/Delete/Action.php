<?php

declare(strict_types=1);

namespace App\Http\Action\User\Group\Delete;

use App\UseCase\User\Group\Delete;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\JsonResponse;

class Action implements RequestHandlerInterface
{

    private $handler;

    public function __construct(Delete\UserHandler $handler){
        $this->handler = $handler;
    }
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $data = new Delete\RequestData($request->getAttributes());
        return new JsonResponse($this->handler->handle($data));
    }
}