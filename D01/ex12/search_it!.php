#!/usr/bin/php
<?php
if ($argc < 3)
	die();
$key = $argv[1];
$datas = array();
for($i=2;$i<$argc;$i++)
{
	$ex = explode(":", $argv[$i], 2);
	if (count($ex) != 2)
		die();
	$datas[$ex[0]] = $ex[1];
}
if (isset($datas[$key]))
	echo $datas[$key]."\n";
?>
