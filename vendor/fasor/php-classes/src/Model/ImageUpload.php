<?php

namespace Fasor\Model;

use \Fasor\Model;

class ImageUpload extends Model {
  public function setPhoto($file) {
    $ext = explode(".", $file["name"]);
    $ext = end($ext);

    switch ($ext) {
      case "jpg":
      case "jpeg":
        $image = imagecreatefromjpeg($file["tmp_name"]);
        break;
      
      case "gif":
        $image = imagecreatefromgif($file["tmp_name"]);
        break;
    
      case "png":
        $image = imagecreatefrompng($file["tmp_name"]);
        break;
    }

    $dist = $_SERVER["DOCUMENT_ROOT"]
            .DIRECTORY_SEPARATOR."res"
            .DIRECTORY_SEPARATOR."img"
            .DIRECTORY_SEPARATOR."avatar"
            .DIRECTORY_SEPARATOR.getUserLogin()
            ."-".getUserId().".jpg";

    imagejpeg($image, $dist);
    imagedestroy($image);
    $this->checkPhoto();
  }

  public function checkPhoto() {
    if (file_exists($_SERVER["DOCUMENT_ROOT"]
          .DIRECTORY_SEPARATOR."res"
          .DIRECTORY_SEPARATOR."img"
          .DIRECTORY_SEPARATOR."avatar"
          .DIRECTORY_SEPARATOR.getUserLogin()
          ."-".getUserId().".jpg")
        ) {
      $url = "/res/img/avatar/".getUserLogin()."-".getUserId().".jpg";
    } else {
      $url = "/res/img/avatar/avatar.jpg";
    }

    return $this->setdesphoto($url);
  }

  public function getValues() {
    $this->checkPhoto();
    $values = parent::getValues();
    return $values;
  }
}