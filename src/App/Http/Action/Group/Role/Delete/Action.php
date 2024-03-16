<?php

declare(strict_types=1);

namespace App\Http\Action\Group\Role\Delete;

use App\UseCase\Group\Role\Delete;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\JsonResponse;

class Action implements RequestHandlerInterface
{

    private $handler;

    public function __construct(Delete\Handler $handler)
    {
        $this->handler = $handler;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $data = new Delete\RequestData($request->getAttributes());
        return new JsonResponse($this->handler->handle($data));
    }
}