<?php

namespace Fasor\Model;

use \Fasor\Db\Sql; 
use \Fasor\Model;
use \Fasor\Mailer;

class User extends Model {
  const SESSION = "User";
  const KEY = "CallCenter_Log_Secret";
  const ERROR = "UserError";
  const SUCCESS = "UserSucesss";

  public static function getFromSession() {
    $user = new User();
    if (isset($_SESSION[User::SESSION]) && (int)$_SESSION[User::SESSION]["id_user"] > 0) {
      $user->setData($_SESSION[User::SESSION]);
    }
    return $user;
  }
  
  public static function login($login, $password) {
    $sql = new Sql();
    $results = $sql -> select("SELECT * FROM tb_users WHERE login = :LOGIN OR email = :email AND user_status = 'A'", [
      ":LOGIN" => $login,
      ":email" => $login
    ]);

    if (count($results) === 0) {
      header("Location: /login?erro=1");
      exit;
    }
    
    $data = $results[0];
    
    if (password_verify($password, $data["despassword"]) === true) {
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
    $results = $sql -> select("CALL sp_users_save(:name, :login, :despassword, :email, :admin, :user_status)", [
      ":name" => $this -> getname(),
      ":login" => $this -> getlogin(),
      ":despassword" => User::getPasswordHash($this->getdespassword()),
      ":email" => $this -> getemail(),
      ":admin" => $this -> getadmin(),
      ":user_status" => $this -> getuser_status()
    ]);
    $this -> setData($results[0]);

    if (count($results) === 0) {
      header("Location: /usuarios?error=1");
      exit;
    }
  }

  public static function getPasswordHash($password) {
    return password_hash($password, PASSWORD_DEFAULT, [
			'cost'=>12
		]);
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
    $results = $sql -> select("CALL sp_usersupdate_save(:id_user, :name, :login, :email, :admin, :user_status)", [
      ":id_user" => $this -> getid_user(),
      ":name" => $this -> getname(),
      ":login" => $this -> getlogin(),
      ":email" => $this -> getemail(),
      ":admin" => $this -> getadmin(),
      ":user_status" => $this -> getuser_status()
    ]);

    $this -> setData($results[0]);

    if ($results === 0) {
      header("Location: /usuarios?error=4");
      exit;
    }
  }

  public function delete() {
    $sql = new Sql();
    $results = $sql -> select("UPDATE tb_users SET user_status = 'I' WHERE id_user = :id_user;", [
      ":id_user"=>$this->getid_user()
    ]);

    if ($results === 0) {
      header("Location: /usuarios?error=3");
      exit;
    }
  }

  public static function getForgot($email) {
    $sql = new Sql();
    $results = $sql -> select("SELECT * FROM tb_users WHERE email = :email", [
      ":email" => $email
    ]);

    if (count($results) === 0) {
      header("Location: /esqueci-a-senha?erro=1");
      exit;
    } else {
      $data = $results[0];

      $resultsRecovery = $sql -> select("CALL sp_userspasswordsrecoveries_create(:id_user, :ip)", [
        ":id_user" => $data["id_user"],
        ":ip" => $_SERVER["REMOTE_ADDR"]
      ]);

      if ($resultsRecovery === 0) {
        header("Location: /esqueci-a-senha?erro=2");
        exit;
      } else {
        $dataRecovery = $resultsRecovery[0];
        
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length("aes-256-cbc")); // generate 16  random bytes
        $code = openssl_encrypt($dataRecovery["id_recovery"], "aes-256-cbc", User::KEY, 0, $iv);
        $code = base64_encode($code . "::" . $iv);

        $link = "callcenterlog.local/esqueci-a-senha/recuperar?code=$code";

        $mailer = new Mailer($data["email"], $data["name"], "Redefinir Senha da CallCenter Log", "email", [
          "name" => $data["name"],
          "link" => $link
        ]);

        $mailer -> send();

        return $data;
      }
    }
  }

