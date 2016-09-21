<?php
class Vertex {

  public static $verbose = false;
  private $_color;
  private $_x;
  private $_y;
  private $_z;
  private $_w;
  private $_u;
  private $_v;

  function __construct(array $tab) {
    if (isset($tab["x"])) {
      $this->_x = $tab["x"];
    }
    else {
      $this->_x = 0;
    }
    if (isset($tab["y"])) {
      $this->_y = $tab["y"];
    }
    else {
      $this->_y = 0;
    }
    if (isset($tab["z"])) {
      $this->_z = $tab["z"];
    }
    else {
      $this->_z = 0;
    }
    if (isset($tab["w"])) {
      $this->_w = $tab["w"];
    }
    else {
      $this->_w = 1;
    }
    $this->_u = 1;
    if (isset($tab["u"])) {
      $this->_u = $tab["u"];
    }
    $this->_v = 1;
    if (isset($tab["v"])) {
      $this->_v = $tab["v"];
    }
    if (isset($tab["color"])) {
      $this->_color = $tab["color"];
    }
    else {
      $this->_color = new Color(array("red" => 255, "green" => 255, "blue" => 255));
    }
    if (Vertex::$verbose) {
      echo $this->__toString()." constructed".PHP_EOL;
    }
  }

  function __destruct() {
    if (Vertex::$verbose) {
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
    elseif ($property === "u") {
      return ($this->_u);
    }
    elseif ($property === "v") {
      return ($this->_v);
    }
    elseif ($property === "color") {
      return ($this->_color);
    }
    throw new Exception("Propriete invalide");
  }

  function __set($property, $value) {
    if ($property === "x") {
      $this->_x = $value;
    }
    elseif ($property === "y") {
      $this->_y = $value;
    }
    elseif ($property === "z") {
      $this->_z = $value;
    }
    elseif ($property === "w") {
      $this->_w = $value;
    }
    elseif ($property === "u") {
      $this->_u = $value;
    }
    elseif ($property === "v") {
      $this->_v = $value;
    }
    elseif ($property === "color") {
      $this->_color = $value;
    }
    else {
      throw new Exception("Propriete invalide");
    }
  }

  static function doc() {
    return (file_get_contents("Vertex.doc.txt"));
  }

  function __toString() {
    $string = "Vertex( x: ".number_format($this->_x, 2).", y: ".number_format($this->_y, 2).", z: ".number_format($this->_z, 2).", w: ".number_format($this->_w, 2).", u: ".number_format($this->_u, 2).", v: ".number_format($this->_v, 2);
    if (Vertex::$verbose) {
      if (isset($this->_color))
        $string.= ", color: ".$this->_color->__toString();
    }
    $string.= " )";
    return ($string);
  }

}
?>
