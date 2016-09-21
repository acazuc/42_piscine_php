<?php
class Render {

  const VERTEX = 1;
  const EDGE = 2;
  const RASTERIZE = 3;

  public static $verbose = false;
  private $_zbuffer;
  private $_image;
  private $_filename;
  private $_height;
  private $_width;

  function __construct(array $tab) {
    $this->_filename = $tab["filename"];
    $this->_height = $tab["height"];
    $this->_width = $tab["width"];
    $this->_zbuffer = array();
    for ($i=0;$i<$this->_height;$i++) {
      $this->_zbuffer[$i] = array();
      for ($j=0;$j<$this->_width;$j++) {
        $this->_zbuffer[$i][$j] = -1;
      }
    }
    $this->_image = imagecreatetruecolor($this->_width, $this->_height);
    imagecolorallocate($this->_image, 0, 0, 0);
    if (Render::$verbose) {
      echo "Render instance constructed\n";
    }
  }

  function __destruct() {
    if (Render::$verbose) {
      echo "Render instance destructed\n";
    }
  }

  function renderPixel($x, $y, $z, $r, $g, $b) {
    $x = intval($x) + $this->_width / 2;
    $y = intval($y) + $this->_height / 2;
    if ($x >= 0 && $x < $this->_width && $y >= 0 && $y < $this->_height && ($this->_zbuffer[$y][$x] == -1 || $z > $this->_zbuffer[$y][$x])) {
      $this->_zbuffer[$y][$x] = $z;
      $color = imagecolorallocate($this->_image, intval($r), intval($g), intval($b));
      imagesetpixel($this->_image, intval($x), intval($y), $color);
    }
  }

  function renderVertex(Vertex $vertex) {
    print_r($vertex);
    $this->renderPixel($vertex->__get("x"), $vertex->__get("y"), $vertex->__get("z"), $vertex->__get("color")->red, $vertex->__get("color")->green, $vertex->__get("color")->blue);
  }

  function renderLine(Vertex $v1, Vertex $v2) {
    $start_r = $v1->__get("color")->red;
    $start_g = $v1->__get("color")->green;
    $start_b = $v1->__get("color")->blue;
    $start_z = $v1->__get("z");
    $start_x = (($v1->__get("x") + 1) * $this->_width / 2) / ($start_z / 100);
    $start_y = (($v1->__get("y") + 1) * $this->_height / 2) / ($start_z / 100);
    $end_r = $v2->__get("color")->red;
    $end_g = $v2->__get("color")->green;
    $end_b = $v2->__get("color")->blue;
    $end_z = $v2->__get("z");
    $end_x = (($v2->__get("x") + 1) * $this->_width / 2) / ($end_z / 100);
    $end_y = (($v2->__get("y") + 1) * $this->_height / 2) / ($end_z / 100);
    $diff_r = $end_r - $start_r;
    $diff_g = $end_g - $start_g;
    $diff_b = $end_b - $start_b;
    $diff_x = $end_x - $start_x;
    $diff_y = $end_y - $start_y;
    $diff_z = $end_z - $start_z;
    $total = max(abs($diff_x), abs($diff_y));
    $this->renderPixel($start_x, $start_y, $start_z, $start_r, $start_g, $start_b);
    if ($total > 0) {
      $factor = 0;
      while ($factor < 1) {
        $this->renderPixel($start_x + $diff_x * $factor, $start_y + $diff_y * $factor, $start_z + $diff_z * $factor, $start_r + $diff_r * $factor, $start_g + $diff_g * $factor, $start_b + $diff_b * $factor);
        $factor += 1 / $total / 5;
      }
    }
    $this->renderPixel($end_x, $end_y, $end_z, $end_r, $end_g, $end_b);
  }

  function drawSpan($span, $y) {
    $diff_x = $span->__get("x2") - $span->__get("x1");
    if ($diff_x == 0) {
      return ;
    }
    $diff_c = $span->__get("c2")->sub($span->__get("c1"));
    $diff_z = $span->__get("z2") - $span->__get("z1");
    $factor = 0;
    $factor_step = 1 / $diff_x;
    for ($x=$span->__get("x1");$x<$span->__get("x2");$x++) {
      $color = $span->__get("c1")->add($diff_c->mult($factor));
      $z = $span->__get("z1") + $diff_z * $factor;
      $this->renderPixel($x, $y, $z, $color->red, $color->green, $color->blue);
      $factor += $factor_step;
    }
  }

