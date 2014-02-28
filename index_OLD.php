<?php
	include("bd/dades.php");
?>
<!--INICI-->
<?php
session_start();

if(!isset($_SESSION["tipus_usuari"])){
	$_SESSION["tipus_usuari"]=0;
}

?>

<html>
<head>
	<script src="js/jquery-1.10.2.min.js" type="text/javascript"></script>
	<script type="text/javascript" src="js/transportistes.js"></script>
	<meta charset="UTF-8"/>
	<title>Transportistes</title>
	<link rel="stylesheet" type="text/css" href="css/estils.css" />
	<link rel="shortcut icon" href="favicon.ico">
</head>
<body>

	<!--MENÚ-->
	<div id="menu">
		<!--Segons el login de l'usuari mostrem les opcions del menú-->
		<form name="main" method="post">
		<?php 
			switch($_SESSION["tipus_usuari"]){
				//usuari sense login
				case 0:
				?>
					<button type="submit" name="inici" value="inici">Inici</button>
				<?php		
				break;
				//usuari client
				case 1:
				?>
					<button type="submit" name="inici" value="inici">Inici</button>		
					<button type="submit" name="encarrec" value="Encarrec">Encarrec</button>
					<button type="submit" name="mostrar_encarrecs" value="mostrar_encarrecs">Mostrar encàrrecs</button>
				<?php
				break;
				//usuari administrador
				case 2:
				?>
					<button type="submit" name="inici" value="inici">Inici</button>		
					<button type="submit" name="assignar_encarrec" value="assignar_encarrec">Assignar encàrrec</button>
					<button type="submit" name="llistar_encarrecs" value="llistar_encarrecs">Llistar encàrrecs</button>
					<button type="submit" name="llistar_transportistes" value="llistar_transportistes">Llistar transportistes</button>
					<button type="submit" name="calcular_sou_transp" value="calcular_sou_transp">Calcular sou transportista</button>
				<?php
				break;
			}
		?>
		</form>
	</div>

	<!--CAPÇALERA/REGISTRE/LOGIN-->
	<div id="capcalera">
		<div id="logo">
			<img src="logo/dropbox.png" width="200" height="200"/>
		</div>
		<div id="titol_empresa">
			<p>DELIVERY<br>EXPRESS</p>
		</div>		
		<div id="login_register">
			<!--Si l'usuari ha fet login mostrem el seu nom i l'opció tancar sessió-->
			<form method="post">
				<p>
				<?php
				if($_SESSION['tipus_usuari']!=0){
					echo $_SESSION['nom_usuari'];
				?>
				</p>
					<button type="submit" name="tancar_sessio" value="tancar_sessio">Tancar sessió</button>	
				<?php
				} else {
				?>
					<button type="submit" name="registre" value="registre">Registre</button>
					<button type="submit" name="pantalla_login" value="Login">Login</button>
				<?php
				}
				?>
			</form>
		</div>
	</div>

	<!--COS D'INFORMACIÓ-->
	<div id="contenidor_general">
		<!--Mirem si ha fet login l'usuari i si existeix quin tipus d'usuari és-->
		<?php
			if((isset($_POST["inici"])) || (!isset($_POST["registre"]) && isset($_POST["login"]) && isset($_POST["encarrec"]) && isset($_POST["assignar_encarrec"]) && isset($_POST["tancar_sessio"]) && isset($_POST["llistar_encarrecs"]) && isset($_POST["llistar_transportistes"]))){
		?>	
			<form id="inici">
				<h1>Inici</h1>
			</form>
		<?php
		}
		?>
		<!--TANCAR SESSIÓ D'USUARI-->
		<?php
			if(isset($_POST["tancar_sessio"])){
				include("sessions/tancar_sessio.php");
			}
		?>

		<!--REGISTRE-->
		<?php
			if(isset($_POST["registre"])){
				include("vistes/registre.html");
			?>

		<!--REGISTRE: VALIDAR DADES-->	
		<?php
			}
			if(isset($_POST["registrarse"])){
				include("control/registre_validar.php");
				if(empty($response)){
					//hauriem de guardar l'usuari
					//$usuaris[$nom]= array("nom"=>$nom, "password"=>$pass, "direccio"=>$dir, "telefon"=>$tel, "tipus"=>"client");
					echo "S'ha registrat correctament";
				} else {
					foreach($response as $r){
						echo "Error: ".$r."<br>";
					}
				}
		?>

		<!--LOGIN-->
		<?php
			}
			if(isset($_POST["pantalla_login"])){
				include("vistes/login.html");
		?>

		<!--LOGIN: VALIDAR-->
		<?php
			}
			if(isset($_POST["loguejar_login"])){
				include("control/login_validar.php");	
		?>
		<!--GENERAR ENCÀRREC-->
		<?php
			}
			if(isset($_POST["encarrec"])){
				include("vistes/generar_encarrec.html");
		?>

		<!--MOSTRAR ENCÀRRECS DEL CLIENT-->
		<?php
			} 
			if(isset($_POST["mostrar_encarrecs"])){
				foreach($encarrecs AS $encarrec => $enc){
					if($enc["client"]==$_SESSION["nom_usuari"]){
		?>
					<form>
						<h1><?php echo "ENCÀRREC: ".$encarrec; ?></h1>
					</form>
		<?php
					}
				}
		?>

		<!--LLISTAR ENCÀRRECS ADMINISTRADOR-->
		<?php
			}
			if(isset($_POST["llistar_encarrecs"])){
				foreach($encarrecs AS $encarrec){
					?>
					<form>
						<h1><?php echo "ENCÀRREC: ".$encarrec["id"]; ?></h1>
					</form>
					<?php
				}
		?>

		<!--LLISTAR TRANSPORTISTES ADMINISTRADOR-->
		<?php
			}
			if(isset($_POST["llistar_transportistes"])){
				foreach($transportistes AS $transportista){
					?>
					<form>
						<h1><?php echo "TRANSPORTISTA: ".$transportista["nom"]; ?></h1>
					</form>
					<?php
				}
		?>

		<!--CALCULAR SOU TRANSPORTISTA-->
		<?php
			} 
			if(isset($_POST["calcular_sou_transp"])){
		?>
		<form id="assignar" name="calcular_sou" method="post">
		<?php
			//	echo "en procés...";

				echo "<span class='black_text'>Selecciona un transportista: </span><select id='select_transportista'> name='transportista'";
				foreach($transportistes AS $transportista){
					$producte=$transportista["producte"];
					echo '<option name="transportista" data-nom="'.$transportista["nom"].'" data-zona="'.$transportista["zona"].'" value="'.$transportista["id"].'"">'.$transportista["id"].'</option>';
				}
				echo "</select><span id='delete_trans' class='delete_button'></span><br>"
		?>
			<div id="fitxa_transportista">
			</div><br>								
			<button type="submit" name="calcular" value="Entrar">Calcular sou</button>
			<button type="submit" name="tornar" value="Tornar">Tornar</button>				
			</form>
		<!--ASSIGNAR ENCÀRREC-->

		<?php
			}
			if(isset($_POST["assignar_encarrec"])){

		?>
				<form id="assignar" name="assignar_encarrec" method="post">
				<?php
				echo "<span class='black_text'>Selecciona un encàrrec: </span><select id='select_encarrec'> name='encarrec'";
				foreach($encarrecs AS $encarrec){
					$producte=$encarrec["producte"];
					echo '<option name="encarrec" data-prod="'.$encarrec["producte"].'" data-pes="'.$encarrec["pes"].'"  data-volum="'.$encarrec["volum"].'" data-direccio="'.$encarrec["direccio"].'" data-poblacio="'.$encarrec["poblacio"].'" data-zona="'.$encarrec["zona"].'" value="'.$encarrec["id"].'"">'.$encarrec["id"].'</option>';
				}
				echo "</select><span id='delete_encarrec' class='delete_button'></span><br>"
				?>
				<div id="fitxa_encarrec">
				</div><br>
				<?php
				echo "<span class='black_text'>Selecciona un transportista: </span><select id='select_transportista'> name='transportista'";
				foreach($transportistes AS $transportista){
					$producte=$transportista["producte"];
					echo '<option name="transportista" data-nom="'.$transportista["nom"].'" data-zona="'.$transportista["zona"].'" value="'.$transportista["id"].'"">'.$transportista["id"].'</option>';
				}
				echo "</select><span id='delete_trans' class='delete_button'></span><br>"
				?>
				<div id="fitxa_transportista">
				</div><br>								
				<button type="submit" name="assignar" value="Entrar">Assignar Encàrrec</button>
				<button type="submit" name="tornar" value="Tornar">Tornar</button>				
				</form>
				<span id="ok">
				</span>
			<?php
			}				
		?>
	</div>


</body>
</html>
