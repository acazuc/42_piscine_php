<?php
class Vector {

  public static $verbose = false;
  private $_x;
  private $_y;
  private $_z;
  private $_w;
  private $_color;

  function __construct($tab) {
    if (isset($tab["dest"])) {
      $this->_x = $tab["dest"]->__get("x");
      $this->_y = $tab["dest"]->__get("y");
      $this->_z = $tab["dest"]->__get("z");
      $this->_color = $tab["dest"]->__get("color");
    }
    if (isset($tab["orig"])) {
      $this->_x -= $tab["orig"]->__get("x");
      $this->_y -= $tab["orig"]->__get("y");
      $this->_z -= $tab["orig"]->__get("z");
    }
    if (Vector::$verbose) {
      echo $this->__toString()." constructed".PHP_EOL;
    }
  }

  function __destruct() {
    if (Vector::$verbose) {
      echo $this->__toString()." destructed".PHP_EOL;
    }
  }

  function __get($property) {
    if ($property === "x") {
      return ($this->_x);
    }
    elseif ($property === "y") {
      return ($this->_y);
    }
    elseif ($property === "z") {
      return ($this->_z);
    }
    elseif ($property === "w") {
      return ($this->_w);
    }
    throw new Exception("Propriete invalide");
  }

  function magnitude() {
    return (sqrt(pow($this->_x, 2) + pow($this->_y, 2) + pow($this->_z, 2)));
  }

  function normalize() {
    if ($this->magnitude() == 0) {
      return (new Vector(array("dest" => new Vertex(array(
          "x" => 0
        , "y" => 0
        , "z" => 0
        , "w", 0)))));
    }
    return (new Vector(array("dest" => new Vertex(array(
        "x" => $this->_x / $this->magnitude()
      , "y" => $this->_y / $this->magnitude()
      , "z" => $this->_z / $this->magnitude()
      , "w" => 1)))));
  }

  function add(Vector $vector) {
    return (new Vector(array("dest" => new Vertex(array(
        "x" => $this->_x + $vector->__get("x")
      , "y" => $this->_y + $vector->__get("y")
      , "z" => $this->_z + $vector->__get("z")
      , "w" => 1)))));
  }

  function sub(Vector $vector) {
    return (new Vector(array("dest" => new Vertex(array(
        "x" => $this->_x - $vector->__get("x")
      , "y" => $this->_y - $vector->__get("y")
      , "z" => $this->_z - $vector->__get("z")
      , "w" => 1)))));
  }

  function opposite() {
    return (new Vector(array("dest" => new Vertex(array(
        "x" => -$this->_x
      , "y" => -$this->_y
      , "z" => -$this->_z
      , "w" => 1)))));
  }

  function scalarProduct($dot) {
    return (new Vector(array("dest" => new Vertex(array(
        "x" => $this->_x * $dot
      , "y" => $this->_y * $dot
      , "z" => $this->_z * $dot
      , "w" => 1)))));
  }

  function dotProduct(Vector $vector) {
    return ($this->_x * $vector->__get("x") + $this->_y * $vector->__get("y") + $this->_z * $vector->__get("z"));
  }

  function cos(Vector $vector) {
    $length = $this->magnitude() * $vector->magnitude();
    if ($length == 0) {
      return (0);
    }
    return ($this->dotProduct($vector) / $length);
  }

  function crossProduct(Vector $vector) {
    return (new Vector(array("dest" => new Vertex(array(
        "x" => $this->_y * $vector->__get("z") - $this->_z * $vector->__get("y")
      , "y" => $this->_z * $vector->__get("x") - $this->_x * $vector->__get("z")
      , "z" => $this->_x * $vector->__get("y") - $this->_y * $vector->__get("x")
    )))));
  }

  function doc() {
    return (file_get_contents("Vector.doc.txt"));
  }

  function __toString() {
    $string = "Vector( x: ".number_format($this->_x, 2).", y: ".number_format($this->_y, 2).", z: ".number_format($this->_z, 2).", w: ".number_format($this->_w, 2)." )";
    return ($string);
  }

}
?>
