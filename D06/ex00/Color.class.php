<?php
class Color {

  public static $verbose = false;
  public $red;
  public $green;
  public $blue;

  function __construct(array $tab) {
    if (isset($tab["red"]) && isset($tab["green"]) && isset($tab["blue"]))
    {
      $this->red = intval($tab["red"]);
      $this->green = intval($tab["green"]);
      $this->blue = intval($tab["blue"]);
    }
    else
    {
      $this->red = (intval($tab["rgb"]) >> 16) & 0xFF;
      $this->green = (intval($tab["rgb"]) >> 8) & 0xFF;
      $this->blue = (intval($tab["rgb"])) & 0xFF;
    }
    if (Color::$verbose) {
      echo $this->__toString()." constructed".PHP_EOL;
    }
  }

  function __destruct() {
    if (Color::$verbose) {
      echo $this->__toString()." destructed".PHP_EOL;
    }
  }

  function add(Color $c) {
    $color = new Color(array("red" => $this->red + $c->red
      , "green" => $this->green + $c->green
      , "blue" => $this->blue + $c->blue)
    );
    return ($color);
  }

  function sub(Color $c) {
    $color = new Color(array("red" => $this->red - $c->red
      , "green" => $this->green - $c->green
      , "blue" => $this->blue - $c->blue)
    );
    return ($color);
  }

  function mult($factor) {
    $color = new Color(array("red" => $this->red * $factor
      , "green" => $this->green * $factor
      , "blue" => $this->blue * $factor)
    );
    return ($color);
  }

  static function doc() {
    return (file_get_contents("Color.doc.txt"));
  }

  function __toString() {
    $string = "Color( red: ";
    if ($this->red < 100) {
      $string.= " ";
    }
    if ($this->red < 10) {
      $string.= " ";
    }
    $string.= $this->red.", green: ";
    if ($this->green < 100) {
      $string.= " ";
    }
    if ($this->green < 10) {
      $string.= " ";
    }
    $string.= $this->green.", blue: ";
    if ($this->blue < 100) {
      $string.= " ";
    }
    if ($this->blue < 10) {
      $string.= " ";
    }
    $string.= $this->blue." )";
    return ($string);
  }

}
?>
