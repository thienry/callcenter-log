<?php

namespace Fasor\Model;

use \Fasor\Db\Sql;

class Paginator {
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
      "total" => (int) $totalResult[0]["nrtotal"],
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
      ':search' => '%' . $search . '%'
    ]);

    $resultTotal = $sql->select("SELECT FOUND_ROWS() AS nrtotal;");

    return [
      'data' => $results,
      'total' => (int) $resultTotal[0]["nrtotal"],
      'pages' => ceil($resultTotal[0]["nrtotal"] / $limit)
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
      ':search' => '%' . $search . '%'
    ]);

    $resultTotal = $sql->select("SELECT FOUND_ROWS() AS nrtotal;");

    return [
      'data' => $results,
      'total' => (int) $resultTotal[0]["nrtotal"],
      'pages' => ceil($resultTotal[0]["nrtotal"] / $limit)
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
      "total" => (int) $totalResult[0]["nrtotal"],
      "pages" => ceil($totalResult[0]["nrtotal"] / $limit),
    ];
  }
}
