<?php
class Triangle {

  public static $verbose = false;
  private $_v1;
  private $_v2;
  private $_v3;

  function __construct(array $tab) {
    $this->_v1 = $tab["A"];
    $this->_v2 = $tab["B"];
    $this->_v3 = $tab["C"];
    if (Triangle::$verbose) {
      echo "Triangle instance constructed\n";
    }
  }

  function __destruct() {
    if (Triangle::$verbose) {
      echo "Triangle instance destructed\n";
    }
  }

  function __get($property) {
    if ($property == "v1") {
      return ($this->_v1);
    }
    elseif ($property == "v2") {
      return ($this->_v2);
    }
    elseif ($property == "v3") {
      return ($this->_v3);
    }
    throw new Exception("Propriete invalide");
  }

  function __set($property, $value) {
    if ($property === "v1") {
      $this->_v1 = $value;
    }
    elseif ($property === "v2") {
      $this->_v2 = $value;
    }
    elseif ($property === "v3") {
      $this->_v3 = $value;
    }
    else {
      throw new Exception("Propriete invalide");
    }
  }

  function doc() {
    return (file_get_contents("Triangle.doc.txt"));
  }

  function __toString() {
    return ("Triangle( v1: ".$this->_v1.", v2: ".$this->_v2.", v3: ".$this->_v3." )");
  }

}
?>
