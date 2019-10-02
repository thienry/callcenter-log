<?php

session_start();
require_once("vendor/autoload.php");

use \Slim;
use \Fasor\Page;

$app = new Slim;

$app->config("debug", true);

$app->notFound(function () use ($app) {
  $page = new Page([
    "header" => false,
    "footer" => false
  ]);
  $page->setTpl("error");
});

require_once("routes/app.php");
require_once("routes/login.php");
require_once("routes/users.php");

$app->run();
