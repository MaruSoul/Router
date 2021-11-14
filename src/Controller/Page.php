<?php

namespace Mary\Router\Controller;

class Page
{
    public static function view(array $params = [])
    {
        echo 'We in ' . __CLASS__ . '::' . __METHOD__ . PHP_EOL;
        var_dump($params);
    }
}