  function drawSpansBetweenEdges($e1, $e2) {
    $e1_y_diff = $e1->__get("y2") - $e1->__get("y1");
    if ($e1_y_diff == 0) {
      return ;
    }
    $e2_y_diff = $e2->__get("y2") - $e2->__get("y1");
    if ($e2_y_diff == 0) {
      return ;
    }
    $e1_x_diff = $e1->__get("x2") - $e1->__get("x1");
    $e2_x_diff = $e2->__get("x2") - $e2->__get("x1");
    $e1_c_diff = $e1->__get("c2")->sub($e1->__get("c1"));
    $e2_c_diff = $e2->__get("c2")->sub($e2->__get("c1"));
    $e1_z_diff = $e1->__get("z2") - $e1->__get("z1");
    $e2_z_diff = $e2->__get("z2") - $e2->__get("z1");
    $factor_1 = ($e2->__get("y1") - $e1->__get("y1")) / $e1_y_diff;
    $factor_1_step = 1 / $e1_y_diff;
    $factor_2 = 0;
    $factor_2_step = 1 / $e2_y_diff;
    for ($y=$e2->__get("y1");$y<$e2->__get("y2");$y++) {
      $span = new Span(
          $e1->__get("c1")->add($e1_c_diff->mult($factor_1))
        , $e1->__get("x1") + $e1_x_diff * $factor_1
        , $e1->__get("z1") + $e1_z_diff * $factor_1
        , $e2->__get("c1")->add($e2_c_diff->mult($factor_2))
        , $e2->__get("x1") + $e2_x_diff * $factor_2
        , $e2->__get("z1") + $e2_z_diff * $factor_2);
      $this->drawSpan($span, $y);
      $factor_1 += $factor_1_step;
      $factor_2 += $factor_2_step;
    }
  }

  function renderFace(Vertex $v1, Vertex $v2, Vertex $v3) {
    $z1 = $v1->__get("z");
    $x1 = (($v1->__get("x") + 1) * $this->_width / 2) / ($z1 / 100);
    $y1 = (($v1->__get("y") + 1) * $this->_height / 2) / ($z1 / 100);
    $c1 = $v1->__get("color");
    $z2 = $v2->__get("z");
    $x2 = (($v2->__get("x") + 1) * $this->_width / 2) / ($z2 / 100);
    $y2 = (($v2->__get("y") + 1) * $this->_height / 2) / ($z2 / 100);
    $c2 = $v2->__get("color");
    $z3 = $v3->__get("z");
    $x3 = (($v3->__get("x") + 1) * $this->_width / 2) / ($z3 / 100);
    $y3 = (($v3->__get("y") + 1) * $this->_height / 2) / ($z3 / 100);
    $c3 = $v3->__get("color");
    $edges = array(new Edge($c1, $x1, $y1, $z1, $c2, $x2, $y2, $z2), new Edge($c2, $x2, $y2, $z2, $c3, $x3, $y3, $z3), new Edge($c3, $x3, $y3, $z3, $c1, $x1, $y1, $z1));
    $max_length = 0;
    $long_edge = 0;
    for ($i=0;$i<3;$i++) {
      $length = $edges[$i]->__get("y2") - $edges[$i]->__get("y1");
      if ($length > $max_length) {
        $max_length = $length;
        $long_edge = $i;
      }
    }
    $short_edge_1 = ($long_edge + 1) % 3;
    $short_edge_2 = ($long_edge + 2) % 3;
    $this->drawSpansBetweenEdges($edges[$long_edge], $edges[$short_edge_1]);
    $this->drawSpansBetweenEdges($edges[$long_edge], $edges[$short_edge_2]);
  }

  function renderTriangle(Triangle $triangle, $render) {
    if ($render != Render::VERTEX && $render != Render::EDGE && $render != Render::RASTERIZE) {
      throw new Exception("Invalid render type");
    }
    if ($render == Render::VERTEX) {
      $this->renderVertex($triangle->__get("v1"));
      $this->renderVertex($triangle->__get("v2"));
      $this->renderVertex($triangle->__get("v3"));
    }
    elseif ($render == Render::EDGE) {
      $this->renderLine($triangle->__get("v1"), $triangle->__get("v2"));
      $this->renderLine($triangle->__get("v2"), $triangle->__get("v3"));
      $this->renderLine($triangle->__get("v3"), $triangle->__get("v1"));
    }
    elseif ($render == Render::RASTERIZE) {
      $this->renderFace($triangle->__get("v1"), $triangle->__get("v2"), $triangle->__get("v3"));
    }
  }

  function renderMesh(array $mesh, $render) {
    foreach ($mesh as $triangle) {
      $this->renderTriangle($triangle, $render);
    }
  }

  function develop() {
    imagepng($this->_image, $this->_filename);
  }

  function doc() {
    return (file_get_contents("Render.doc.txt"));
  }

  function __toString() {
    return ("Render ( height: ".$this->_height.", width: ".$this->_width.", filename: ".$this->_filename." )");
  }

}
?>
