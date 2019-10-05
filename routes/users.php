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
});

$app -> get("/usuarios/:id_user/delete(/)", function($iduser) {
  User::verifyLogin();
  User::verifyAdmin();
});

$app->get("/usuarios/:id_user/senha(/)", function($iduser) {
  User::verifyLogin();
  User::verifyAdmin();
});

$app->post("/usuarios/:id_user/senha(/)", function($iduser) {
  User::verifyLogin();
  User::verifyAdmin();
});

$app->get("/usuarios/:id_user(/)", function($iduser) {
  User::verifyLogin();
  User::verifyAdmin();
});

$app->post("/usuarios/cadastrar(/)", function () {
  User::verifyLogin();
  User::verifyAdmin();
});

$app->post("/usuarios/:id_user(/)", function($iduser) {
  User::verifyLogin();
  User::verifyAdmin();
});
