#!/usr/bin/php
<?php
function do_moyenne($content) {
	$datas = explode("\n", $content);
	$total = 0;
	$number = 0;
	foreach($datas as $data)
	{
		$tmp = explode(";", $data);
		if (count($tmp) != 4)
			continue;
		if ($tmp[2] == "moulinette")
			continue;
		if (!is_numeric($tmp[1]))
			continue;
		$total += $tmp[1];
		$number++;
	}
	echo $total / $number;
	echo "\n";
}

function do_moyenne_user($content)
{
	$datas = explode("\n", $content);
	$number = array();
	$total = array();
	foreach($datas as $data)
	{
		$tmp = explode(";", $data);
		if (count($tmp) != 4)
			continue;
		if (!is_numeric($tmp[1]))
			continue;
		if ($tmp[2] == "moulinette")
			continue;
		if (!isset($number[$tmp[0]]))
		{
			$number[$tmp[0]] = 1;
			$total[$tmp[0]] = $tmp[1];
		}
		else
		{
			$number[$tmp[0]]++;
			$total[$tmp[0]] += intval($tmp[1]);
		}
	}
	ksort($number);
	ksort($total);
	foreach($number as $key=>$value)
	{
		echo $key.":".($total[$key]/$number[$key])."\n";
	}
}

function do_ecart_moulinette($content)
{
	echo "oui";
	$datas = explode("\n", $content);
	$tab = array();
	foreach($datas as $data)
	{
		$tmp = explode(";", $data);
		if (count($tmp) != 4)
			continue;
		if (!is_numeric($tmp[1]))
			continue;
		if (!isset($tab[$tmp[0]]))
			$tab[$tmp[0]] = array(0, 0, 0, 0);
		if ($tmp[2] == "moulinette")
		{
			$tab[$tmp[0]][2]++;
			$tab[$tmp[0]][3] += intval($tmp[1]);
		}
		else
		{
			$tab[$tmp[0]][0]++;
			$tab[$tmp[0]][1] += intval($tmp[1]);
		}
	}
	ksort($tab);
	foreach($tab as $key=>$value)
	{
		echo $key.":".(($value[1]/$value[0])-($value[3]/$value[2]))."\n";
	}

}

if ($argc != 2)
	die();
$content = "";
while ($tmp = fgets(STDIN))
	$content.= $tmp;
if ($argv[1] == "moyenne")
	do_moyenne($content);
if ($argv[1] == "moyenne_user")
	do_moyenne_user($content);
if ($argv[1] == "ecart_moulinette")
	do_ecart_moulinette($content);
?>
