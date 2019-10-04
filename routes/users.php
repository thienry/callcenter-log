<?php

use Fasor\Page;

$app->get("/usuarios", function () {
  $page = new Page();
  $page->setTpl("navbar");
  $page->setTpl("users", [
    "pageTitle" => "Usuários",
    "dashboard" => "Dashboard",
    "users" => "Usuários"
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