<?php
if (!isset($_GET["id"]))
  include("page/admin/item_list.php");
else
{
  $item = null;
  foreach ($items as $i)
  {
    if ($i[0] == $_GET["id"])
    {
      $item = $i;
      break;
    }
  }
  if ($item == null)
    include("page/admin/item_list.php");
  else
  {
    if (isset($_POST["valid"]))
    {
      $items = item_remove($items, $_GET["id"]);
      item_write($items);
      include("page/admin/item_list.php");
    }
    else
    {
      ?>
      Etes vous sur de vouloir supprimer l'objet <?php echo $item[1]; ?> ?<br />
      <form method="post">
        <input type="hidden" name="valid">
        <input type="submit" value="confirmer">
      </form>
      <?php
    }
  }
}
?>
