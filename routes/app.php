<?php

use \Fasor\Page;
use \Fasor\Model\User;
use \Fasor\Model\Callcenter;

$app -> get("/", function () {
  User::verifyLogin();
  
  header("Location: /dashboard");
  exit;
});

$app->get("/dashboard(/)", function () {
  User::verifyLogin();

  $user = new User();
  $user = User::getFromSession();

  $log1 = Callcenter::listConfirmedTags();
  $log2 = Callcenter::listNoAnswerTags();
  $log3 = Callcenter::listUnmarkedTags();
  $log4 = Callcenter::listTotalTags();

  $page = new Page();
  $page->setTpl("navbar"); 
  $page->setTpl("index", [
    "pageTitle" => "Dashboard",
    "confirmedTags" => $log1,
    "noAnswerTags" => $log2,
    "unmarkedTags" => $log3,
    "totalTags" => $log4,
  ]);
  $page->setTpl("user-side", [
    "title" => "CallCenter Log",
    "username" => "Thiago Moura"
  ]);
  $page->setTpl("menu", [
    "dashboard" => "Dashboard",
    "appointment" => "Marcações",
    "users" => "Usuários",
    "user" => $user->getValues(),
    "isActiveDashboard" => 1,
    "isActiveUsers" => 0,
    "isActiveAppointment" => 0
  ]);
  
});

$app->get("/perfil(/)", function () {
  User::verifyLogin();

  $user = new User();
  $user = User::getFromSession();

  $page = new Page();
  $page->setTpl("navbar"); 
  $page->setTpl("profile", [
    "pageTitle" => "Perfil",
    "breadcrumbItem" => "Dashboard",
    "userProfile" => "Perfil do Usuário"
  ]);
  $page->setTpl("user-side", [
    "title" => "CallCenter Log",
    "username" => "Thiago Moura"
  ]);
  $page->setTpl("menu", [
    "dashboard" => "Dashboard",
    "appointment" => "Marcações",
    "users" => "Usuários",
    "user" => $user->getValues(),
    "isActiveDashboard" => 0,
    "isActiveUsers" => 0,
    "isActiveAppointment" => 0
  ]);
});

$app -> get("/marcacoes(/)", function () {
  User::verifyLogin();

  $user = new User();
  $user = User::getFromSession();

  $log = Callcenter::listAll();

  $page = new Page();
  $page->setTpl("navbar");
  $page->setTpl("appointments", [
    "pageTitle" => "Marcações",
    "breadcrumbItem" => "Dashboard",
    "appointments" => "Marcações",
    "logs" => $log,
  ]);
  $page->setTpl("user-side", [
    "title" => "CallCenter Log",
    "username" => "Thiago Moura"
  ]);
  $page->setTpl("menu", [
    "dashboard" => "Dashboard",
    "appointment" => "Marcações",
    "users" => "Usuários",
    "user" => $user->getValues(),
    "isActiveDashboard" => 0,
    "isActiveUsers" => 0,
    "isActiveAppointment" => 1
  ]);
});

$app -> get("/marcacoes/:id(/)", function ($id) {
  User::verifyLogin();
});

$app -> get("/ausente/lock", function () {
  User::verifyLogin();

  $page = new Page();
  $page->setTpl("lockscreen"); 
});

$app -> get("/logout", function () {
  User::verifyLogin();
  User::logout();

  header("Location: /login");
  exit;
});