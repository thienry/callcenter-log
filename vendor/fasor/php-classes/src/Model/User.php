<?php

namespace Fasor\Model;

use \Fasor\Db\Sql; 
use \Fasor\Model; 

class User extends Model {
  const SESSION = "User";

  public static function login($login, $password) {
    $sql = new Sql();
    $results = $sql -> select("SELECT * FROM tb_users WHERE login = :LOGIN AND user_status = 'A'", [
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
    if (isset($_SESSION[User::SESSION]['ausente']) && $_SESSION[User::SESSION]['ausente'] === true) {
      header("Location: /ausente/lock");
      exit;
    } elseif (!isset($_SESSION[User::SESSION]) || !$_SESSION[User::SESSION] || !(int)$_SESSION[User::SESSION]["id_user"] > 0) {
      header("Location: /login");
      exit;
    }             
  }

  public static function verifyAdmin($admin = false) {
    if ($admin === false && (bool)$_SESSION[User::SESSION]['admin'] === false) {
      header("Location: /login");
      exit;
    }
  }

  public static function logout() {
    $_SESSION[User::SESSION] = NULL;
  }

  public static function listAll() {
    $sql = new Sql();
    return $sql -> select("SELECT * FROM tb_users WHERE user_status = 'A'");
  }

  public function save() {
    $sql = new Sql();
    $results = $sql -> select("CALL sp_users_save(:name, :login, :password, :email, :admin, :user_status)", [
      ":name" => $this -> getname(),
      ":login" => $this -> getlogin(),
      ":password" => User::getPasswordHash($this -> getpassword()),
      ":email" => $this -> getemail(),
      ":admin" => $this -> getadmin(),
      ":user_status" => $this -> getuser_status()
    ]);

    $this -> setData($results[0]);
  }

  public static function getPasswordHash($password) {
    return password_hash($password, PASSWORD_DEFAULT, ["cost"=>12]);
  }

  public function get($iduser) {
    $sql = new Sql();
    $results = $sql -> select("SELECT * FROM tb_users WHERE id_user = :id_user AND user_status = 'A'", [
      ":id_user" => $iduser
    ]);

    $data = $results[0];
    $this -> setData($data);
  }

  public function update() {
    $sql = new Sql();
    $results = $sql -> select("CALL sp_usersupdate_save(:id_user, :name, :login, :password, :email, :admin, :user_status)", [
      ":id_user" => $this -> getid_user(),
      ":name" => $this -> getname(),
      ":login" => $this -> getlogin(),
      ":password" => User::getPasswordHash($this -> getpassword()),
      ":email" => $this -> getemail(),
      ":admin" => $this -> getadmin(),
      ":user_status" => $this -> getuser_status()
    ]);

    $this -> setData($results[0]);
  }

  public function delete() {
    $sql = new Sql();
    $results = $sql -> select("UPDATE tb_users SET user_status = 'I' WHERE id_user = :id_user;", [
      ":id_user"=>$this->getid_user()
    ]);
  }
}