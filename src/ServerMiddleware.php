<?php

namespace PhpSDK\Http\Middleware\Whoops;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Middleware\DelegateInterface;
use Psr\Http\Middleware\ServerMiddlewareInterface;

/**
 * Class ServerMiddleware.
 */
final class ServerMiddleware extends Middleware implements ServerMiddlewareInterface
{
    /**
     * {@inheritdoc}
     */
    public function process(ServerRequestInterface $request, DelegateInterface $frame): ResponseInterface
    {
        return $this->decorate($request, $frame);
    }
}