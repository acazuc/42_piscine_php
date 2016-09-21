<?php
class Camera {

  public static $verbose = false;
  private $_position;
  private $_translate_rotate_matrix;
  private $_translate_matrix;
  private $_project_matrix;
  private $_rotate_matrix;
  private $_matrix;
  private $_width;
  private $_height;

  function __construct(array $tab) {
    $this->_position = $tab["origin"];
    $this->_translate_matrix = new Matrix(array("preset" => Matrix::TRANSLATION, "vtc" => (new Vector(array("dest" => $this->_position)))->opposite()));
    $this->_rotate_matrix = $tab["orientation"];
    $this->_rotate_matrix = $this->_rotate_matrix->symetrie();
    if (isset($tab["ratio"])) {
      $ratio = $tab["ratio"];
      $this->_width = 1920;
      $this->_height = 1920 / $ratio;
    }
    else {
      $ratio = $tab["width"] / $tab["height"];
      $this->_width = $tab["width"];
      $this->_height = $tab["height"];
    }
    $fov = $tab["fov"];
    $near = $tab["near"];
    $far = $tab["far"];
    $this->_translate_rotate_matrix = $this->_rotate_matrix->mult($this->_translate_matrix);
    $this->_project_matrix = new Matrix(array("preset" => Matrix::PROJECTION, "fov" => $fov, "ratio" => $ratio, "far" => $far, "near" => $near));
    if (Camera::$verbose) {
      echo "Camera instance constructed\n";
    }
  }

  function __destruct() {
    if (Camera::$verbose) {
      echo "Camera instance destructed\n";
    }
  }

  function watchVertex(Vertex $vertex) {
    $vertex = $this->_project_matrix->transformVertex($this->_translate_rotate_matrix->transformVertex($vertex));
    $vertex->__set("x", ($vertex->__get("x") / ($this->_width / 2)) - 1);
    $vertex->__set("y", ($vertex->__get("y") / ($this->_height / 2)) - 1);
    return ($vertex);
  }

  function watchTriangle(Triangle $triangle) {
    $v1 = $this->watchVertex($triangle->__get("v1"));
    $v2 = $this->watchVertex($triangle->__get("v2"));
    $v3 = $this->watchVertex($triangle->__get("v3"));
    return (new Triangle(array("A" => $v1, "B" => $v2, "C" => $v3)));
  }

  function watchMesh(array $mesh) {
    $new = array();
    foreach ($mesh as $triangle) {
      array_push($new, $this->watchTriangle($triangle));
    }
    return ($new);
  }

  function doc() {
    return (file_get_contents("Camera.doc.txt"));
  }

  function __toString() {
    $string = "Camera( \n";
    $string.= "+ Origine: ".$this->_position."\n";
    $string.= "+ tT:\n";
    $string.= $this->_translate_matrix;
    $string.= "\n+ tR:\n";
    $string.= $this->_rotate_matrix;
    $string.= "\n+ tR->mult( tT ):\n";
    $string.= $this->_translate_rotate_matrix;
    $string.= "\n+ Proj:\n";
    $string.= $this->_project_matrix;
    $string.= "\n)";
    return ($string);
  }

}
?>
