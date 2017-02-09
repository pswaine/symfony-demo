<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Debug\Debug;

$environment = getenv('SYMFONY_ENV');
if ($environment === false) {
    $environment = 'prod';
}

if (($useDebugging = getenv('SYMFONY_DEBUG')) === false || $useDebugging === '') {
    $useDebugging = $environment === 'dev';
}

$loader = require __DIR__.'/../app/autoload.php';

if (!$useDebugging) {
    include_once __DIR__ . '/../var/bootstrap.php.cache';
}

require_once __DIR__ . '/../app/AppKernel.php';

if ($useDebugging) {
    Debug::enable();
}

$kernel = new AppKernel($environment, $useDebugging);

if (!$useDebugging) {
    $kernel->loadClassCache();
}

$request = Request::createFromGlobals();
$response = $kernel->handle($request);
$response->send();
$kernel->terminate($request, $response);
