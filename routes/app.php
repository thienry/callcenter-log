<?php

use \Fasor\Page;
use \Fasor\Model\User;
use \Fasor\Model\Callcenter;
use \Fasor\Model\ImageUpload;
use \Fasor\Model\Paginator;

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
  
$app->get("/perfil(/)", function () {
  User::verifyLogin();  
  $user = new User();
  $user = User::getFromSession();
  
  $success = isset($_GET["success"]) ? $_GET["success"] : 0;

  $imageUpload = new ImageUpload();
    
  $page = new Page();
  $page->setTpl("navbar"); 
  $page->setTpl("profile", [
    "pageTitle" => "Perfil",
    "breadcrumbItem" => "Dashboard",
    "userProfile" => "Perfil do Usuário",
    "img" => $imageUpload->getValues(),
    "success" => $success
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

  header("Location: /perfil?success=1");
  exit;
});

$app->get("/marcacoes(/)", function () {
  User::verifyLogin();
  
  $error = isset($_GET["error"]) ? $_GET["error"] : 0;
  $success = isset($_GET["success"]) ? $_GET["success"] : 0;
  $page = isset($_GET["page"]) ? (int)$_GET["page"] : 1;
  $search = isset($_GET["search"]) ? $_GET["search"] : "";
  $hrini = isset($_GET["hrini"]) ? $_GET["hrini"] : "";
  $hrend = isset($_GET["hrend"]) ? $_GET["hrend"] : "";
  $id = isset($_GET["id"]) ? $_GET["id"] : "";

  $iniDate = new DateTime("00:00:00");
  $iniDate = $iniDate->format("Y-m-d H:i:s");
  
  $endDate = new DateTime("23:59:59");
  $endDate = $endDate->format("Y-m-d H:i:s");

  $dtini = isset($_GET["dtini"]) ? $_GET["dtini"] : $iniDate;
  $dtend = isset($_GET["dtend"]) ? $_GET["dtend"] : $endDate;

  $imageUpload = new ImageUpload();
  
  $user = new User();
  $user = User::getFromSession();

  /**
   * Fazer Verificação das queries para renderização da tabela
   * 1- getPageActualDay();
   * 2- getPageSearch();
   * 3- getPageDateRange();
   * 4- getPageSearchAndDateRange();
   */
  if ($search != "" && $dtini != "" && $hrini != "" && $dtend != "" && $hrend != "") {
    if ($_GET["dtini"] > $_GET["dtend"]) {
      header("Location: /marcacoes?error=5");
      exit;
    }

    if ($_GET["dtini"] == $_GET["dtend"] && $_GET["hrini"] > $_GET["hrend"]) {
      header("Location: /marcacoes?error=6");
      exit;
    }

    $dtini = $dtini." ".$hrini;
    $dtend = $dtend." ".$hrend;
    
    $pagination = Paginator::getPageSearchAndDateRange($search, $dtini, $dtend,  $page);

  } else if ($dtini != "" && $hrini != "" && $dtend != "" && $hrend != "") {
    if ($_GET["dtini"] > $_GET["dtend"]) {
      header("Location: /marcacoes?error=5");
      exit;
    }

    if ($_GET["dtini"] == $_GET["dtend"] && $_GET["hrini"] > $_GET["hrend"]) {
      header("Location: /marcacoes?error=6");
      exit;
    }

    $dtini = $dtini." ".$hrini;
    $dtend = $dtend." ".$hrend;

    $pagination = Paginator::getPageByDate($dtini, $dtend, $page);
  } else if ($search != "") {
    $pagination = Paginator::getPageSearch($search, $page);
  } else if ($id != "") {
    $pagination = Paginator::getPageId($id, $page);
  } else {
    $pagination = Paginator::getPageByDate($dtini, $dtend, $page);
  }

  if ($page > $pagination["pages"] || $page < 1) {
    header("Location: /marcacoes");
    exit;
  }

  $one = 1;

  $pages = [];

  $first = "/marcacoes"."?page=".$one."&search=".$search."&dtini=".$dtini."&dtend=".$dtend;
  $last = "/marcacoes"."?page=".(int)$pagination["pages"]."&search=".$search."&dtini=".$dtini."&dtend=".$dtend;
  $prev = "";
  $next = "";

  $a = explode("&", $first);
  $a = substr($a[0], 16, strlen($a[0]));

  $b = explode("&", $last);
  $b = substr($b[0], 16, strlen($b[0]));

  $firstPage = (($a == $page) == true);
  $lastPage = (($b == $page) == true);

  $linksLimit = 2;
  $start = ((($page - $linksLimit) > 1) ? $page - $linksLimit : 1);
  $end = ((($page + $linksLimit) < $pagination["pages"]) ? $page + $linksLimit : $pagination["pages"]);
  
  if ($pagination["pages"] > 1 && $page <= $pagination["pages"]) {
    $cont = 1;
    for ($i = $start; $i <= $end ; $i++) { 
      array_push($pages, [
        "link" => "/marcacoes?".http_build_query([
          "page" => $i,
          "search" => $search,
          "dtini" => $dtini,
          "dtend" => $dtend,
        ]),
        "text" => $i,
        "active" => $i == $page,
       ]);
    }
  }

  $page = new Page();
  $page->setTpl("navbar");
  $page->setTpl("appointments", [
    "pageTitle" => "Marcações",
    "breadcrumbItem" => "Dashboard",
    "appointments" => "Marcações",
    "logs" => $pagination["data"],
    "pages" => $pages,
    "firstPage" => $firstPage,
    "lastPage" => $lastPage,
    "first" => $first,
    "last" => $last,
    "search" => $search,   
    "dtini" => $dtini,   
    "dtend" => $dtend,
    "hrini" => $hrini,
    "hrend" => $hrend,
    "success" => $success,
    "error"=>$error,
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

$app->get("/marcacoes/:id(/)", function ($id) {
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

$app->post("/marcacoes/:id", function($id) {
  User::verifyLogin();

  $_POST["Confirmacao"] = (isset($_POST["Confirmacao"]) ) ? $_POST["Confirmacao"] : "";
  
  $log = new Callcenter();
  $log->get((int)$id);
  $log->setData($_POST);
  $log->update();

  header("Location: /marcacoes?id={$id}&success=1");
  exit;
});

$app-> get("/ausente/bloqueio", function () {
  User::verifyLogin();

  if (!isset($_SESSION[User::SESSION])) {
    header("Location: /login");
    exit;
  }

  if ($_SESSION[User::SESSION] && (int)$_SESSION[User::SESSION]["id_user"] > 0 &&	(bool)$_SESSION[User::SESSION]["id_user"] === true) {
    $user = new User();
		$user->get((int)$_SESSION[User::SESSION]["id_user"]);

    $_SESSION[User::SESSION]["ausente"] = true;

    $imageUpload = new ImageUpload();

    $page = new Page([
      "header" => false,
      "footer" => false,
      "data" => [
        "user" => $user->getValues()
      ]
    ]);

    $page->setTpl("lockscreen", [
      "image" => $imageUpload->getValues(),
    ]); 
  } 
});

$app -> get("/logout", function () {
  User::verifyLogin();
  User::logout();

  header("Location: /login");
  exit;
});