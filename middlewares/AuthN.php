<?php

namespace middlewares;


use Arbor\contracts\middleware\StageInterface;
use Arbor\http\context\RequestContext;
use Arbor\http\Response;



class AuthN implements StageInterface
{
    public function process(RequestContext $input, callable $next): Response
    {
        if (!$this->checkuser()) {
            return new Response('Authentication Failed', 503);
        }

        return $next($input);
    }

    public function checkuser()
    {
        return true;
    }
}
