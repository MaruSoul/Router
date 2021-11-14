<?php

namespace Mary\Router;

interface RouteInterface
{
    public function route(string $requestUri);
}
