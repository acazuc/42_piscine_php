<?php
if (isset($_POST["login"]) && isset($_POST["password"]) && account_login($_POST["login"], $_POST["password"]))
{
  $_SESSION["login"] = true;
  $_SESSION["username"] = $_POST["login"];
  include("page/account.php");
}
elseif (isset($_POST["username"]) && isset($_POST["password1"]) && isset($_POST["password2"]) && $_POST["password1"] == $_POST["password2"] && account_create($_POST["username"], $_POST["password1"]))
{
  $_SESSION["login"] = true;
  $_SESSION["username"] = $_POST["username"];
  include("page/account.php");
}
else
{
  if (isset($_POST["login"]) && isset($_POST["password"]))
    echo "SORRY, INVALID CREDIENTIALS, MAYBE YOU SHOULD CONCENTRATE<br />";
  elseif (isset($_POST["username"]) && isset($_POST["password1"]) && isset($_POST["password2"]) && $_POST["password1"] == $_POST["password2"])
    echo "FAILED TO CREATE NEW ACCOUNT, SRY BRO, MAYBE IT WAS ALREADY TAKEN<br />";
  elseif (isset($_POST["password1"]) && isset($_POST["password2"]) && $_POST["password1"] != $_POST["password2"])
    echo "Not the sane passwords<br />";
  ?>
  <form method="post" style="padding:10px" action="index.php?p=login">
    <label for="field_login">Login</label>
    <input id="field_login" type="text" name="login">
    <br />
    <label for="field_password">Password</label>
    <input id="field_password" type="password" name="password">
    <br />
    <input type="submit" value="Login">
  </form>
  <hr />
  <h1 style="margin-left:15px">Pas encore inscrit ?</h1>
  <form method="post" style="padding:10px" action="index.php?p=login">
    <label for="field_username_register">Username</label>
    <input type="text" name="username">
    <br />
    <label for="field_password_1">Password</label>
    <input type="password" name="password1">
    <br />
    <label for="field_password_2">Password (repeat)</label>
    <input type="password" name="password2">
    <br />
    <input type="submit" value="Register">
  </form>
  <?php
}
?>
