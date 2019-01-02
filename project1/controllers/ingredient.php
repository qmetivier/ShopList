<?php 
	include '../services/function.php';
	include '../services/requeteSql.php';

	$page = file_get_contents("../views/ingredient.html");
	$scripts = "";

	$menu = file_get_contents("../templates/menu.html");
	$page = str_replace("||MENU||", $menu, $page);

	$ingredients = requeteSql::getAllIngredients();
	$scripts .= functions::sendVar('ingredients', $ingredients);

	$page = str_replace("||SCRIPTS||", $scripts, $page);

	echo($page);
 ?>