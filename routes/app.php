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
  $page->setTpl("menu");
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
  $page->setTpl("menu");
});
