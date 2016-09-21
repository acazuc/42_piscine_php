#!/usr/bin/php
<?php
while (1)
{
	echo "Entrez un nombre: ";
	if (!($line = fgets(STDIN)))
		die("\n");
	$line = substr($line, 0, strlen($line) - 1);
	if (!is_numeric($line))
		echo "'".$line."' n'est pas un chiffre\n";
	else
	{
		echo "Le chiffre ".$line;
		if ($line %2 == 0)
			echo " est Pair";
		else
			echo " est Impair";
		echo "\n";
	}
}
?>
