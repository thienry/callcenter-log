<?php

use Fasor\Page;
use \Fasor\Model\User; 

$app->get("/usuarios(/)", function () {
  User::verifyLogin();
  User::verifyAdmin();
  $users = User::listAll();


  $page = new Page();
  $page->setTpl("navbar");
  $page->setTpl("users", [
    "pageTitle" => "Usuários",
    "dashboard" => "Dashboard",
    "users" => "Usuários",
    "usersdb" => $users
  ]);
  $page->setTpl("user-side", [
    "title" => "CallCenter Log",
    "username" => "Thiago Moura"
  ]);
  $page->setTpl("menu", [
    "dashboard" => "Dashboard",
    "appointment" => "Marcações",
    "users" => "Usuários",
    "isActiveDashboard" => 0,
    "isActiveUsers" => 1,
    "isActiveAppointment" => 0
  ]);
});

$app->get("/usuarios/cadastrar(/)", function () {
  User::verifyLogin();
  User::verifyAdmin();

  $page = new Page();
  $page->setTpl("navbar");
  $page->setTpl("users-create", [
    "pageTitle" => "Usuários",
    "dashboard" => "Dashboard",
    "users" => "Usuários",
  ]);
  $page->setTpl("user-side", [
    "title" => "CallCenter Log",
    "username" => "Thiago Moura"
  ]);
  $page->setTpl("menu", [
    "dashboard" => "Dashboard",
    "appointment" => "Marcações",
    "users" => "Usuários",
    "isActiveDashboard" => 0,
    "isActiveUsers" => 1,
    "isActiveAppointment" => 0
  ]);
});

$app->get("/usuarios/:id_user/senha(/)", function($iduser) {
  User::verifyLogin();
  User::verifyAdmin();

  $page = new Page();
  $page->setTpl("navbar");
  $page->setTpl("users-password", [
    "pageTitle" => "Usuários",
    "dashboard" => "Dashboard",
    "users" => "Usuários",
  ]);
  $page->setTpl("user-side", [
    "title" => "CallCenter Log",
    "username" => "Thiago Moura"
  ]);
  $page->setTpl("menu", [
    "dashboard" => "Dashboard",
    "appointment" => "Marcações",
    "users" => "Usuários",
    "isActiveDashboard" => 0,
    "isActiveUsers" => 1,
    "isActiveAppointment" => 0
  ]);
});

$app->post("/usuarios/:id_user/senha(/)", function($iduser) {
  User::verifyLogin();
  User::verifyAdmin();
});

$app->get("/usuarios/:id_user(/)", function($iduser) {
  User::verifyLogin();
  User::verifyAdmin();

  $user = new User();
  $user->get((int)$iduser);

  $page = new Page();
  $page->setTpl("navbar");
  $page->setTpl("users-update", [
    "pageTitle" => "Usuários",
    "dashboard" => "Dashboard",
    "users" => "Usuários",
    "user" => $user -> getValues()
  ]);
  $page->setTpl("user-side", [
    "title" => "CallCenter Log",
    "username" => "Thiago Moura"
  ]);
  $page->setTpl("menu", [
    "dashboard" => "Dashboard",
    "appointment" => "Marcações",
    "users" => "Usuários",
    "isActiveDashboard" => 0,
    "isActiveUsers" => 1,
    "isActiveAppointment" => 0
  ]);
});

$app -> get("/usuarios/:id_user/delete(/)", function($iduser) {
  User::verifyLogin();
  User::verifyAdmin();

  $user = new User();
  $user->get((int)$iduser);
  $user->delete();

  header("Location: /usuarios");
  exit;
});

$app->post("/usuarios/cadastrar(/)", function () {
  User::verifyLogin();
  User::verifyAdmin();

  $_POST["admin"] = (isset($_POST["admin"])) ? 1 : 0;

  $user = new User();
  $user->setData($_POST);
  $user->save();

  header("Location: /usuarios");
  exit;
});

$app->post("/usuarios/:id_user(/)", function($iduser) {
  User::verifyLogin();
  User::verifyAdmin();

  $_POST["admin"] = (isset($_POST["admin"])) ? 1 : 0;

  $user = new User();
  $user->get((int)$iduser);
  $user->setData($_POST);
  $user->update();

  header("Location: /usuarios");
  exit;
});
