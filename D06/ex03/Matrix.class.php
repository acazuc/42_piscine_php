<?php
class Matrix {

  const IDENTITY = 1;
  const SCALE = 2;
  const RX = 3;
  const RY = 4;
  const RZ = 5;
  const TRANSLATION = 6;
  const PROJECTION = 7;

  public static $verbose = false;
  private $_content;
  private $_preset;

  function __construct(array $tab) {
    $this->_content = array();
    for ($i=0;$i<4;$i++) {
      $this->_content[$i] = array(0, 0, 0, 0);
    }
    $this->_preset = $tab["preset"];
    if ($this->_preset == Matrix::IDENTITY) {
      if (Matrix::$verbose) {
        echo "Matrix IDENTITY preset instance constructed".PHP_EOL;
      }
      $this->_content[0][0] = 1;
      $this->_content[1][1] = 1;
      $this->_content[2][2] = 1;
      $this->_content[3][3] = 1;
    }
    else if ($this->_preset == Matrix::TRANSLATION) {
      if (Matrix::$verbose) {
        echo "Matrix TRANSLATION preset instance constructed".PHP_EOL;
      }
      $this->_content[0][0] = 1;
      $this->_content[1][1] = 1;
      $this->_content[2][2] = 1;
      $this->_content[3][3] = 1;
      $this->_content[0][3] = $tab["vtc"]->__get("x");
      $this->_content[1][3] = $tab["vtc"]->__get("y");
      $this->_content[2][3] = $tab["vtc"]->__get("z");
    }
    else if ($this->_preset == Matrix::SCALE) {
      if (Matrix::$verbose) {
        echo "Matrix SCALE preset instance constructed".PHP_EOL;
      }
      $this->_content[0][0] = $tab["scale"];
      $this->_content[1][1] = $tab["scale"];
      $this->_content[2][2] = $tab["scale"];
      $this->_content[3][3] = 1;
    }
    else if ($this->_preset == Matrix::RX) {
      if (Matrix::$verbose) {
        echo "Matrix Ox ROTATION preset instance constructed".PHP_EOL;
      }
      $this->_content[0][0] = 1;
      $this->_content[1][1] = cos($tab["angle"]);
      $this->_content[1][2] = -sin($tab["angle"]);
      $this->_content[2][1] = sin($tab["angle"]);
      $this->_content[2][2] = cos($tab["angle"]);
      $this->_content[3][3] = 1;
    }
    else if ($this->_preset == Matrix::RY) {
      if (Matrix::$verbose) {
        echo "Matrix Oy ROTATION preset instance constructed".PHP_EOL;
      }
      $this->_content[0][0] = cos($tab["angle"]);
      $this->_content[0][2] = sin($tab["angle"]);
      $this->_content[1][1] = 1;
      $this->_content[2][0] = -sin($tab["angle"]);
      $this->_content[2][2] = cos($tab["angle"]);
      $this->_content[3][3] = 1;
    }
    else if ($this->_preset == Matrix::RZ) {
      if (Matrix::$verbose) {
        echo "Matrix Oz ROTATION preset instance constructed".PHP_EOL;
      }
      $this->_content[0][0] = cos($tab["angle"]);
      $this->_content[0][1] = -sin($tab["angle"]);
      $this->_content[1][0] = sin($tab["angle"]);
      $this->_content[1][1] = cos($tab["angle"]);
      $this->_content[2][2] = 1;
      $this->_content[3][3] = 1;
    }
    else if ($this->_preset == Matrix::PROJECTION) {
      if (Matrix::$verbose) {
        echo "Matrix PROJECTION preset instance constructed".PHP_EOL;
      }
      $fov = 1 / tan($tab["fov"] / 2 / 180. * M_PI);
      $this->_content[0][0] = $fov / $tab["ratio"];
      $this->_content[1][1] = $fov;
      $this->_content[2][2] = -($tab["far"] + $tab["near"]) / ($tab["far"] - $tab["near"]);
      $this->_content[3][2] = -1;
      $this->_content[2][3] = (2 * $tab["near"] * $tab["far"]) / ($tab["near"] - $tab["far"]);
    }
  }

