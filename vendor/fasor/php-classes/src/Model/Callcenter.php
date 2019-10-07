<?php

namespace Fasor\Model;

use \Fasor\Db\Sql; 
use \Fasor\Model; 

class Callcenter {
  public static function listAll() {
    $sql = new Sql();
    return $sql -> select("SELECT * FROM marcacoes_diag limit 100");
  }

  public static function listConfirmedTags() {
    $sql = new Sql();
    $results = $sql -> select("SELECT COUNT(*) FROM marcacoes_diag WHERE Confirmacao = 'S'");
    foreach ($results as $row) {
      foreach ($row as $key => $value) {
        return $value;
      }
    }
  }

  public static function listNoAnswerTags() {
    $sql = new Sql();
    $results = $sql -> select("SELECT COUNT(*) FROM marcacoes_diag WHERE Confirmacao IS NULL");
    foreach ($results as $row) {
      foreach ($row as $key => $value) {
        return $value;
      }
    }
  }

  public static function listUnmarkedTags() {
    $sql = new Sql();
    $results = $sql -> select("SELECT COUNT(*) FROM marcacoes_diag WHERE Confirmacao = 'N'");
    foreach ($results as $row) {
      foreach ($row as $key => $value) {
        return $value;
      }
    }
  }

  public static function listTotalTags() {
    $sql = new Sql();
    $results = $sql -> select("SELECT COUNT(*) AS TOTAL FROM marcacoes_diag;");
    foreach ($results as $row) {
      foreach ($row as $key => $value) {
        return $value;
      }
    }
  }
}