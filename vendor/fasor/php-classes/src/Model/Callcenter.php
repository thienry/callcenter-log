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
    $user = User::getFromSession();

    $sql = new Sql();
    $results = $sql->select("UPDATE marcacoes_diag SET Confirmacao = :Confirmacao, observacao = :observacao, id_user = :id_user WHERE id = :id", [
      ":Confirmacao" => $this->getConfirmacao(),
      ":observacao" => $this->getobservacao(),
      ":id_user" => $user->getid_user(),
      ":id" => $this->getid(),
    ]);

    if (count($results) !== 0) {
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


  public static function getPageByDate($dtini, $dtend, $page = 1, $limit = 10) {
    $start = ($page - 1) * $limit;

    $sql = new Sql();
    $results = $sql->select("SELECT SQL_CALC_FOUND_ROWS * FROM marcacoes_diag WHERE Data_hora BETWEEN :dtini AND :dtend  LIMIT $start, $limit", [
      ":dtini" => $dtini,
      ":dtend" => $dtend
    ]);
    $totalResult = $sql->select("SELECT FOUND_ROWS() AS nrtotal");

    return [
      "data" => $results,
      "total" => (int)$totalResult[0]["nrtotal"],
      "pages" => ceil($totalResult[0]["nrtotal"] / $limit),
    ];
  }

  public static function getPageSearch($search, $page = 1, $limit = 10) {
    $start = ($page - 1) * $limit;
    
		$sql = new Sql();
		$results = $sql->select("
			SELECT SQL_CALC_FOUND_ROWS *
			FROM marcacoes_diag 
      WHERE id_marcacao LIKE :search 
      OR nome_pac LIKE :search 
      OR descricao LIKE :search
      OR Medico LIKE :search
      OR fone_celular LIKE :search
      OR Confirmacao LIKE :search
			LIMIT $start, $limit;
		", [
			':search'=>'%'.$search.'%'
    ]);
    
		$resultTotal = $sql->select("SELECT FOUND_ROWS() AS nrtotal;");
    
    return [
			'data'=>$results,
			'total'=>(int)$resultTotal[0]["nrtotal"],
			'pages'=>ceil($resultTotal[0]["nrtotal"] / $limit)
		];
  } 

  /**
   * Ajustar Query Abaixo
   */
  public static function getPageSearchAndDateRange($search, $dtini, $dtend, $page = 1, $limit = 10) {
    $start = ($page - 1) * $limit;
    
		$sql = new Sql();
		$results = $sql->select("
			SELECT SQL_CALC_FOUND_ROWS *
			FROM marcacoes_diag 
      WHERE id_marcacao LIKE :search 
      OR nome_pac LIKE :search 
      OR descricao LIKE :search
      OR Medico LIKE :search
      OR fone_celular LIKE :search
      OR Confirmacao LIKE :search
			LIMIT $start, $limit;
		", [
			':search'=>'%'.$search.'%'
    ]);
    
		$resultTotal = $sql->select("SELECT FOUND_ROWS() AS nrtotal;");
    
    return [
			'data'=>$results,
			'total'=>(int)$resultTotal[0]["nrtotal"],
			'pages'=>ceil($resultTotal[0]["nrtotal"] / $limit)
		];
  }

  public static function getPageId($id, $page = 1, $limit = 10) {
    $start = ($page - 1) * $limit;

    $sql = new Sql();
    $results = $sql->select("SELECT SQL_CALC_FOUND_ROWS * FROM marcacoes_diag WHERE id = :id LIMIT $start, $limit", [
      ":id" => $id
    ]);
    $totalResult = $sql->select("SELECT FOUND_ROWS() AS nrtotal");

    return [
      "data" => $results,
      "total" => (int)$totalResult[0]["nrtotal"],
      "pages" => ceil($totalResult[0]["nrtotal"] / $limit),
    ];
  }
}