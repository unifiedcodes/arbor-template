<?php


namespace App\web\controllers;

use Arbor\facades\Respond;
use Arbor\http\Response;
use Arbor\http\context\RequestContext;

// error responses can be replaced with custom view template using Respond::errorTemplate method.
class ErrorPages
{
    public function __invoke(RequestContext $input): Response
    {
        return Respond::error(500, 'something went wrong');
    }


    public function notFound(): Response
    {
        return Respond::error(404, 'handler not found');
    }


    public function notAllowed(): Response
    {
        return Respond::error(403, 'not allowed');
    }


    public function methodNotAllowed(): Response
    {
        return Respond::error(405, 'method not allowed');
    }
}
