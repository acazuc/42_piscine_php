<?php
if (isset($_POST["ok"]) && isset($_POST["check"]))
{
  if (!account_login($_SESSION["username"], $_POST["check"]))
    echo "Y U NO REMEMBER YOUR PASSWORD<br />";
  else
  {
    account_delete($_SESSION["username"]);
    session_destroy();
    $_SESSION = array();
    include("page/login.php");
  }
}
else
{
  ?>
  <h1>ARE YOU SURE YOU WANT TO DELETE YOUR ACCOUNT ? IT IS NOT REVERSIBLE</h1>
  <form method="post" action="index.php?p=account&amp;sub=delete_account">
    <label for="field_password">Password</label>
    <input type="hidden" name="ok">
    <input type="password" name="check"><br />
    <input type="submit" value="Supprimer">
  </form>
  <?php
}
?>
