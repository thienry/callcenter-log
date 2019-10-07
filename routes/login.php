<?php

use \Fasor\Page;
use \Fasor\Model\User;

$app -> get("/login(/)", function () {
  $erro = isset($_GET['erro']) ? $_GET['erro'] : 0;

  $page = new Page([
    "header" => false,
    "footer" => false
   ]);
   $page -> setTpl("login", [
     "erro"=>$erro
   ]);
});

$app -> post("/login", function () {
  User::login($_POST["login"], $_POST["despassword"]);

  header("Location: /dashboard");
  exit;
});

$app -> get("/cadastro(/)", function () {
  $page = new Page([
    "header" => false,
    "footer" => false
   ]);
   $page -> setTpl("register");
});

$app->post("/cadastro(/)", function () {;
  $user = new User();
  $user -> setData($_POST);
  $user->save();

  header("Location: /login");
  exit;
});

$app -> get("/esqueci-a-senha(/)", function () {
  $page = new Page([
    "header" => false,
    "footer" => false
   ]);
   $page -> setTpl("forgot");
});

$app -> post("/esqueci-a-senha(/)", function () {
  $user = User::getForgot($_POST["email"]);

  header("Location: /esqueci-a-senha/enviada");
  exit;
});

$app -> get("/esqueci-a-senha/enviada(/)", function () {
  $page = new Page([
    "header" => false,
    "footer" => false
   ]);
   $page -> setTpl("forgot-sent");
});

$app -> get("/esqueci-a-senha/recuperar(/)", function () {
  $user = User::validForgotDecrypt($_GET["code"]);

  $page = new Page([
    "header" => false,
    "footer" => false
  ]);
  $page -> setTpl("forgot-reset", [
    "name" => $user["name"],
    "code" => $_GET["code"]
  ]);
});

$app -> post("/esqueci-a-senha/recuperar(/)", function () {
  $forgot = User::validForgotDecrypt($_POST["code"]);
  
  User::setForgotUsed($forgot["id_recovery"]);

  $user = new User();
  $user -> get((int)$forgot["id_user"]);
  $user -> setPassword($_POST["password"]);

  $page = new Page([
    "header" => false,
    "footer" => false
  ]);
  $page -> setTpl("forgot-success");
});
