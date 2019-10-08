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

  $search = (isset($_GET["search"])) ? $_GET["search"] : "";
  $page = (isset($_GET["page"])) ? (int) $_GET["page"] : 1;

  if ($search != "") {
    $pagination = Callcenter::getPageSearch($search, $page);
  } else {
    $pagination = Callcenter::getPage($page);
  }

  $pages = [];

  for ($i = 0; $i < $pagination["pages"]; $i++) {
    array_push($pages, [
      "href" => "/marcacoes?" . http_build_query([
        "page" => $i + 1,
        "search" => $search
      ]),
      "text" => $i + 1
    ]);
  }

  $user = new User();
  $user = User::getFromSession();

  $page = new Page();
  $page->setTpl("navbar");
  $page->setTpl("appointments", [
    "pageTitle" => "Marcações",
    "breadcrumbItem" => "Dashboard",
    "appointments" => "Marcações",
    "logs" => $pagination["data"],
    "search" => $search,
    "pages" => $pages
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

  $user = new User();
  $user = User::getFromSession();

  $log = new Callcenter();
  $log->get((int)$id);

  $page = new Page();
  $page->setTpl("navbar");
  $page->setTpl("appointments-update", [
    "pageTitle" => "Marcações",
    "breadcrumbItem" => "Dashboard",
    "appointments" => "Marcações",
    "log" => $log->getValues(),
    "confirm" => ["S", "N", ""]
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

$app -> post("/marcacoes/:id", function($id) {
  User::verifyLogin();

  $log = new Callcenter();
  $log->get((int)$id);
  $log->setData($_POST);
  $log->update();

  header("Location: /marcacoes");
  exit;
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