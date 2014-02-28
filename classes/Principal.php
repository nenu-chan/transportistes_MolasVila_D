<?php
//MAIN
include "Empresa.php";

$empresa = new Empresa(01,"Empresa guai");
$transportista = new Transportista(01,"Nami",400,"camió");
$encarrec = new Encarrec(100,200,50,"Carrer de l'espardenya");
echo $empresa->getNom();
$transportista->afegirAssignacio($encarrec,"20/2/2014");
$transportista->afegirAssignacio($encarrec,"19/2/2014");

$empresa->altaTransportista($transportista->getCodi(),$transportista->getNom(),$transportista->getLimitDiari(),$transportista->getVehicle());
//$empresa->altaTransportista(02,"Apo",400,"camió");
$empresa->llistarTransportistes();
echo "<br>".$transportista->mostrarDades(01)."<br><br><br>";
foreach ($transportista->llistarAssignacions() AS $transportiste){
	echo $transportiste."<br><br>";
}
?>