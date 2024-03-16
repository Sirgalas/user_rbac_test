<?php

declare(strict_types=1);

namespace App\Http\Action\Group\Role\Add;

use App\UseCase\Group\Role\Add;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\JsonResponse;

class Action implements RequestHandlerInterface
{

    private $handler;

    public function __construct(Add\Handler $handler)
    {
        $this->handler = $handler;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $data = new Add\RequestData($request->getAttributes());
        return new JsonResponse($this->handler->handle($data));
    }
}
