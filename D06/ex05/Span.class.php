<?php
class Span {

  public static $verbose = false;
  private $_c1;
  private $_x1;
  private $_z1;
  private $_c2;
  private $_x2;
  private $_z2;

  function __construct($c1, $x1, $z1, $c2, $x2, $z2) {
    if ($x1 < $x2) {
      $this->_c1 = $c1;
      $this->_x1 = $x1;
      $this->_z1 = $z1;
      $this->_c2 = $c2;
      $this->_x2 = $x2;
      $this->_z2 = $z2;
    }
    else {
      $this->_c1 = $c2;
      $this->_x1 = $x2;
      $this->_z1 = $z2;
      $this->_c2 = $c1;
      $this->_x2 = $x1;
      $this->_z2 = $z1;
    }
    if (Span::$verbose) {
      echo "Span instance constructed".PHP_EOL;
    }
  }

  function __destruct() {
    if (Span::$verbose) {
      echo "Span instance destructed".PHP_EOL;
    }
  }

  function __get($property) {
    if ($property == "c1") {
      return ($this->_c1);
    }
    elseif ($property == "x1") {
      return ($this->_x1);
    }
    elseif ($property == "z1") {
      return ($this->_z1);
    }
    elseif ($property == "c2") {
      return ($this->_c2);
    }
    elseif ($property == "x2") {
      return ($this->_x2);
    }
    elseif ($property == "z2") {
      return ($this->_z2);
    }
    else {
      throw new Exception("Propriete invalide");
    }
  }

  function doc() {
    return (file_get_contents("Span.doc.txt"));
  }

  function __toString() {
    return ("Span( c1: ".$this->_c1.", x1: ".$this->_x1.", z1: ".$this->_z1.", c2: ".$this->_c2.", x2: ".$this->_x2.", z2: ".$this->_z2." )");
  }

}
