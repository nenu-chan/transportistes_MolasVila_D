<?php
	include "/FirePHPCore/fb.php";

//DADES:
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
//PLACEHOLDERS!!!
$clients = array(
			"paquita"=>array(
						"nom"=>"Pakita",
						"password"=>"pakitareshulona",
						"direccio"=>"calle pascual",
						"telefon"=>038752304875
						),
			"ramon"=>array(
						"nom"=>"Ramon",
						"password"=>"ramonalforn",
						"direccio"=>"carrer misèria",
						"telefon"=>3547648466754
						),
			"nenu"=>array(
						"nom"=>"Nami",
						"password"=>"socunanoob",
						"direccio"=>"calle fiambre",
						"telefon"=>5868687767575
						),									
		);
$encarrecs = array(
			"encarrec1"=>array(
						"id"=>"00Z",
						"producte"=>"Sofá",
						"pes"=>150.40,
						"volum"=>2.3,
						"direccio"=>"calle pascual",
						"poblacio"=>"granollers"						
						),
			"encarrec2"=>array(
						"id"=>"00X",
						"producte"=>"Televisió",
						"pes"=>37.490,
						"volum"=>0.7,
						"direccio"=>"carrer miracle",
						"poblacio"=>"la garriga"						
						),
			"encarrec3"=>array(
						"id"=>"00Y",
						"producte"=>"Nevera",
						"pes"=>127.88,
						"volum"=>1.7,
						"direccio"=>"carrer gibraltar",
						"poblacio"=>"parets del vallès"						
						),									
		);


?>

<html>
<head>
	<script src="js/jquery-1.10.2.min.js" type="text/javascript"></script>	
	<meta charset="UTF-8"/>
	<title>Transportistes</title>
	<link rel="stylesheet" type="text/css" href="css/estils_prova.css" />
</head>
<body>
	<!--Capçalera-->
	<div id="capçalera">
		<div id="logo">
		</div>
		
	<!--Login-->
		<div id="login">
			<form name="menu" method="post">	
				<button type="submit" name="registre" value="registre">Registre</button>
				<button type="submit" name="login" value="Login">Login</button>
			</form>
		</div>
	</div>
	
	<!--Menú-->
	<div id="cos">
		<div id="menu">
			<form name="menu" method="post">
				<button type="submit" name="inici" value="inici">Inici</button><br>
				<button type="submit" name="encarrec" value="Encarrec">Encarrec</button><br>
				<button type="submit" name="assignar_encarrec" value="assignar_encarrec">Assignar encàrrec</button><br>					
			</form>
		</div>
		<div id="info">
		</div>
	</div>
	<div id="contenidor_general">
		<?php
			if((isset($_POST["inici"])) || (!isset($_POST["registre"]) && isset($_POST["login"]) && isset($_POST["encarrec"]) && isset($_POST["assignar_encarrec"]))){
		?>	
			<div>
				<h1>INICI</h1>
			</div>
		<?php
		}
		?>
		<?php
			if(isset($_POST["registre"])){
			?>
				<form name="registre" method="post">
				<input type="text" name="nom" placeholder="nom"/><br>
				<input type="password" name="password" placeholder="contrassenya"/><br>
				<input type="text" name="direccio" placeholder="direccio" /><br>
				<input type="text" name="telefon" placeholder="telefon" /><br>
				<button type="submit" name="registrarse" value="Enviar">Enviar</button>
				<button type="submit" name="tornar" value="Tornar">Tornar</button>				
				</form>
			<?php
			}
			if(isset($_POST["login"])){
			?>
				<form id="signup" name="login" method="post">
				<input type="text" name="nom" placeholder="nom"/><br>
				<input type="password" name="password" placeholder="contrassenya"/><br>
				<button type="submit" name="loguejar" value="Entrar">Entrar</button>
				<button type="submit" name="tornar" value="Tornar">Tornar</button>		
				</form>
			<?php
			}
			if(isset($_POST["encarrec"])){
			?>
				<form id="signup" name="encarrec" method="post">
				<input type="text" name="producte" placeholder="producte"/><br>
				<input type="text" name="pes" placeholder="pes"/><br>
				<input type="text" name="volum" placeholder="volum"/><br>
				<input type="text" name="direccio" placeholder="direccio"/><br>			
				<input type="text" name="poblacio" placeholder="poblacio"/><br>									
				<button type="submit" name="fer_encarrec" value="Entrar">Entrar</button>
				<button type="submit" name="tornar" value="Tornar">Tornar</button>
				<!--que el client pugui saber l'estat de l'encarrec-->
				</form>
			<?php
			}
			if(isset($_POST["assignar_encarrec"])){
			?>
				<form name="assignar_encarrec" method="post">
				<?php
				echo "<select class='select'>";
				foreach($encarrecs AS $encarrec){
					FB::send($encarrec["id"]);
					$producte=$encarrec["producte"];
					echo '<option name="encarrec" value="'.$encarrec["id"].'"">'.$encarrec["id"].'</option>';
				}
				echo "</select><br>"
				?>
				<div id="fitxa_encarrec">
				  <?php echo "<h1>".$producte."</h1><br>
				  <h1>Aquí hi va el contingut de l'encarrec</h1>" ?>
				</div><br>			
				<select>
				  <option name="transportista" value="t1">Transportista 1</option>
				  <option name="transportista" value="t2">Transportista 2</option>
				  <option name="transportista" value="t3">Transportista 3</option>
				  <option name="transportista" value="t4">Transportista 4</option>
				</select><br>
				<button type="submit" name="assignar" value="Entrar">Entrar</button>
				<button type="submit" name="tornar" value="Tornar">Tornar</button>				
				</form>
			<?php
			}				
		?>
	</div>
	<script type="text/javascript">
	    $(document).ready(function() {
	        $( ".select" ).change(function() {
	        	alert("HAHA");
				$('#fitxa_encarrec').show();
	       	});
	    });
	</script>
</body>
</html>
