<?php

use \Fasor\Page;

$app->get("/dashboard", function () {
  $page = new Page();
  $page->setTpl("navbar"); 
  $page->setTpl("index", [
    "pageTitle" => "Dashboard"
  ]);
  $page->setTpl("user-side", [
    "title" => "CallCenter Log",
    "username" => "Thiago Moura"
  ]);
  $page->setTpl("menu", [
    "dashboard" => "Dashboard",
    "appointment" => "Marcações",
    "users" => "Usuários",
    "isActiveDashboard" => 1,
    "isActiveUsers" => 0,
    "isActiveAppointment" => 0
  ]);
  
});

$app->get("/perfil", function () {
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
    "isActiveDashboard" => 0,
    "isActiveUsers" => 1,
    "isActiveAppointment" => 0
  ]);
});

$app -> get("/marcacoes", function () {
  $page = new Page();
  $page->setTpl("navbar");
  $page->setTpl("appointments", [
    "pageTitle" => "Marcações",
    "breadcrumbItem" => "Dashboard",
    "appointments" => "Marcações"
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
    "isActiveUsers" => 0,
    "isActiveAppointment" => 1
  ]);
});
