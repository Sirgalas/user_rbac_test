<?php

declare(strict_types=1);

namespace App\Http\Action\User\Get;

use App\ReadModel\UserDao;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\JsonResponse;

class Action  implements RequestHandlerInterface
{
    /**
     * @var UserDao
     */
    private $dao;

    public function __construct(UserDao $dao)
    {
        $this->dao = $dao;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        return new JsonResponse($this->dao->getAll());
    }
}