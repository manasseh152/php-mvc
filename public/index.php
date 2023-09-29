<?php

require_once '../vendor/autoload.php';
require_once '../src/Support/helpers.php';
require_once '../src/Application.php';

$app = new \Src\Application();

$app->loadEnv();
$app->init();
