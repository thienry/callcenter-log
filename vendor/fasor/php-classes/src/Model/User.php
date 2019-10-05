<?php

namespace Fasor\Model;

use \Fasor\Db\Sql; 
use \Fasor\Model; 

class User extends Model {
  const SESSION = "User";

  public static function login($login, $password) {
    $sql = new Sql();
    $results = $sql -> select("SELECT * FROM tb_users WHERE login = :LOGIN", [
      ":LOGIN" => $login
    ]);

    if (count($results) === 0) {
      header("Location: /login?erro=1");
      exit;
    }

    $data = $results[0];

    if (password_verify($password, $data["password"]) === true) {
      $user = new User();
      $user -> setData($data);
      $_SESSION[User::SESSION] = $user -> getValues();
      $_SESSION[User::SESSION]["ausente"] = false;
      return $user;
    } else {
      header("Location: /login?erro=1");
      exit;
    }
  }

  public static function verifyLogin() {
    if (!isset($_SESSION[User::SESSION]) || 
        !$_SESSION[User::SESSION] || 
        (int)$_SESSION[User::SESSION]["id_user"] > 0) 
        {
      header("Location: /login");
      exit;
    }
  }

  public static function verifyAdmin($admin = true) {
    if ((bool)$_SESSION[User::SESSION]["admin"] !== $admin) {
      header("Location: /login");
      exit;
    }
  }

  public static function logout() {
    $_SESSION[User::SESSION] = NULL;
  }
}