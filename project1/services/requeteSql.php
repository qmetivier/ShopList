<?php
/**
* 
*/
class requeteSQL
{


//Connexion a la bdd
public static function connexionBdd(){
		$serverName = "localhost";
		$connectionInfo = array( "Database" => "MegaCourses", "UID" => "sa", "PWD" => "SQL2014", "CharacterSet" => "UTF-8");

		/* Connect using Windows Authentication. */  
		$conn = sqlsrv_connect( $serverName, $connectionInfo);  
		if( $conn === false )  
		{  
     			echo "Unable to connect. ". get_current_user() . "</br>";  
     			die(print_r( sqlsrv_errors(), true));  
		}  
		$bdd = sqlsrv_connect( $serverName, $connectionInfo);
		return $bdd;
}

// Ferme la connrexion a la bdd
public static function closeBdd($bdd){
	sqlsrv_close($bdd);
}

// Permet de connecter le compte renseigner sur le site
public static function connexion($email, $password){
	$bdd =  requeteSQL::connexionBdd();
	$success = false;
	$password = md5($password);
	$sql = "select Id from professionnel where Email = '$email' and mdp = '$password'";
	$stmt = sqlsrv_query( $bdd, $sql);
	$stmt = sqlsrv_fetch_array($stmt);
	if ($stmt != null) {
		$_SESSION["loginId"] = $stmt[0]["Id"];
		$success = true;
	}else{
		$success = false;
	}
	requeteSQL::closeBdd($bdd);
	return $success;
}

// Deconnecte l'utilisateur connecter sur le site
public static function Deconnexion(){
	session_start();
	session_destroy();

}

public static function getAllCatIngredients(){
	$bdd =  requeteSQL::connexionBdd();
	$sql = "select * from categorie_ingredient";
	$stmt = sqlsrv_query( $bdd, $sql);
	$response = [];
	while (($temp = sqlsrv_fetch_array($stmt)) != null){
		array_push($response, $temp);
	}
	requeteSQL::closeBdd($bdd);
	return $response;
}

public static function getIdCatIngredient($name){
	$bdd =  requeteSQL::connexionBdd();
	$sql = "select identifiant from categorie_ingredient where label = '$name'";
	$stmt = sqlsrv_query( $bdd, $sql);
	$response = null;
	if (($temp = sqlsrv_fetch_array($stmt)) != null) {
		$response = $temp["identifiant"];
	}
	requeteSQL::closeBdd($bdd);
	return $response;
}

public static function addCatIngredient($name){
	$bdd =  requeteSQL::connexionBdd();
	$sql = "insert into categorie_ingredient(label) values('$name')";
	$stmt = sqlsrv_query( $bdd, $sql);
	$stmt = sqlsrv_fetch_array($stmt);
	$success = false;
	if ($stmt != null) $success = true;
	return $success;
}

// Retourne tout les ingredients
public static function getAllIngredients(){
	$bdd =  requeteSQL::connexionBdd();
	$sql = "select ingredient.identifiant, ingredient.label as label, categorie_ingredient.label as cat_label from ingredient inner join categorie_ingredient on ingredient.id_categorie_ingredient = categorie_ingredient.identifiant";
	$stmt = sqlsrv_query( $bdd, $sql);
	$response = [];

	while (($temp = sqlsrv_fetch_array($stmt)) != null){
		array_push($response, $temp);
	}
	requeteSQL::closeBdd($bdd);
	return $response;
}

public static function addIngredient($name, $name_cat){
	$bdd =  requeteSQL::connexionBdd();
	$idCat = requeteSQL::getIdCatIngredient($name_cat);
	$sql = "insert into ingredient(label, id_categorie_ingredient, hebdomadaire) values('$name', '$idCat', 0)";
	echo($sql);
	$stmt = sqlsrv_query( $bdd, $sql);
	$stmt = sqlsrv_fetch_array($stmt);
	$success = false;
	if ($stmt != null) $success = true;
	return $success;
}

public static function delIngredient($id){
	$bdd =  requeteSQL::connexionBdd();
	$idCat = requeteSQL::getIdCatIngredient($name_cat);
	$sql = "delete ingredient where identifiant = $id";
	$stmt = sqlsrv_query( $bdd, $sql);
	$stmt = sqlsrv_fetch_array($stmt);
	$success = false;
	if ($stmt != null) $success = true;
	return $success;
}

// Retourne tout les ingredients
public static function getAllRecettes(){
	$bdd =  requeteSQL::connexionBdd();
	$sql = "select recette.label as label, categorie_recette.label as cat_label from recette inner join categorie_recette on recette.id_categorie_recette = categorie_recette.identifiant";
	$stmt = sqlsrv_query( $bdd, $sql);
	$response = [];

	while (($temp = sqlsrv_fetch_array($stmt)) != null){
		array_push($response, $temp);
	}
	requeteSQL::closeBdd($bdd);
	return $response;
}

}

?>