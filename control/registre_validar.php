<?php	
	//VALIDACIÓ:
	//trim: elimina els espais en blanc
	//mysql_real_escape_string para evitar las inyeccios sql y htmlentities para xss
	$nom = trim(htmlentities(mysql_real_escape_string($_POST["nom"]))); 
	$pass = trim(htmlentities(mysql_real_escape_string($_POST["password"]))); 
	$dir = trim(htmlentities(mysql_real_escape_string($_POST["direccio"]))); 
	$tel = trim(htmlentities(mysql_real_escape_string($_POST["telefon"]))); 

	$existeix_nom=false;
	$response = array();

	if($nom == "" || $pass== "" || $dir=="" || $tel==""){
		$response[] = "S'han d'omplir tots els camps";
	} else {
		foreach($usuaris AS $usuari){//potser seria millor fer un altre tipus de bucle
			if($nom==$usuari["nom"]){
				$existeix_nom=true;
			}
		}
		if($existeix_nom==true){
			$response[] = "El nom d'usuari introduït ja existeix";
		}
	}

	if(strlen($pass)<5){
		$response[] = "La contrassenya ha de tenir més de 5 caràcters";
	}

?>