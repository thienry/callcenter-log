<?php

namespace Fasor\Model;

use \Fasor\Db\Sql; 
use \Fasor\Model; 

class Callcenter extends Model {
  public static function listAll() {
    $sql = new Sql();
    return $sql -> select("SELECT * FROM marcacoes_diag limit 100");
  }

  public static function listConfirmedTags() {
    $sql = new Sql();
    $results = $sql -> select("SELECT COUNT(*) AS RESULT FROM marcacoes_diag WHERE Confirmacao = 'S'");
    return $results[0]["RESULT"];
  }

  public static function listNoAnswerTags() {
    $sql = new Sql();
    $results = $sql -> select("SELECT COUNT(*) AS RESULT FROM marcacoes_diag WHERE Confirmacao IS NULL");
    return $results[0]["RESULT"];
  }

  public static function listUnmarkedTags() {
    $sql = new Sql();
    $results = $sql -> select("SELECT COUNT(*) AS RESULT FROM marcacoes_diag WHERE Confirmacao = 'N'");
    return $results[0]["RESULT"];
  }

  public static function listTotalTags() {
    $sql = new Sql();
    $results = $sql -> select("SELECT COUNT(*) AS TOTAL FROM marcacoes_diag;");
    return $results[0]["TOTAL"];
  }

  public function get($id) {
    $sql = new Sql();
    $results = $sql->select("SELECT * FROM marcacoes_diag WHERE id = :id", [
      ":id" => $id
    ]);

    $data = $results[0];
    $this -> setData($data);
  }

  public function update() {
    $sql = new Sql();
    $results = $sql->query("UPDATE marcacoes_diag SET Confirmacao = :Confirmacao, observacao = :observacao WHERE id = :id", [
      ":Confirmacao" => $this->getConfirmacao(),
      ":observacao" => $this->getobservacao(),
      ":id" => $this->getid(),
    ]);

    if (count($results) === 0) {
      header("Location: /marcacoes?error=1");
      exit;
    }
  }

  public static function getPage($page = 1, $itemsPerPage = 10) {
    $start = ($page - 1) * $itemsPerPage;

    $sql = new Sql();
    $results = $sql->select("SELECT SQL_CALC_FOUND_ROWS * FROM marcacoes_diag LIMIT $start, $itemsPerPage;");

    $resultsTotal = $sql->select("SELECT FOUND_ROWS() AS nrtotal;");

    return [
      "data" => $results,
      "total" => (int) $resultsTotal[0]["nrtotal"],
      "pages" => ceil($resultsTotal[0]["nrtotal"] / $itemsPerPage)
    ];
  }

  public static function getPageSearch($search, $dtini, $dtend, $page = 1, $itemsPerPage = 10) {
    $start = ($page - 1) * $itemsPerPage;

    $sql = new Sql();
    $results = $sql->select("SELECT SQL_CALC_FOUND_ROWS * 
                             FROM marcacoes_diag
                             WHERE nome_pac LIKE :search 
                             OR descricao LIKE :search 
                             OR Medico LIKE :search 
                             OR Confirmacao LIKE :search 
                             OR Local LIKE :search 
                             OR fone_celular LIKE :search 
                             OR id_marcacao LIKE :search 
                             OR Data_hora BETWEEN :dtini AND :dtend
                             LIMIT $start, $itemsPerPage;", [
      ":search" => "%" . $search . "%",
      ":dtini" => "'" . $dtini . "'",
      ":dtend" => "'" . $dtend . "'",
    ]);

    $resultsTotal = $sql->select("SELECT FOUND_ROWS() AS nrtotal;");

    return [
      "data" => $results,
      "total" => (int) $resultsTotal[0]["nrtotal"],
      "pages" => ceil($resultsTotal[0]["nrtotal"] / $itemsPerPage)
    ];
  }
}