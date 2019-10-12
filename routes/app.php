<?php

use \Fasor\Page;
use \Fasor\Model\User;
use \Fasor\Model\Callcenter;
use \Fasor\Model\ImageUpload;

$app -> get("/", function () {
  User::verifyLogin();
  
  header("Location: /dashboard");
  exit;
});

$app->get("/dashboard(/)", function () {
  User::verifyLogin();

  $user = new User();
  $user = User::getFromSession();

  $imageUpload = new ImageUpload();

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
    "image" => $imageUpload->getValues(),
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

$app->post("/dashboard", function () {
  $log1 = Callcenter::listConfirmedTags();
  $log2 = Callcenter::listNoAnswerTags();
  $log3 = Callcenter::listUnmarkedTags();

  $data = [$log1, $log2, $log3];
  var_dump($data);
  exit;
});
  
$app->get("/perfil(/)", function () {
  User::verifyLogin();  
  $user = new User();
  $user = User::getFromSession();

  $imageUpload = new ImageUpload();
    
  $page = new Page();
  $page->setTpl("navbar"); 
  $page->setTpl("profile", [
    "pageTitle" => "Perfil",
    "breadcrumbItem" => "Dashboard",
    "userProfile" => "Perfil do Usuário",
    "img" => $imageUpload->getValues()
  ]);
  $page->setTpl("user-side", [
    "title" => "CallCenter Log",
    "image" => $imageUpload->getValues(),
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
        
$app->post("/perfil", function () {
  User::verifyLogin();
  User::getFromSession();

  $imageUpload = new ImageUpload();
  $imageUpload->setData($_POST);
   
  if ((int)$_FILES["file"]["size"] > 0) {
   $imageUpload->setPhoto($_FILES["file"]);
  }

  header("Location: /perfil");
  exit;
});
       
$app -> get("/marcacoes(/)", function () {
  User::verifyLogin();

  $imageUpload = new ImageUpload();

  $search = (isset($_GET["search"])) ? $_GET["search"] : "";
  $dtini = (isset($_GET["dtini"])) ? $_GET["dtini"] : '2019-07-22';
  $dtend = (isset($_GET["dtend"])) ? $_GET["dtend"] : '2019-07-22';
  $page = (isset($_GET["page"])) ? (int) $_GET["page"] : 1;

  if ($search != "") {
    $pagination = Callcenter::getPageSearch($search, $dtini, $dtend, $page);
  } else {
    $pagination = Callcenter::getPage($page);
  }

  $pages = [];

  for ($i = 0; $i < $pagination["pages"]; $i++) {
    array_push($pages, [
      "href" => "/marcacoes?" . http_build_query([
        "page" => $i + 1,
        "search" => $search,
        "dtini" => $dtini,
        "dtend" => $dtend,
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
    "dtini" => $dtini,
    "dtend" => $dtend,
    "pages" => $pages,
  ]);
  $page->setTpl("user-side", [
    "title" => "CallCenter Log",
    "image" => $imageUpload->getValues(),
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

  $imageUpload = new ImageUpload();

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
    "image" => $imageUpload->getValues(),
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