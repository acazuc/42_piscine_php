<?php
if (!isset($_GET["id"]))
  include("page/home.php");
else
{
  if (isset($_SESSION["panier"][$_GET["id"]]))
    unset($_SESSION["panier"][$_GET["id"]]);
  include("page/panier.php");
}
?>
