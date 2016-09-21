#!/usr/bin/php
<?php
function get_category($c)
{
	if ($c >= 'a' && $c <= 'z')
		return (1);
	if ($c >= '0' && $c <= '9')
		return (2);
	return (3);
}
function same_category($c1, $c2)
{
	return (get_category($c1) == get_category($c2));
}
function op_cmp($vv1, $vv2)
{
	$v1 = strtolower($vv1);
	$v2 = strtolower($vv2);
	for($i=0;$i<strlen($v1)&&$i<strlen($v2)&&$v1[$i]==$v2[$i];$i++)
	{}
	if (strlen($v1) == strlen($v2) && strlen($v1) == $i)
		return (0);
	if (strlen($v1) == $i)
		return (-1);
	if (strlen($v2) == $i)
		return (1);
	if ($v1[$i] != $v2[$i])
	{
		if (same_category($v1[$i], $v2[$i]))
			return (($v1[$i] < $v2[$i]) ? -1 : 1);
		return ((get_category($v1[$i]) < get_category($v2[$i])) ? -1 : 1);
	}
	return (0);
}
$tab = array();
for($i=1;$i<$argc;$i++)
{
	$argv[$i] = str_replace("\t", " ", $argv[$i]);
	$tab2 = preg_split('@ @', $argv[$i], NULL, PREG_SPLIT_NO_EMPTY);
	for ($j=0;$j<count($tab2);$j++)
	{
		array_push($tab, $tab2[$j]);
	}
}
uasort($tab, 'op_cmp');
foreach($tab as $val)
	echo $val."\n";
?>
