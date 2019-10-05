<?php

use \Fasor\Page;
use \Fasor\Model\User;

$app -> get("/login(/)", function () {
  $page = new Page([
    "header" => "header",
    "footer" => "footer"
   ]);
   $page -> setTpl("login");
});

$app -> post("/login", function () {
  User::login($_POST["login"], $_POST["password"]);

  header("Location: /dashboard");
  exit;
});

$app -> get("/cadastro(/)", function () {
  $page = new Page([
    "header" => "header",
    "footer" => "footer"
   ]);
   $page -> setTpl("register");
});

$app -> get("/esqueci-a-senha(/)", function () {
  $page = new Page([
    "header" => "header",
    "footer" => "footer"
   ]);
   $page -> setTpl("forgot");
});

$app -> get("/logout", function () {
  User::logout();

  header("Location: /login");
  exit;
});