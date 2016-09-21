<?php
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
  $items = item_add($items, count($items), $_POST["name"], $_POST["categories"], $_POST["image"], $_POST["description"], $_POST["price"]);
  item_write($items);
  include("page/admin/item_list.php");
}
else
{
  ?>
  <form method="post">
    <label for="field_name">Name</label>
    <input id="field_name" type="text" name="name">
    <br />
    <label for="field_categories">Categories</label>
    <select id="field_categories" name="categories[]" multiple>
      <option value="mere">Carte m&egrave;re</option>
      <option value="proc">Processeur</option>
      <option value="graph">Carte graphique</option>
    </select>
    <br />
    <label for="field_image">Image</label>
    <input id="field_image" type="text" name="image">
    <br />
    <label for="field_description">Description</label>
    <textarea id="field_description" name="description"></textarea>
    <br />
    <label for="field_price">Price</label>
    <input id="field_price" type="number" name="price">
    <br />
    <input type="submit" value="Ajouter">
  </form>
  <?php
}
?>
