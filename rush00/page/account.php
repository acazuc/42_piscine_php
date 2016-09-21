<div id="menu_sub">
  <a href="index.php?p=account&amp;sub=edit_username">
    <div class="item">
      Changer de nom de compte
    </div>
  </a>
  <a href="index.php?p=account&amp;sub=edit_password">
    <div class="item">
      Changer de mot de passe
    </div>
  </a>
  <a href="index.php?p=account&amp;sub=delete_account">
    <div class="item">
      Supprimer mon compte
    </div>
  </a>
  <a href="index.php?p=account&amp;sub=logout">
    <div class="item">
      Deconnexion
    </div>
  </a>
</div>
<?php
if (!isset($_GET["sub"]))
  $_GET["sub"] = "";
switch($_GET["sub"])
{
  case "edit_username":
    include("page/account/edit_username.php");
    break;
  case "edit_password":
    include("page/account/edit_password.php");
    break;
  case "delete_account":
    include("page/account/delete_account.php");
    break;
  case "logout":
    include("page/account/logout.php");
    break;
  default:
    include("page/account/home.php");
    break;
}
?>
