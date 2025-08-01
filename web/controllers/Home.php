<?php

namespace web\controllers;


use Arbor\contracts\handlers\Controller;
use Arbor\http\context\RequestContext;
use Arbor\http\Response;


class Home extends Controller
{
    public function process(RequestContext $input): Response
    {
        return $this->response::json([
            'Welcome to Arbor',
            'this is the minimal setup of a project based on arbor, feel free to customise according to your needs.'
        ]);
    }
}
