<?php
	include "/FirePHPCore/fb.php";

$zones = array(
			"zona1"=>array(
						"km"=>150,
						"zona"=>"Barcelona"
					),
			"zona1"=>array(
						"km"=>2400,
						"zona"=>"Catalunya"
					),
			"zona1"=>array(
						"km"=>3120,
						"zona"=>"Espanya"
					)
			);

if(!isset($_POST["començar"]) || (isset($_POST["tornar"]))){
?>
<html>
<head>
	<meta charset="UTF-8"/>
	<title></title>
</head>
<body>


	<form name="main" method="post">
		<input type="radio" name="menu" value="registre">Registre</input><br>
		<input type="radio" name="menu" value="login">Login</input><br>
		<input type="radio" name="menu" value="encarrec">Encarrec</input><br>
		<input type="radio" name="menu" value="assignar_encarrec">Assignar encàrrec</input><br>
		<input type="submit" name="començar" value="Enviar"/>
	</form>


	<?php
	}
	else
	{
		if($_POST["menu"]=="registre"){
		?>
			<form name="registre" method="post">
			<input type="text" name="nom" placeholder="nom"/><br>
			<input type="password" name="password" placeholder="contrassenya"/><br>
			<input type="text" name="direccio" placeholder="direccio" /><br>
			<input type="text" name="telefon" placeholder="telefon" /><br>
			<input type="submit" name="registrarse" value="Enviar"/>
			<input type="submit" name="tornar" value="Tornar"/>				
			</form>
		<?php
		}
		if($_POST["menu"]=="login"){
		?>
			<form name="login" method="post">
			<input type="text" name="nom" placeholder="nom"/><br>
			<input type="password" name="password" placeholder="contrassenya"/><br>
			<input type="submit" name="loguejar" value="Entrar"/>
			<input type="submit" name="tornar" value="Tornar"/>			
			</form>
		<?php
		}
		if($_POST["menu"]=="encarrec"){
		?>
			<form name="encarrec" method="post">
			<input type="text" name="producte" placeholder="producte"/><br>
			<input type="text" name="pes" placeholder="pes"/><br>
			<input type="text" name="volum" placeholder="volum"/><br>
			<input type="text" name="direccio" placeholder="direccio"/><br>			
			<input type="text" name="poblacio" placeholder="poblacio"/><br>									
			<input type="submit" name="fer_encarrec" value="Entrar"/>
			<input type="submit" name="tornar" value="Tornar"/>				
			<!--que el client pugui saber l'estat de l'encarrec-->
			</form>
		<?php
		}
		if($_POST["menu"]=="assignar_encarrec"){
		?>
			<form name="assignar_encarrec" method="post">
			<select>
			  <option name="encarrec" value="e1">Encarrec 1</option>
			  <option name="encarrec" value="e2">Encarrec 2</option>
			  <option name="encarrec" value="e3">Encarrec 3</option>
			  <option name="encarrec" value="e4">Encarrec 4</option>
			</select><br>
			<select>
			  <option name="transportista" value="t1">Transportista 1</option>
			  <option name="transportista" value="t2">Transportista 2</option>
			  <option name="transportista" value="t3">Transportista 3</option>
			  <option name="transportista" value="t4">Transportista 4</option>
			</select><br>
			<input type="submit" name="assignar" value="Entrar"/>
			<input type="submit" name="tornar" value="Tornar"/>				
			</form>
		<?php
			}
		}					
	?>

</body>
</html>