<?php

use Mary\Router\Router;

require_once(__DIR__ . '/../vendor/autoload.php');

try {

    $url = 'http://my-site.loc/page/view/id/123/';
    $router = new Router('Mary\\Router\\Controller');
    $callable = $router->route($url);

    $result = $callable();

} catch (\Exception $e) {
    echo $e->getMessage();
}
