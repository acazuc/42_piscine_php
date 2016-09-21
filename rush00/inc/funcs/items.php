<?php
function item_init()
{
  if (!file_exists(DB_FOLDER))
    mkdir(DB_FOLDER);
  if (!file_exists(ITEMS_FILE))
    file_put_contents(ITEMS_FILE, serialize(array()));
}

function item_read()
{
  if (!file_exists(ITEMS_FILE))
    return (false);
  if (($content = file_get_contents(ITEMS_FILE)) === false)
    return (false);
  if (($all = unserialize($content)) === false)
    return (false);
  return ($all);
}

function item_write($items)
{
  $data = serialize($items);
  file_put_contents(ITEMS_FILE, $data);
}

function item_exists($items, $id)
{
  foreach ($items as $item)
  {
    if ($item["id"] == $id)
      return (true);
  }
  return (false);
}

function item_add($items, $id, $name, $categories, $image, $description, $price)
{
  $new = array($id, $name, $categories, $image, $description, $price);
  array_push($items, $new);
  return ($items);
}

function item_remove($items, $id)
{
  foreach ($items as $key => $item)
  {
    if ($item[0] == $id)
      unset($items[$key]);
  }
  return ($items);
}
?>
