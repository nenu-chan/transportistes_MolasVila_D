<?php
	$error=false;
	if(isset($_POST["nom_login"]) && isset($_POST["pass_login"])){

		foreach($usuaris AS $usuari=>$especific){
			if(($_POST["nom_login"] === $especific["nom"]) && ($_POST["pass_login"] === $especific["password"])){							
				$_SESSION["nom_usuari"]=$_POST["nom_login"];//guardem el nom d'usuari							
				if($especific["tipus"]=="client"){
					$_SESSION["tipus_usuari"]=1;//guardem el tipus: client
				} elseif($especific["tipus"]=="admin"){
					$_SESSION["tipus_usuari"]=2;//guardem el tipus: administrador
				}
				Header('Location: '.$_SERVER['PHP_SELF']); //recarreguem la pàgina per entrar l'usuari
			} else {
				$error = true; 
			}
		}
	} else {
		echo "S'han d'omplir tots els camps";
	}
	if($error==true){
		echo "Nom d'usuari o contressenya incorrectes";
	}
?>	