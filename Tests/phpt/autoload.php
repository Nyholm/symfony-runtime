<?php

use Symfony\Component\Runtime\SymfonyRuntime;

$_SERVER['APP_RUNTIME_OPTIONS'] = [
    'project_dir' => __DIR__,
];

if (file_exists(dirname(__DIR__, 2).'/vendor/autoload.php')) {
    if (true === (require_once dirname(__DIR__, 2).'/vendor/autoload.php') || empty($_SERVER['SCRIPT_FILENAME'])) {
        return;
    }

    $app = require $_SERVER['SCRIPT_FILENAME'];
    $runtime = new SymfonyRuntime($_SERVER['APP_RUNTIME_OPTIONS']);
    $app = $runtime->resolve($app)();
    exit($runtime->start($app)());
}

if (!file_exists(dirname(__DIR__, 6).'/vendor/autoload_runtime.php')) {
    throw new LogicException('Autoloader not found.');
}

require dirname(__DIR__, 6).'/vendor/autoload_runtime.php';
