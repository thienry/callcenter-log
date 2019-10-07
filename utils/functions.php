<?php

use \Fasor\Model;
use \Fasor\Model\User;

function formatDate($date) {
  return date('d/m/Y', strtotime($date));
}

function getUserLogin() {
  $user = User::getFromSession();
  return $user->getlogin();
}

function getUserName() {
  $user = User::getFromSession();
  return $user->getname();
}

function getUserEmail() {
  $user = User::getFromSession();
  return $user->getemail();
}