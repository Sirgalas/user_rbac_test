<?php

declare(strict_types=1);

namespace Infrastructure\Framework\Http\Middleware\ErrorHandler;

use Framework\Http\Middleware\ErrorHandler\ErrorResponseGenerator;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Stratigility\Utils;

class PrettyErrorResponseGenerator  implements ErrorResponseGenerator
{

    private $response;

    public function __construct( ResponseInterface $response, array $views)
    {
        $this->response = $response;
    }

    public function generate(\Throwable $e, ServerRequestInterface $request): ResponseInterface
    {
        $code = Utils::getStatusCode($e, $this->response);

        $response = $this->response->withStatus($code);
        $response
            ->getBody()
            ->write(json_encode([
                'request' => $request,
                'exception' => $e,
            ]));

        return $response;
    }

}