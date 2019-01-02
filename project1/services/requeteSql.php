<?php
/**
* 
*/
class requeteSQL
{


//Connexion a la bdd
public static function connexionBdd(){
		$serverName = "localhost";
		$connectionInfo = array( "Database" => "MegaCourses", "UID" => "sa", "PWD" => "SQL2014");

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

// Retourne tout les ingredients
public static function getAllIngredients(){
	$bdd =  requeteSQL::connexionBdd();
	$sql = "select ingredient.label as label, categorie_ingredient.label as cat_label from ingredient inner join categorie_ingredient on ingredient.id_categorie_ingredient = categorie_ingredient.identifiant";
	$stmt = sqlsrv_query( $bdd, $sql);
	$response = [];

	while (($temp = sqlsrv_fetch_array($stmt)) != null){
		array_push($response, $temp);
	}
	requeteSQL::closeBdd($bdd);
	return $response;
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