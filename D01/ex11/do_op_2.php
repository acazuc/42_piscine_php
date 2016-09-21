#!/usr/bin/php
<?php
if ($argc != 2)
	die("Incorrect Parameters\n");
$s = trim(str_replace(" ", "", $argv[1]));
$i = 0;
while ($i < strlen($s) && is_numeric($s[$i]))
	$i++;
if ($i == 0 || $i == strlen($s))
	die("Syntax Error\n");
if ($s[$i] != '+' && $s[$i] != '-' && $s[$i] != '*' && $s[$i] != '/' && $s[$i] != '%')
	die("Syntax Error\n");
$op = $s[$i];
$i++;
if ($i == strlen($i))
	die("Syntax Error\n");
while ($i < strlen($s) && is_numeric($s[$i]))
	$i++;
if ($i != strlen($s))
	die("Syntax Error\n");
if ($op == '+')
{
	$tab = explode("+", $s);
	echo (intval($tab[0]) + intval($tab[1]));
}
if ($op == '-')
{
	$tab = explode("-", $s);
	echo (intval($tab[0]) - intval($tab[1]));
}
if ($op == '*')
{
	$tab = explode("*", $s);
	echo (intval($tab[0]) * intval($tab[1]));
}
if ($op == '/')
{
	$tab = explode("/", $s);
	echo (intval($tab[0]) / intval($tab[1]));
}
if ($op == '%')
{
	$tab = explode("%", $s);
	echo (intval($tab[0]) % intval($tab[1]));
}
echo "\n";
?>
