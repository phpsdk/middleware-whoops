<?php

namespace PhpSDK\Http\Middleware\Whoops;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Middleware\ClientMiddlewareInterface;
use Psr\Http\Middleware\DelegateInterface;

/**
 * Class ClientMiddleware.
 */
final class ClientMiddleware extends Middleware implements ClientMiddlewareInterface
{
    /**
     * {@inheritdoc}
     */
    public function process(RequestInterface $request, DelegateInterface $frame): ResponseInterface
    {
        return $this->decorate($request, $frame);
    }
}