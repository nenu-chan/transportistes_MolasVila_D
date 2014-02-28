<?php
	include("bd/dades.php");
?>
<!--INICI-->
<?php
include "classes/Empresa.php";
session_start();
$empresa = new Empresa(01,"Empresa guai");
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


				$encarrec = new Encarrec(100,200,50,"Carrer de l'espardenya");
				$encarrec2 = new Encarrec(100,200,50,"Carrer de l'espardenya");
				$empresa->populateEncarrecs($encarrecs);
				$empresa->altaEncarrec($encarrec->getCodi(),$encarrec->getKm(),$encarrec->getPes(),$encarrec->getDireccio());
				$empresa->altaEncarrec($encarrec2->getCodi(),$encarrec2->getKm(),$encarrec2->getPes(),$encarrec2->getDireccio());				
				?>
				<form>
					<h1><?php echo $empresa->llistarEncarrecs(); ?></h1>
				</form>
		

		<!--LLISTAR TRANSPORTISTES ADMINISTRADOR-->
		<?php
			}			
			if(isset($_POST["llistar_transportistes"])){


				$transportista = new Transportista(01,"Nami",400,"camió");
				$transportista2 = new Transportista(02,"Pavon",400,"Noob");
				$empresa->altaTransportista($transportista->getCodi(),$transportista->getNom(),$transportista->getLimitDiari(),$transportista->getVehicle());
				$empresa->altaTransportista($transportista2->getCodi(),$transportista2->getNom(),$transportista2->getLimitDiari(),$transportista2->getVehicle());				
				?>
				<form>
					<h1><?php echo $empresa->llistarTransportistes(); ?></h1>
				</form>
				<?php
				/*foreach($transportistes AS $transportista){*/
					?>

		<!--CALCULAR SOU TRANSPORTISTA-->
		<?php
			} 
			if(isset($_POST["calcular_sou_transp"]) || isset($_POST["calcular"])){

			/*	$transportista = new Transportista(01,"Nami",400,"camió");
				$transportista2 = new Transportista(02,"Pavon",400,"Noob");
				$encarrec = new Encarrec(100,200,50,"Carrer de l'espardenya");			
				$encarrec1 = new Encarrec(250,500,150,"Street de l'ametlla");						
				$empresa->altaTransportista($transportista->getCodi(),$transportista->getNom(),$transportista->getLimitDiari(),$transportista->getVehicle());
				$empresa->altaTransportista($transportista2->getCodi(),$transportista2->getNom(),$transportista2->getLimitDiari(),$transportista2->getVehicle());				
				$transportista->afegirAssignacio($encarrec,19);
				$transportista2->afegirAssignacio($encarrec1,20);
				echo "Trans 1:" . $transportista->calcularDespesaDiaria(19)."<br>";
				echo "Trans 2: " . $transportista2->calcularDespesaDiaria(20)."<br>";
				echo "<form>
						<select>";
				foreach ($empresa->getLlistaTransportistes() AS $trans){
					echo "<option value=".$trans->getNom().">".$trans->getNom()."</option>";
				}
				echo	"</select>				
					 </form>";*/

		?>
		<form id="assignar" name="calcular_sou" method="post">
		<?php
			//	echo "en procés...";



				$transportista = new Transportista(01,"Nami",400,"camió");
				$transportista2 = new Transportista(02,"Pavon",400,"Noob");
				$encarrec = new Encarrec(100,200,50,"Carrer de l'espardenya");			
				$encarrec1 = new Encarrec(250,500,150,"Street de l'ametlla");		
				$empresa->altaEncarrec($encarrec->getCodi(),$encarrec->getKm(),$encarrec->getPes(),$encarrec->getDireccio());
				$empresa->altaEncarrec($encarrec1->getCodi(),$encarrec1->getKm(),$encarrec1->getPes(),$encarrec1->getDireccio());								
				$empresa->altaTransportista($transportista->getCodi(),$transportista->getNom(),$transportista->getLimitDiari(),$transportista->getVehicle());
				$empresa->altaTransportista($transportista2->getCodi(),$transportista2->getNom(),$transportista2->getLimitDiari(),$transportista2->getVehicle());				
				$transportista->afegirAssignacio($encarrec,19);
				$transportista2->afegirAssignacio($encarrec1,20);
			//	echo "Trans 1:" . $transportista->calcularDespesaDiaria(19)."<br>";
			//	echo "Trans 2: " . $transportista2->calcularDespesaDiaria(20)."<br>";
				foreach ($transportista->getLlistaAssignacions() AS $assign){
				//	echo $assign->getDia();
				}
				echo "<span class='black_text'>Selecciona un transportista: </span><select id='select_transportista'> name='transportista'";				
				foreach ($empresa->getLlistaTransportistes() AS $trans){
				//	$trans->afegirAssignacio($encarrec,20);					
					echo "<option data-despesa=".$trans->calcularDespesaDiaria(20)." data-vehicle=".$trans->getVehicle()." data-nom=".$trans->getNom()." data-codi=".$trans->getCodi().">".$trans->getNom()."</option>";
				}
				echo "</select>";
			/*	echo "<span class='black_text'>Selecciona un transportista: </span><select id='select_transportista'> name='transportista'";
				foreach($transportistes AS $transportista){
					$producte=$transportista["producte"];
					echo '<option name="transportista" data-nom="'.$transportista["nom"].'" data-zona="'.$transportista["zona"].'" value="'.$transportista["id"].'"">'.$transportista["id"].'</option>';
				}
				echo "</select><span id='delete_trans' class='delete_button'></span><br>"*/
		?>
			<div id="fitxa_transportista">
			</div><br>								
			<button type="submit" name="calcular" value="Entrar">Calcular sou</button>
			<button type="submit" name="tornar" value="Tornar">Tornar</button>
			</form>
		<!--ASSIGNAR ENCÀRREC-->

		<?php
			}
			if(isset($_POST["assignar_encarrec"]) || isset($_POST["assignar"])){
				


				$transportista = new Transportista(01,"Nami",400,"camió");
				$transportista2 = new Transportista(02,"Pavon",400,"Noob");
				$encarrec = new Encarrec(100,200,50,"Carrer de l'espardenya");			
				$encarrec1 = new Encarrec(250,500,150,"Street de l'ametlla");
				$empresa->altaEncarrec($encarrec->getCodi(),$encarrec->getKm(),$encarrec->getPes(),$encarrec->getDireccio());
				$empresa->altaEncarrec($encarrec1->getCodi(),$encarrec1->getKm(),$encarrec1->getPes(),$encarrec1->getDireccio());						
				$empresa->altaTransportista($transportista->getCodi(),$transportista->getNom(),$transportista->getLimitDiari(),$transportista->getVehicle());
				$empresa->altaTransportista($transportista2->getCodi(),$transportista2->getNom(),$transportista2->getLimitDiari(),$transportista2->getVehicle());				
				$transportista->afegirAssignacio($encarrec,19);
				$transportista2->afegirAssignacio($encarrec1,20);



				/*$transportista = new Transportista(01,"Nami",400,"camió");
				$encarrec = new Encarrec(100,200,50,"Carrer de l'espardenya");
				$transportista->afegirAssignacio($encarrec,19);
				$transportista->afegirAssignacio($encarrec,20);
				$empresa->altaTransportista($transportista->getCodi(),$transportista->getNom(),$transportista->getLimitDiari(),$transportista->getVehicle());

				echo "<br>".$transportista->mostrarDades(01)."<br><br><br>";
				foreach ($transportista->llistarAssignacions() AS $transportiste){
					echo $transportiste."<br><br>";
				}*/


		?>
				<form id="assignar" action="index.php" name="assignar_encarrec" method="post">
				<?php

				if(isset($_POST["assignar"])){
					if(isset($_POST["enc"]) && isset($_POST["transportista"])){
						echo "L'encàrrec amb el CODI: ".$_POST['enc']." i el TRANSPORTISTA: ".$_POST['transportista']." ha estat assignat correctament.<br>";
					}
					else
					{
						echo "NOPE<br>";
					}
				}

				echo "<span class='black_text'>Selecciona un encàrrec: </span><select id='select_encarrec' name='enc'>";				
				foreach ($empresa->getllistaEncarrecs() AS $enc){			
					echo "<option data-codi=".$enc->getCodi()." data-km=".$enc->getKm()." data-pes=".$enc->getPes()." data-direccio=".$enc->getDireccio()." value=".$enc->getCodi().">".$enc->getCodi()."</option>";
					echo $enc->getKm();
				}
				echo "</select><span id='delete_encarrec' class='delete_button'></span><br>";
				/*
				echo "<span class='black_text'>Selecciona un encàrrec: </span><select id='select_encarrec'> name='encarrec'";
				foreach($encarrecs AS $encarrec){
					$producte=$encarrec["producte"];
					echo '<option name="encarrec" data-prod="'.$encarrec["producte"].'" data-pes="'.$encarrec["pes"].'"  data-volum="'.$encarrec["volum"].'" data-direccio="'.$encarrec["direccio"].'" data-poblacio="'.$encarrec["poblacio"].'" data-zona="'.$encarrec["zona"].'" value="'.$encarrec["id"].'"">'.$encarrec["id"].'</option>';
				}
				echo "</select><span id='delete_encarrec' class='delete_button'></span><br>"
				*/
				?>
				<div id="fitxa_encarrec">
				</div><br>
				<?php

				
			//	echo "Trans 1:" . $transportista->calcularDespesaDiaria(19)."<br>";
			//	echo "Trans 2: " . $transportista2->calcularDespesaDiaria(20)."<br>";
				foreach ($transportista->getLlistaAssignacions() AS $assign){
				//	echo $assign->getDia();
				}
				echo "<span class='black_text'>Selecciona un transportista: </span><select id='select_transportista' name='transportista'>";				
				foreach ($empresa->getLlistaTransportistes() AS $trans){
				//	$trans->afegirAssignacio($encarrec,20);					
					echo "<option data-despesa=".$trans->calcularDespesaDiaria(20)." data-vehicle=".$trans->getVehicle()." data-nom=".$trans->getNom()." data-codi=".$trans->getCodi()." value=".$trans->getCodi().">".$trans->getNom()."</option>";
				}
				echo "</select><span id='delete_trans' class='delete_button'></span><br>";

				/*echo "<span class='black_text'>Selecciona un transportista: </span><select id='select_transportista'> name='transportista'";
				foreach($transportistes AS $transportista){
					$producte=$transportista["producte"];
					echo '<option name="transportista" data-nom="'.$transportista["nom"].'" data-zona="'.$transportista["zona"].'" value="'.$transportista["id"].'"">'.$transportista["id"].'</option>';
				}
				echo "</select><span id='delete_trans' class='delete_button'></span><br>"*/

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