  public static function validForgotDecrypt($code) {
    list($encrypted, $iv) = explode('::', base64_decode($code));
    $id_recovery = openssl_decrypt($encrypted, 'aes-256-cbc', USER::KEY, 0,  $iv);

    $sql = new Sql();
    $results = $sql -> select("SELECT * FROM tb_userspasswordsrecoveries a INNER JOIN tb_users b USING(id_user) WHERE a.id_recovery = :id_recovery AND dt_recovery IS NULL AND DATE_ADD(a.dt_register, INTERVAL 1 HOUR) >= NOW();", [
      ":id_recovery" => $id_recovery
    ]);

    if (count($results) === 0) {
      header("Location: /esqueci-a-senha?erro=3");
      exit;
    } else {
      return $results[0];
    }
  }

  public static function setForgotUsed($idrecovery) {
    $sql = new Sql();
    $results = $sql -> query("UPDATE tb_userspasswordsrecoveries SET dt_recovery = NOW() WHERE id_recovery = :id_recovery", [
      ":id_recovery" => $idrecovery
    ]);

    if ($results === 0) {
      header("Location: /esqueci-a-senha?erro=4");
      exit;
    }
  }

  public function setPassword($password) {
    $sql = new Sql();
    $results = $sql -> select("UPDATE tb_users SET despassword = :despassword WHERE id_user = :id_user", [
      ":despassword" => $password,
      ":id_user" => $this->getid_user()
    ]);

    if ($results === 0) {
      header("Location: /usuarios?error=2");
      exit;
    }
  }

  public static function getPage($page = 1, $itemsPerPage = 10) {
    $start = ($page - 1) * $itemsPerPage;
    
    $sql = new Sql();
    $results = $sql->select("SELECT SQL_CALC_FOUND_ROWS * FROM tb_users WHERE user_status = 'A' LIMIT $start, $itemsPerPage;");

    $resultsTotal = $sql->select("SELECT FOUND_ROWS() AS nrtotal;");

    return [
      "data"=>$results,
      "total"=>(int)$resultsTotal[0]["nrtotal"],
      "pages"=>ceil($resultsTotal[0]["nrtotal"] / $itemsPerPage)
    ];
  }

  public static function getPageSearch($search, $page = 1, $itemsPerPage = 10) {
    $start = ($page - 1) * $itemsPerPage;

    $sql = new Sql();
    $results = $sql->select("SELECT SQL_CALC_FOUND_ROWS * FROM tb_users WHERE name LIKE :search OR login LIKE :search OR email LIKE :search WHERE user_status = 'A' LIMIT $start, $itemsPerPage;", [
      ":search" => "%". $search ."%"
    ]);

    $resultsTotal = $sql->select("SELECT FOUND_ROWS() AS nrtotal ;");

    return [
      "data" => $results,
      "total" => (int) $resultsTotal[0]["nrtotal"],
      "pages" => ceil($resultsTotal[0]["nrtotal"] / $itemsPerPage)
    ];
  }

  public static function setError($msg) {
		$_SESSION[User::ERROR] = $msg;
  }
    
  public static function getError() {
    $msg = (isset($_SESSION[User::ERROR]) && $_SESSION[User::ERROR]) ? $_SESSION[User::ERROR] : '';
    User::clearError();
    return $msg;
  }
    
	public static function clearError()	{
		$_SESSION[User::ERROR] = NULL;
  }
    
  public static function setSuccess($msg) {
    $_SESSION[User::SUCCESS] = $msg;
  }
    
	public static function getSuccess()	{
    $msg = (isset($_SESSION[User::SUCCESS]) && $_SESSION[User::SUCCESS]) ? $_SESSION[User::SUCCESS] : '';
    User::clearSuccess();
    return $msg;
  }
    
	public static function clearSuccess() {
    $_SESSION[User::SUCCESS] = NULL;
  }
}