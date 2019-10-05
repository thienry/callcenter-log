<?php

namespace Fasor\Model;

use \Fasor\Db\Sql; 
use \Fasor\Model; 

class Callcenter {
  public static function listAll() {
    $sql = new Sql();
    return $sql -> select("SELECT * FROM marcacoes_diag limit 100");
  }
}