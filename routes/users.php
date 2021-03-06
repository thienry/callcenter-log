<?php

use Fasor\Page;
use \Fasor\Model\User;
use \Fasor\Model\ImageUpload;

$app->get("/usuarios(/)", function () {
  User::verifyLogin();
  User::verifyAdmin();

  $success = isset($_GET["success"]) ? $_GET["success"] : 0;
  $error = isset($_GET["error"]) ? $_GET["error"] : 0;
  $search = (isset($_GET["search"])) ? $_GET["search"] : "";
  $page = (isset($_GET["page"])) ? (int) $_GET["page"] : 1;

  $imageUpload = new ImageUpload();

  $user = new User();
  $user = User::getFromSession();

  if ($search != "") {
    $pagination = User::getPageSearch($search, $page);
  } else {
    $pagination = User::getPage($page);
  }

  $one = 1;
  $pages = [];

  $first = "/usuarios" . "?page=" . $one . "&search=" . $search;
  $last = "/usuarios" . "?page=" . (int) $pagination["pages"] . "&search=" . $search;

  $a = explode("&", $first);
  $a = substr($a[0], 15, strlen($a[0]));

  $b = explode("&", $last);
  $b = substr($b[0], 15, strlen($b[0]));

  $firstPage = (($a == $page) == true);
  $lastPage = (($b == $page) == true);

  $linksLimit = 2;
  $start = ((($page - $linksLimit) > 1) ? $page - $linksLimit : 1);
  $end = ((($page + $linksLimit) < $pagination["pages"]) ? $page + $linksLimit : $pagination["pages"]);


  if ($pagination["pages"] > 1 && $page <= $pagination["pages"]) {
    for ($i = $start; $i <= $end; $i++) {
      array_push($pages, [
        "link" => "/usuarios?" . http_build_query([
          "page" => $i,
          "search" => $search
        ]),
        "text" => $i,
        "active" => $i == $page,
      ]);
    }
  }

  $page = new Page();
  $page->setTpl("navbar");
  $page->setTpl("users", [
    "pageTitle" => "Usuários",
    "dashboard" => "Dashboard",
    "users" => "Usuários",
    "usersdb" => $pagination["data"],
    "search" => $search,
    "pages" => $pages,
    "firstPage" => $firstPage,
    "lastPage" => $lastPage,
    "first" => $first,
    "last" => $last,
    "success" => $success,
    "error" => $error
  ]);
  $page->setTpl("user-side", [
    "title" => "CallCenter Log",
    "image" => $imageUpload->getValues(),
  ]);
  $page->setTpl("menu", [
    "dashboard" => "Dashboard",
    "appointment" => "Marcações",
    "users" => "Usuários",
    "report" => "Relatório",
    "isActiveReport" => 0,
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

  $imageUpload = new ImageUpload();

  $page = new Page();
  $page->setTpl("navbar");
  $page->setTpl("users-create", [
    "pageTitle" => "Usuários",
    "dashboard" => "Dashboard",
    "users" => "Usuários",
    "user" => $user->getValues(),
  ]);
  $page->setTpl("user-side", [
    "title" => "CallCenter Log",
    "image" => $imageUpload->getValues(),
  ]);
  $page->setTpl("menu", [
    "dashboard" => "Dashboard",
    "appointment" => "Marcações",
    "users" => "Usuários",
    "report" => "Relatório",
    "isActiveReport" => 0,
    "isActiveDashboard" => 0,
    "isActiveUsers" => 1,
    "isActiveAppointment" => 0
  ]);
});

$app->get("/usuarios/:id_user/senha(/)", function ($iduser) {
  User::verifyLogin();
  User::verifyAdmin();

  $user = new User();
  $user = User::getFromSession();
  $user->get((int) $iduser);

  $imageUpload = new ImageUpload();

  $page = new Page();
  $page->setTpl("navbar");
  $page->setTpl("users-password", [
    "pageTitle" => "Usuários",
    "dashboard" => "Dashboard",
    "users" => "Usuários",
    "user" => $user->getValues(),
    "msgSuccess" => User::getSuccess(),
    "msgError" => User::getError()
  ]);
  $page->setTpl("user-side", [
    "title" => "CallCenter Log",
    "image" => $imageUpload->getValues(),
  ]);
  $page->setTpl("menu", [
    "dashboard" => "Dashboard",
    "appointment" => "Marcações",
    "users" => "Usuários",
    "report" => "Relatório",
    "isActiveReport" => 0,
    "user" => $user->getValues(),
    "isActiveDashboard" => 0,
    "isActiveUsers" => 1,
    "isActiveAppointment" => 0
  ]);
});

$app->post("/usuarios/:id_user/senha(/)", function ($iduser) {
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
  $user->get((int) $iduser);
  $user->setPassword(User::getPasswordHash($_POST["despassword"]));

  User::setSuccess("Senha Alterada Com Successo.");
  header("Location: /usuarios?success=2");
  exit;
});

$app->get("/usuarios/:id_user(/)", function ($iduser) {
  User::verifyLogin();
  User::verifyAdmin();

  $user = new User();
  $user = User::getFromSession();
  $user->get((int) $iduser);

  $imageUpload = new ImageUpload();

  $page = new Page();
  $page->setTpl("navbar");
  $page->setTpl("users-update", [
    "pageTitle" => "Usuários",
    "dashboard" => "Dashboard",
    "users" => "Usuários",
    "user" => $user->getValues()
  ]);
  $page->setTpl("user-side", [
    "title" => "CallCenter Log",
    "image" => $imageUpload->getValues(),
  ]);
  $page->setTpl("menu", [
    "dashboard" => "Dashboard",
    "appointment" => "Marcações",
    "users" => "Usuários",
    "report" => "Relatório",
    "isActiveReport" => 0,
    "user" => $user->getValues(),
    "isActiveDashboard" => 0,
    "isActiveUsers" => 1,
    "isActiveAppointment" => 0
  ]);
});

$app->get("/usuarios/:id_user/delete(/)", function ($iduser) {
  User::verifyLogin();
  User::verifyAdmin();

  $user = new User();
  $user->get((int) $iduser);
  $user->delete();

  header("Location: /usuarios?success=3");
  exit;
});

$app->post("/usuarios/cadastrar(/)", function () {
  User::verifyLogin();
  User::verifyAdmin();

  $_POST["admin"] = (isset($_POST["admin"])) ? 1 : 0;

  $user = new User();
  $user->setData($_POST);
  $user->save();

  header("Location: /usuarios?success=1");
  exit;
});

$app->post("/usuarios/:id_user(/)", function ($iduser) {
  User::verifyLogin();
  User::verifyAdmin();

  $user = new User();

  $_POST["admin"] = (isset($_POST["admin"])) ? 1 : 0;

  $user->get((int) $iduser);
  $user->setData($_POST);
  $user->update();

  header("Location: /usuarios?success=4");
  exit;
});
