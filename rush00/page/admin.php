<div id="menu_sub">
  <a href="index.php?p=admin&amp;sub=panier_list">
    <div class="item">
      Liste des paniers enregistres
    </div>
  </a>
  <a href="index.php?p=admin&amp;sub=item_list">
    <div class="item">
      Liste des objets
    </div>
  </a>
  <a href="index.php?p=admin&amp;sub=item_add">
    <div class="item">
      Ajouter un objet
    </div>
  </a>
</div>
<?php
if (!isset($_GET["sub"]))
  $_GET["sub"] = "";
switch($_GET["sub"])
{
  case "item_add":
    include("page/admin/item_add.php");
    break;
  case "item_edit":
    include("page/admin/item_edit.php");
    break;
  case "item_remove":
    include("page/admin/item_remove.php");
    break;
  case "panier_list":
    include("page/admin/panier_list.php");
    break;
  default:
    include("page/admin/item_list.php");
    break;
}
?>
