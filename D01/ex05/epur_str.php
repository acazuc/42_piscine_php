#!/usr/bin/php
<?php
if ($argc >= 2)
	echo preg_replace('/\s+/', ' ', trim(str_replace("\n", " ", str_replace("\t", " ", $argv[1]))))."\n";
?>
