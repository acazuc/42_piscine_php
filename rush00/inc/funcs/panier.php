<?php
function panier_init()
{
  if (!file_exists(DB_FOLDER))
    mkdir(DB_FOLDER);
  if (!file_exists(PANIER_FILE))
    file_put_contents(PANIER_FILE, serialize(array()));
}

function save_panier($panier)
{
  file_put_contents(PANIER_FILE, serialize($panier));
}

function get_panier()
{
  panier_init();
  if (($content = file_get_contents(PANIER_FILE)) === false)
    return (false);
  if (($all = unserialize($content)) === false)
    return (false);
  return ($all);
}

function panier_add($user, $panier)
{
  if (($all = get_panier()) === false)
    return (false);
  if (!isset($all[$user]))
    $all[$user] = array();
  array_push($all[$user], $panier);
  save_panier($all);
  return (true);
}

function panier_change_account($user, $new)
{
  if (($all = get_panier()) === false)
    return (false);
  if (!isset($all[$user]) || isset($all[$new]))
    return (false);
  $all[$new] = $all[$user];
  unset($all[$user]);
  save_panier($all);
  return (true);
}

function panier_remove_account($user)
{
  if (($all = get_panier()) === false)
    return (false);
  if (!isset($all[$user]))
    return (false);
  unset($all[$user]);
  save_panier($all);
  return (true);
}
?>
