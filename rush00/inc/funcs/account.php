<?php
function account_init()
{
  if (!file_exists(DB_FOLDER))
    mkdir(DB_FOLDER);
  if (!file_exists(ACCOUNTS_FILE))
    file_put_contents(ACCOUNTS_FILE, serialize(array()));
}

function account_save($accounts)
{
  file_put_contents(ACCOUNTS_FILE, serialize($accounts));
}

function account_get()
{
  account_init();
  if (($content = file_get_contents(ACCOUNTS_FILE)) === false)
    return (false);
  if (($all = unserialize($content)) === false)
    return (false);
  return ($all);
}

function account_login($user, $password)
{
  if (($all = account_get()) === false)
    return (false);
  if (isset($all[$user]) && $all[$user] == hash("whirlpool", $password))
    return (true);
  return (false);
}

function account_create($user, $pass)
{
  if (($all = account_get()) === false)
    return (false);
  if (isset($all[$user]))
    return (false);
  $all[$user] = hash("whirlpool", $pass);
  account_save($all);
  return (true);
}

function account_change_password($user, $pass)
{
  if (($all = account_get) === false)
    return (false);
  if (!isset($all[$user]))
    return (false);
  $all[$user] = hash("whirlpool", $pass);
  account_save($all);
  return (true);
}

function account_change_username($user, $new)
{
  if (($all = account_get()) === false)
    return (false);
  if (!isset($all[$user]) || isset($all[$new]))
    return (false);
  $all[$new] = $all[$user];
  unset($all[$user]);
  account_save($all);
  panier_change_account($user, $new);
  return (true);
}
function account_delete($user)
{
  if (($all = account_get()) === false)
    return (false);
  if (!isset($all[$user]))
    return (false);
  unset($all[$user]);
  account_save($all);
  panier_remove_account($user);
  return (true);
}
?>
