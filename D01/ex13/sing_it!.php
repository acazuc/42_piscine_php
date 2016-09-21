#!/usr/bin/php
<?php
if ($argc != 2)
	die();
$s = $argv[1];
if ($s == "mais pourquoi cette demo ?")
	die("Tout simplement pour qu'en feuilletant le sujet\non ne s'apercoive pas de la nature de l'exo\n");
if ($s == "mais pourquoi cette chanson ?")
	die("Parce que Kwame a des enfants\n");
if ($s == "vraiment ?")
{
	if (file_exists("switch"))
		die("Oui il a vraiment des enfants\n");
	else
	{
		fopen("switch", "w");
		die("Nan c'est parce que c'est le premier avril\n");
	}
}
?>
