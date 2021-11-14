<?php

namespace Mary\Router;

use Exception;

class ResourceNotFoundException extends Exception
{
    protected $message = 'Resource not found';
}
