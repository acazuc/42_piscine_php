<?php
include ("inc/const.php");
include ("inc/funcs/items.php");
mkdir(DB_FOLDER);
item_init();
account_init();
panier_init();
?>
