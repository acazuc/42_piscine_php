<?php
class Texture {

  public static $verbose = false;
  private $_filename;
  private $_image;
  private $_height;
  private $_width;

  function __construct($filename) {
    $this->_filename = $filename;
    if (($this->_image = imagecreatefrompng($filename)) === false) {
      throw new Exception("Can't load ".$filename." file.\n");
    }
    $this->_width = imagesx($this->_image);
    $this->_height = imagesy($this->_image);
    if (Texture::$verbose) {
      echo "Texture instance constructed\n";
    }
  }

  function __destruct() {
    if (Texture::$verbose) {
      echo "Texture instance destructed\n";
    }
  }

  function getColorAt($x, $y) {
    $x = $x * $this->_width;
    $y = $y * $this->_height;
    if ($x < 0) {
      $x = 0;
    }
    if ($y < 0) {
      $y = 0;
    }
    if ($x >= $this->_width) {
      $x = $this->_width - 1;
    }
    if ($y >= $this->_height) {
      $y = $this->_height - 1;
    }
    return (new Color(imagecolorsforindex($this->_image, imagecolorat($this->_image, $x, $y))));
  }

  function doc() {
    return (file_get_contents("Texture.doc.txt"));
  }

  function __toString() {
    return ("Texture( filename: ".$this->_filename." )");
  }

}
