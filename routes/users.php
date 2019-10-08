<?php

use Fasor\Page;
use \Fasor\Model\User; 

$app->get("/usuarios(/)", function () {
  User::verifyLogin();
  User::verifyAdmin();

  $search = (isset($_GET["search"])) ? $_GET["search"] : "";
  $page = (isset($_GET["page"])) ? (int)$_GET["page"] : 1;
  
  if ($search != "") {
    $pagination = User::getPageSearch($search, $page);
  } else {
    $pagination = User::getPage($page);
  }

  $pages = [];

  for ($i=0; $i < $pagination["pages"]; $i++) { 
    array_push($pages, [
      "href"=>"/usuarios?".http_build_query([
        "page"=>$i + 1,
        "search"=>$search
      ]),
      "text"=>$i + 1
    ]);
  }

  $user = new User();
  $user = User::getFromSession();

  $page = new Page();
  $page->setTpl("navbar");
  $page->setTpl("users", [
    "pageTitle" => "Usuários",
    "dashboard" => "Dashboard",
    "users" => "Usuários",
    "usersdb" => $pagination["data"],
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
    "isActiveUsers" => 1,
    "isActiveAppointment" => 0
  ]);
});

$app->get("/usuarios/cadastrar(/)", function () {
  User::verifyLogin();
  User::verifyAdmin();

  $user = new User();
	$user = User::getFromSession();

  $page = new Page();
  $page->setTpl("navbar");
  $page->setTpl("users-create", [
    "pageTitle" => "Usuários",
    "dashboard" => "Dashboard",
    "users" => "Usuários",
    "user"=>$user->getValues()
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

  $user = new User();
  $user = User::getFromSession();
  $user -> get((int)$iduser);

  $page = new Page();
  $page->setTpl("navbar");
  $page->setTpl("users-password", [
    "pageTitle" => "Usuários",
    "dashboard" => "Dashboard",
    "users" => "Usuários",
    "user" => $user -> getValues(),
    "msgSuccess" => User::getSuccess(),
    "msgError" => User::getError()
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
    "isActiveUsers" => 1,
    "isActiveAppointment" => 0
  ]);
});

$app->post("/usuarios/:id_user/senha(/)", function($iduser) {
  User::verifyLogin();
  User::verifyAdmin();

  if (!isset($_POST["despassword"]) || $_POST["despassword"] === "") {
    User::setError("Preencha a Nova Senha.");
    header("Location: /usuarios/$iduser/senha");
    exit;
  }

  if (!isset($_POST["confirmPassword"]) || $_POST["confirmPassword"] === "") {
    User::setError("Preencha a Confirmação da Nova Senha.");
    header("Location: /usuarios/$iduser/senha");
    exit;
  }

  if ($_POST["despassword"] !== $_POST["confirmPassword"]) {
    User::setError("Confirme Corretamente as Senhas.");
    header("Location: /usuarios/$iduser/senha");
    exit;
  }

  $user = new User();  
	$user->get((int)$iduser);
  $user->setPassword(User::getPasswordHash($_POST["despassword"]));

  User::setSuccess("Senha Alterada Com Successo.");
  header("Location: /usuarios/$iduser/senha");
  exit;

});

$app->get("/usuarios/:id_user(/)", function($iduser) {
  User::verifyLogin();
  User::verifyAdmin();

  $user = new User();  
  $user = User::getFromSession();
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
    "user" => $user->getValues(),
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
  
  $user = new User();

  $_POST["admin"] = (isset($_POST["admin"])) ? 1 : 0;
  $user->setData($_POST);
  $user->save();

  header("Location: /usuarios");
  exit;
});

$app->post("/usuarios/:id_user(/)", function($iduser) {
  User::verifyLogin();
  User::verifyAdmin();
  
  $user = new User();

  $_POST["admin"] = (isset($_POST["admin"])) ? 1 : 0;

  $user->get((int)$iduser);
  $user->setData($_POST);
  $user->update();

  header("Location: /usuarios");
  exit;
});
