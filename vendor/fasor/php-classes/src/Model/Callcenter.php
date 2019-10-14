<?php

namespace Fasor\Model;

use \Fasor\Db\Sql;
use \Fasor\Model;

class Callcenter extends Model {
  public static function listAll() {
    $sql = new Sql();
    return $sql->select("SELECT * FROM marcacoes_diag limit 100");
  }

  public static function listConfirmedTags() {
    $sql = new Sql();
    $results = $sql->select("SELECT COUNT(*) AS RESULT FROM marcacoes_diag WHERE Confirmacao = 'S'");
    return $results[0]["RESULT"];
  }

  public static function listNoAnswerTags() {
    $sql = new Sql();
    $results = $sql->select("SELECT COUNT(*) AS RESULT FROM marcacoes_diag WHERE Confirmacao IS NULL");
    return $results[0]["RESULT"];
  }

  public static function listUnmarkedTags() {
    $sql = new Sql();
    $results = $sql->select("SELECT COUNT(*) AS RESULT FROM marcacoes_diag WHERE Confirmacao = 'N'");
    return $results[0]["RESULT"];
  }

  public static function listTotalTags() {
    $sql = new Sql();
    $results = $sql->select("SELECT COUNT(*) AS TOTAL FROM marcacoes_diag;");
    return $results[0]["TOTAL"];
  }

  public function get($id) {
    $sql = new Sql();
    $results = $sql->select("SELECT * FROM marcacoes_diag WHERE id = :id", [
      ":id" => $id
    ]);

    $data = $results[0];
    $this->setData($data);
  }

  public function update() {
    $sql = new Sql();
    $results = $sql->select("UPDATE marcacoes_diag SET Confirmacao = :Confirmacao, observacao = :observacao, id_user = :id_user WHERE id = :id", [
      ":Confirmacao" => $this->getConfirmacao(),
      ":observacao" => $this->getobservacao(),
      ":id_user" => getUserId(),
      ":id" => $this->getid(),
    ]);

    if ($results == 0) {
      header("Location: /marcacoes?error=1");
      exit;
    }
  }

  public static function checkList($list) {
    foreach ($list as &$row) {
      $p = new Callcenter();
      $p->setData($row);
      $row = $p->getValues();
    }
    return $list;
  }
}
