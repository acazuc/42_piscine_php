#!/usr/bin/php
<?php
if ($argc != 4)
	die("Incorrect Parameters\n");
if (trim($argv[2]) == '+')
	echo intval(trim($argv[1])) + intval(trim($argv[3]));
if (trim($argv[2]) == '-')
	echo intval(trim($argv[1])) - intval(trim($argv[3]));
if (trim($argv[2]) == '*')
	echo intval(trim($argv[1])) * intval(trim($argv[3]));
if (trim($argv[2]) == '/')
	echo intval(trim($argv[1])) / intval(trim($argv[3]));
if (trim($argv[2]) == '%')
	echo intval(trim($argv[1])) % intval(trim($argv[3]));
echo "\n";
?>
