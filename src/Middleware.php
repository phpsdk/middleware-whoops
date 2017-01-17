<?php

namespace PhpSDK\Http\Middleware\Whoops;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Middleware\DelegateInterface;
use Throwable;
use Whoops\Run;

/**
 * Class Middleware.
 */
abstract class Middleware
{
    /**
     * @var Run
     */
    private $whoops;

    /**
     * @var ResponseInterface
     */
    private $prototype;

    /**
     * Constructor.
     *
     * @param Run $whoops
     * @param ResponseInterface $prototype
     */
    public function __construct(Run $whoops, ResponseInterface $prototype)
    {
        $this->whoops = $whoops;
        $this->prototype = $prototype;

        $this->whoops->register();
        $this->whoops->writeToOutput(false);
        $this->whoops->allowQuit(false);
    }

    /**
     * Decorates request handling to catch throwable error to handle with Whoops.
     *
     * @param RequestInterface $request
     * @param DelegateInterface $frame
     *
     * @return ResponseInterface
     */
    final protected function decorate(RequestInterface $request, DelegateInterface $frame): ResponseInterface
    {
        try {
            return $frame->next($request);
        } catch (Throwable $e) {
            $method = Run::EXCEPTION_HANDLER;

            $output = $this->whoops->{$method}($e);

            $body = $this->prototype->getBody();
            $body->write($output);
            $body->rewind();

            $response = $this->prototype->withBody($body);

            return $response;
        }
    }
}