<?php

namespace middlewares;


use Arbor\contracts\middleware\StageInterface;
use Arbor\http\context\RequestContext;
use Arbor\http\Response;



class AuthZ implements StageInterface
{
    public function process(RequestContext $input, callable $next): Response
    {
        if (!$this->checkRole()) {
            throw new \Exception("Unauthorized access.");
        }

        return $next($input);
    }


    public function checkRole()
    {
        return true;
    }
}
