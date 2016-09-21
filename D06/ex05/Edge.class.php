<?php
class Edge {

  public static $verbose = false;
  private $_c1;
  private $_x1;
  private $_y1;
  private $_z1;
  private $_c2;
  private $_x2;
  private $_y2;
  private $_z2;

  function __construct($c1, $x1, $y1, $z1, $c2, $x2, $y2, $z2) {
    if ($y1 < $y2) {
      $this->_c1 = $c1;
      $this->_x1 = $x1;
      $this->_y1 = $y1;
      $this->_z1 = $z1;
      $this->_c2 = $c2;
      $this->_x2 = $x2;
      $this->_y2 = $y2;
      $this->_z2 = $z2;
    }
    else {
      $this->_c1 = $c2;
      $this->_x1 = $x2;
      $this->_y1 = $y2;
      $this->_z1 = $z2;
      $this->_c2 = $c1;
      $this->_x2 = $x1;
      $this->_y2 = $y1;
      $this->_z2 = $z1;
    }
    if (Edge::$verbose) {
      echo "Edge instance constructed".PHP_EOL;
    }
  }

  function __destruct() {
    if (Edge::$verbose) {
      echo "Edge instance destructed".PHP_EOL;
    }
  }

  function __get($property) {
    if ($property == "c1") {
      return ($this->_c1);
    }
    elseif ($property == "x1") {
      return ($this->_x1);
    }
    elseif ($property == "y1") {
      return ($this->_y1);
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
    elseif ($property == "y2") {
      return ($this->_y2);
    }
    elseif ($property == "z2") {
      return ($this->_z2);
    }
    else {
      throw new Exception("Propriete invalide");
    }
  }

  function doc() {
    return (file_get_contents("Edge.doc.txt"));
  }

  function __toString() {
    return ("Edge( c1: ".$this->_c1.", x1: ".$this->_x1.", y1: ".$this->_y1.", z1: ".$this->_z1.", c2: ".$this->_c2.", x2: ".$this->_x2.", y2: ".$this->_y2.", z2: ".$this->_z2." )");
  }

}
?>
