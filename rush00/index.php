<?php
session_start();
if (!isset($_SESSION["panier"]))
	$_SESSION["panier"] = array();
if (!isset($_SESSION["login"]))
	$_SESSION["login"] = false;
include("inc/const.php");
include("inc/funcs/items.php");
include("inc/funcs/account.php");
include("inc/funcs/panier.php");
$items = item_read();
/*$i = 0;
$items = item_add($items, $i++, "Intel core i1", array("proc"), "http://media.ldlc.com/ld/products/00/01/28/72/LD0001287264_2.jpg", "GROS PROCESSEUR", 50);
$items = item_add($items, $i++, "Intel core i2", array("proc"), "http://media.ldlc.com/ld/products/00/01/28/72/LD0001287264_2.jpg", "GROS PROCESSEUR", 100);
$items = item_add($items, $i++, "Intel core i3", array("proc"), "http://media.ldlc.com/ld/products/00/01/28/72/LD0001287264_2.jpg", "GROS PROCESSEUR", 150);
$items = item_add($items, $i++, "Intel core i4", array("proc"), "http://media.ldlc.com/ld/products/00/01/28/72/LD0001287264_2.jpg", "GROS PROCESSEUR", 200);
$items = item_add($items, $i++, "Intel core i5", array("proc"), "http://media.ldlc.com/ld/products/00/01/28/72/LD0001287264_2.jpg", "GROS PROCESSEUR", 250);
$items = item_add($items, $i++, "Intel core i6", array("proc"), "http://media.ldlc.com/ld/products/00/01/28/72/LD0001287264_2.jpg", "GROS PROCESSEUR", 300);
$items = item_add($items, $i++, "Intel core i7", array("proc"), "http://media.ldlc.com/ld/products/00/01/28/72/LD0001287264_2.jpg", "GROS PROCESSEUR", 350);
$items = item_add($items, $i++, "Intel core i8", array("proc"), "http://media.ldlc.com/ld/products/00/01/28/72/LD0001287264_2.jpg", "GROS PROCESSEUR", 400);
$items = item_add($items, $i++, "Intel core i9", array("proc"), "http://media.ldlc.com/ld/products/00/01/28/72/LD0001287264_2.jpg", "GROS PROCESSEUR", 450);
$items = item_add($items, $i++, "SS1939", array("graph"), "http://www.ixbt.com/video2/images/gf4ti4200-3/sparkle-4200-back.jpg", "GROSSE CARTE GRAPHIQUE", 500);
$items = item_add($items, $i++, "SS1940", array("graph"), "http://www.ixbt.com/video2/images/gf4ti4200-3/sparkle-4200-back.jpg", "GROSSE CARTE GRAPHIQUE", 1000);
$items = item_add($items, $i++, "SS1941", array("graph"), "http://www.ixbt.com/video2/images/gf4ti4200-3/sparkle-4200-back.jpg", "GROSSE CARTE GRAPHIQUE", 1500);
$items = item_add($items, $i++, "SS1942", array("graph"), "http://www.ixbt.com/video2/images/gf4ti4200-3/sparkle-4200-back.jpg", "GROSSE CARTE GRAPHIQUE", 2000);
$items = item_add($items, $i++, "SS1943", array("graph"), "http://www.ixbt.com/video2/images/gf4ti4200-3/sparkle-4200-back.jpg", "GROSSE CARTE GRAPHIQUE", 2500);
$items = item_add($items, $i++, "SS1944", array("graph"), "http://www.ixbt.com/video2/images/gf4ti4200-3/sparkle-4200-back.jpg", "GROSSE CARTE GRAPHIQUE", 3000);
$items = item_add($items, $i++, "SS1945", array("graph"), "http://www.ixbt.com/video2/images/gf4ti4200-3/sparkle-4200-back.jpg", "GROSSE CARTE GRAPHIQUE", 3500);
$items = item_add($items, $i++, "CARTE MAMAN 0", array("mere"), "http://img.clubic.com/04398038-photo-carte-mere-asus-f1a75-v-pro-2.jpg", "GROSSE MAMAN", 5000);
$items = item_add($items, $i++, "CARTE MAMAN 1", array("mere"), "http://img.clubic.com/04398038-photo-carte-mere-asus-f1a75-v-pro-2.jpg", "GROSSE MAMAN", 5500);
$items = item_add($items, $i++, "CARTE MAMAN 2", array("mere"), "http://img.clubic.com/04398038-photo-carte-mere-asus-f1a75-v-pro-2.jpg", "GROSSE MAMAN", 6000);
$items = item_add($items, $i++, "CARTE MAMAN 3", array("mere"), "http://img.clubic.com/04398038-photo-carte-mere-asus-f1a75-v-pro-2.jpg", "GROSSE MAMAN", 6500);
$items = item_add($items, $i++, "CARTE MAMAN 4", array("mere"), "http://img.clubic.com/04398038-photo-carte-mere-asus-f1a75-v-pro-2.jpg", "GROSSE MAMAN", 7000);
$items = item_add($items, $i++, "CARTE MAMAN 5", array("mere"), "http://img.clubic.com/04398038-photo-carte-mere-asus-f1a75-v-pro-2.jpg", "GROSSE MAMAN", 7500);
$items = item_add($items, $i++, "CARTE MAMAN 6", array("mere"), "http://img.clubic.com/04398038-photo-carte-mere-asus-f1a75-v-pro-2.jpg", "GROSSE MAMAN", 8000);
$items = item_add($items, $i++, "CARTE MAMAN 7", array("mere"), "http://img.clubic.com/04398038-photo-carte-mere-asus-f1a75-v-pro-2.jpg", "GROSSE MAMAN", 8500);
$items = item_add($items, $i++, "CARTE MAMAN 8", array("mere"), "http://img.clubic.com/04398038-photo-carte-mere-asus-f1a75-v-pro-2.jpg", "GROSSE MAMAN", 9000);
*/item_write($items);
?>
<!doctype html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="index.css" media="all">
		<meta charset="utf8">
		<title>
			Boutique en ligne
		</title>
	</head>
	<body>
		<div id="menu">
			<div id="menu_right">
				<?php
				if ($_SESSION["login"] == true)
				{
					?>
					<a href="index.php?p=account">
						<div class="item">
							Mon compte
						</div>
					</a>
					<?php
				}
				else
				{
					?>
					<a href="index.php?p=login">
						<div class="item">
							Connexion
						</div>
					</a>
					<?php
				}
				?>
				<a href="index.php?p=panier">
					<div class="item">
						Panier
					</div>
				</a>
			</div>
			<a href="index.php">
				<div class="item">
					Accueil
				</div>
			</a>
			<a href="index.php?cat=mere">
				<div class="item">
					Carte mere
				</div>
			</a>
			<a href="index.php?cat=proc">
				<div class="item">
					Processeur
				</div>
			</a>
			<a href="index.php?cat=graph">
				<div class="item">
					Carte graphique
				</div>
			</a>
		</div>
		<div id="content">
			<?php
			if (!isset($_GET["p"]))
				$_GET["p"] = "";
			switch($_GET["p"]) {
				case "buy":
					include("page/buy.php");
					break;
				case "panier":
					include("page/panier.php");
					break;
				case "unbuy":
					include("page/unbuy.php");
					break;
				case "admin":
					include("page/admin.php");
					break;
				case "login":
					include("page/login.php");
					break;
				case "account":
					if ($_SESSION["login"] == true)
						include("page/account.php");
					else
						include("page/login.php");
					break;
				default:
					include("page/home.php");
					break;
			}
			?>
		</div>
	</body>
</html>
