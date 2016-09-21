<?php
if (!isset($_GET["id"]))
  include ("page/home.php");
else
{
  foreach($items as $item)
  {
    if ($item[0] == $_GET["id"])
    {
      array_push($_SESSION["panier"], $_GET["id"]);
      break;
    }
  }
  include ("page/panier.php");
}
?>
