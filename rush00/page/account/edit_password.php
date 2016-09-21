<?php
if (isset($_POST["new1"]) && isset($_POST["new2"]) && isset($_POST["password"]))
{
  if ($_POST["new1"] != $_POST["new2"])
    echo "NOT THERE SAME PASSWORD, WHY U NO TYPE THE SAME THING TWICE<br />";
  if (!account_login($_SESSION["username"], $_POST["password"]))
    echo "Y U NO REMEMBER YOUR PASSWORD<br />";
  elseif (!account_change_password($_SESSION["username"], $_POST["new1"]))
    echo "THERE WAS AN ERROR, PLZ TRY EAGAIN(mdr)<br />";
}
?>
<form method="post" action="index.php?p=account&amp;sub=edit_username">
  <label for="field_new1">New password</label>
  <input id="field_new1" type="text" name="new1"><br />
    <label for="field_new2">New password (repeat)</label>
    <input id="field_new2" type="text" name="new2"><br />
    <label for="field_password">Password (current)</label>
    <input id="field_password" type="password" name="current"><br />
    <input type="submit" value="Change">
</form>
