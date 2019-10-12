<?php

use \Fasor\Model;
use \Fasor\Model\User;

function formatDate($date) {
  return date('d/m/Y', strtotime($date));
}

function getUserId() {
  $user = User::getFromSession();
  return $user->getid_user();
}

function getUserLogin() {
  $user = User::getFromSession();
  return $user->getlogin();
}

function getUserName() {
  $user = User::getFromSession();
  return $user->getname();
}

function getfirstAndLastName() {
  $user = User::getFromSession();
  $name = $user->getname();
  $name = explode(" ", $name);
  $whiteSpace = " ";
  $formattedName = $name[0].$whiteSpace.$name[1];
  return $formattedName;
}
 
function getUserEmail() {
  $user = User::getFromSession();
  return $user->getemail();
}

