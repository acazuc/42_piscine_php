<?php
function ft_split($string)
{
	$tab = preg_split('@ @', $string, NULL, PREG_SPLIT_NO_EMPTY);
	sort($tab, SORT_STRING);
	return ($tab);
}
?>
