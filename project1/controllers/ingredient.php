<?php 
	include '../services/function.php';
	include '../services/requeteSql.php';

	if (isset($_POST["name"])) {
		$cat = requeteSql::getAllCatIngredients();
		$isexist = false;
		foreach ($cat as $key => $value) {
			if ($value["label"] == $_POST["cat_ingredient"]) $isexist = true;
		}
		if(!$isexist) requeteSql::addCatIngredient($_POST["cat_ingredient"]);
		requeteSql::getIdCatIngredient($_POST["cat_ingredient"]);
		requeteSql::addIngredient($_POST["name"], $_POST["cat_ingredient"]);
		unset($_POST);
    	header("Location: ".$_SERVER['PHP_SELF']);
	}

	if (isset($_POST["id"])) {
		requeteSql::delIngredient($_POST["id"]);
		unset($_POST);
    	header("Location: ".$_SERVER['PHP_SELF']);
	}

	$page = file_get_contents("../views/ingredient.html");
	$scripts = "";

	$menu = file_get_contents("../templates/menu.html");
	$page = str_replace("||MENU||", $menu, $page);

	$cat = requeteSql::getAllCatIngredients();
	$cat = functions::decodeUtf8($cat);
	$scripts .= functions::sendVar('cat_ingredient', $cat);

	$ingredients = requeteSql::getAllIngredients();
	$scripts .= functions::sendVar('ingredients', $ingredients);

	$page = str_replace("||SCRIPTS||", $scripts, $page);

	echo($page);
 ?>