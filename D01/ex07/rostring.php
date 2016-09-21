#!/usr/bin/php
<?php
if ($argc > 1)
{
	$string = $argv[1];
	$tab = preg_split("@ @", $string);
	$last = $tab[count($tab) - 1];
	$tab2 = array();
	for ($i=1;$i<count($tab);$i++)
		array_push($tab2, $tab[$i]);
	array_push($tab2, $tab[0]);
	for($i=0;$i<count($tab2);$i++)
		echo $tab2[$i]."\n";
}
?>
