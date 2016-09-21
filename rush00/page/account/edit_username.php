<?php
if (isset($_POST["new"]) && isset($_POST["password"]))
{
  if ($_SESSION["username"] == $_POST["new"])
    echo "SAME USERNAME OMG....<br />";
  if (!account_login($_SESSION["username"], $_POST["password"]))
    echo "Y U NO REMEMBER YOUR PASSWORD<br />";
  elseif (!account_change_username($_SESSION["username"], $_POST["new"]))
    echo "THERE WAS AN ERROR, PLZ TRY EAGAIN(mdr)<br />";
  $_SESSION["username"] = $_POST["new"];
}
?>
<form method="post" action="index.php?p=account&amp;sub=edit_username">
  <label for="field_username">New username</label>
  <input id="field_username" type="text" name="new"><br />
    <label for="field_password">Password</label>
    <input id="field_password" type="password" name="password"><br />
    <input type="submit" value="Change">
</form>
