<?php
if (!isset($_GET["id"]))
{
  include("page/admin/item_list.php");
}
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
  function valid_values($cat)
  {
    foreach($cat as $c)
    {
      if ($c != "mere" && $c != "proc" && $c != "graph")
        return (false);
    }
    return (true);
  }
  if (isset($_POST["name"]) && isset($_POST["categories"]) && valid_values($_POST["categories"]) && isset($_POST["image"])
  && isset($_POST["description"]) && isset($_POST["price"]) && is_numeric($_POST["price"]))
  {
    $items = item_remove($items, $_GET["id"]);
    $items = item_add($items, $_GET["id"], $_POST["name"], $_POST["categories"], $_POST["image"], $_POST["description"], $_POST["price"]);
    item_write($items);
    include("page/admin/item_list.php");
  }
  else
  {
    ?>
    <form method="post">
      <label for="field_name">Name</label>
      <input id="field_name" type="text" name="name" value="<?php echo htmlspecialchars($item[1]); ?>">
      <br />
      <label for="field_categories">Categories</label>
      <select id="field_categories" name="categories[]" multiple>
        <option value="mere"<?php if (in_array("mere", $item[2])){echo " selected";} ?>>Carte m&egrave;re</option>
        <option value="proc"<?php if (in_array("proc", $item[2])){echo " selected";} ?>>Processeur</option>
        <option value="graph"<?php if (in_array("graph", $item[2])){echo " selected";} ?>>Carte graphique</option>
      </select>
      <br />
      <label for="field_image">Image</label>
      <input id="field_image" type="text" name="image" value="<?php echo htmlspecialchars($item[3]); ?>">
      <br />
      <label for="field_description">Description</label>
      <textarea id="field_description" name="description"><?php echo htmlspecialchars($item[4]); ?></textarea>
      <br />
      <label for="field_price">Price</label>
      <input id="field_price" type="number" name="price" value="<?php echo htmlspecialchars($item[5]); ?>">
      <br />
      <input type="submit" value="Modifier">
    </form>
    <?php
  }
}
?>