  function __destruct() {
    if (Matrix::$verbose) {
      echo "Matrix instance destructed".PHP_EOL;
    }
  }

  private function patch($m1, $m2, $x, $y) {
    return ($m1[$y][0] * $m2[0][$x] + $m1[$y][1] * $m2[1][$x] + $m1[$y][2] * $m2[2][$x] + $m1[$y][3] * $m2[3][$x]);
  }

  function mult(Matrix $matrice) {
    $tab = array();
    for ($i=0;$i<4;$i++) {
      $tab[$i] = array(0, 0, 0, 0);
    }
    for($y=0;$y<4;$y++) {
      for($x=0;$x<4;$x++) {
        $tab[$y][$x] = $this->patch($this->_content, $matrice->_content, $x, $y);
      }
    }
    $tmp = Matrix::$verbose;
    Matrix::$verbose = false;
    $new = new Matrix(array("preset" => ""));
    $new->_content = $tab;
    Matrix::$verbose = $tmp;
    return ($new);
  }

  function symetrie() {
    $tab = array();
    for ($i=0;$i<4;$i++) {
      $tab[$i] = array(0, 0, 0, 0);
    }
    for($y=0;$y<4;$y++) {
      for($x=0;$x<4;$x++) {
        $tab[$y][$x] = $this->_content[$x][$y];
      }
    }
    $tmp = Matrix::$verbose;
    Matrix::$verbose = false;
    $new = new Matrix(array("preset" => ""));
    $new->_content = $tab;
    Matrix::$verbose = $tmp;
    return ($new);
  }

  function transformVertex(Vertex $vertex) {
    $array["x"] = $vertex->__get("x") * $this->_content[0][0] + $vertex->__get("y") * $this->_content[0][1] + $vertex->__get("z") * $this->_content[0][2] + $vertex->__get("w") * $this->_content[0][3];
    $array["y"] = $vertex->__get("x") * $this->_content[1][0] + $vertex->__get("y") * $this->_content[1][1] + $vertex->__get("z") * $this->_content[1][2] + $vertex->__get("w") * $this->_content[1][3];
    $array["z"] = $vertex->__get("x") * $this->_content[2][0] + $vertex->__get("y") * $this->_content[2][1] + $vertex->__get("z") * $this->_content[2][2] + $vertex->__get("w") * $this->_content[2][3];
    $array["w"] = 1;
    $array["color"] = $vertex->__get("color");
    return (new Vertex($array));
  }

  function transformTriangle(Triangle $triangle) {
    $v1 = $this->transformVertex($triangle->__get("v1"));
    $v2 = $this->transformVertex($triangle->__get("v2"));
    $v3 = $this->transformVertex($triangle->__get("v3"));
    $new = new Triangle(array("A" => $v1, "B" => $v2, "C" => $v3));
    return ($new);
  }

  function transformMesh(array $mesh) {
    $new = array();
    foreach ($mesh as $triangle) {
      array_push($new, $this->transformTriangle($triangle));
    }
    return ($new);
  }

  function doc() {
    return (file_get_contents("Matrix.doc.txt"));
  }

  function __toString() {
    $string = "M | vtcX | vtcY | vtcZ | vtx0".PHP_EOL;
    $string.= "-----------------------------".PHP_EOL;
    $string.= "x | ".number_format($this->_content[0][0], 2)." | ".number_format($this->_content[0][1], 2)." | ".number_format($this->_content[0][2], 2)." | ".number_format($this->_content[0][3], 2).PHP_EOL;
    $string.= "y | ".number_format($this->_content[1][0], 2)." | ".number_format($this->_content[1][1], 2)." | ".number_format($this->_content[1][2], 2)." | ".number_format($this->_content[1][3], 2).PHP_EOL;
    $string.= "z | ".number_format($this->_content[2][0], 2)." | ".number_format($this->_content[2][1], 2)." | ".number_format($this->_content[2][2], 2)." | ".number_format($this->_content[2][3], 2).PHP_EOL;
    $string.= "w | ".number_format($this->_content[3][0], 2)." | ".number_format($this->_content[3][1], 2)." | ".number_format($this->_content[3][2], 2)." | ".number_format($this->_content[3][3], 2);
    return ($string);
  }

}
?>
