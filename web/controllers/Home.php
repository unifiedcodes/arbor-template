<?php

namespace App\web\controllers;

use Arbor\facades\Respond;
use Arbor\http\Response;
use Arbor\http\context\RequestContext;


class Home
{
    public function __invoke(RequestContext $input): Response
    {
        return Respond::json([
            'Welcome to Arbor',
            'this is the minimal setup of a project based on arbor, feel free to customise according to your needs.'
        ]);
    }
}
