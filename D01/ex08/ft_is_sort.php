<?php
function ft_is_sort($tab)
{
	$sorted = $tab;
	sort($sorted);
	for($i=0;$i<count($sorted);$i++)
		if ($sorted[$i] != $tab[$i])
			return (false);
	return (true);
}
?>
