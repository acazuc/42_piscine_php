#!/usr/bin/php
<?php
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
sort($tab, SORT_STRING);
for($i=0;$i<count($tab);$i++)
	echo $tab[$i]."\n";
?>
