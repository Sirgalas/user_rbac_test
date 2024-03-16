<?php

declare(strict_types=1);

namespace App\Http\Action\Group\Get;

use App\ReadModel\Group\GroupDao;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\JsonResponse;

class Action implements RequestHandlerInterface
{

    private $dao;

    public function __construct(GroupDao $dao)
    {
        $this->dao = $dao;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        return new JsonResponse($this->dao->getAll());
    }
}
