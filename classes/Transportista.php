<?php
//CLASSE TRANSPORTISTA

include "AssignacioEncarrecTransportista.php";
//include "Vehicle.php";

class Transportista{
	
	//atributs
	private $codi = null;
	private $nom = null;
	private $limitDiari = null; //podria ser una constant
	private $vehicle = null;
	private $llistaAssignacions = null;//provisional --> bbdd

	//constructor
	public function __construct($codi, $nom, $limitDiari, $vehicle){
		$this->setCodi($codi);
		$this->setNom($nom);
		$this->setlimitDiari($limitDiari);
		$this->setVehicle($vehicle);
		$this->llistaAssignacions=array();
	}

	//getters i setters
	public function getCodi(){
		return $this->codi;
	}

	public function setCodi($codi){
		$this->codi = $codi;
	}
	public function getNom(){
		return $this->nom;
	}

	public function setNom($nom){
		$this->nom = $nom;
	}
	public function getlimitDiari(){
		return $this->limitDiari;
	}

	public function setlimitDiari($limitDiari){
		$this->limitDiari = $limitDiari;
	}
	public function getVehicle(){
		return $this->vehicle;
	}

	public function setVehicle($vehicle){
		$this->vehicle = $vehicle;
	}

	public function getllistaAssignacions(){
		return $this->llistaAssignacions;
	}

	//mètodes
	//afegir assignació al transportista, creem l'assignació
	public function afegirAssignacio($encarrec, $dia){
		$assignacio = new AssignacioEncarrecTransportista($encarrec, $this, $dia);
		array_push($this->llistaAssignacions, $assignacio);
	} 

	//eliminar assignació del transportista
	public function eliminarAssignacio($assignacio){
		array_pop($this->llistaAssignacions, $assignacio);
	}

	//llistar assignacions del transportista
	public function llistarAssignacions(){
		$llistat_resultat;
		$i = 0;
		foreach ( $this->llistaAssignacions AS $assignacio ){
			$llistat_resultat[$i] = $assignacio->dades();
			$i++;
		}
		return $llistat_resultat;
	}

	//mètode per calcular els km diaris que fa el transportista
	public function calcularKmDiaris($dia){
		for($i=0; $i<count($this->llistaAssignacions); $i++){
			if($dia == $this->llistaAssignacions[$i]->getDia()){
				$km = $this->llistaAssignacions[$i]->getkmRecorrer() + $km;
			}
		}
		return $km;		
	}

	//mètode per calcular els km diaris recorreguts que falten respecte el límit
	public function kmRespecteLimit($dia){
		$resultat = $this->limitDiari - calcularKmDiaris($dia);
		return $resultat;
	}

	//mètode per comprovar si al afegir assignació es supera el límit diari
	public function comprovarLimit($dia, $kmAssignacio){
		$passaLimit = false;
		if($kmAssignacio > $this->kmRespecteLimit()){
			$passaLimit = true;
		}
		return $passaLimit;
	}

	//mètode que assigna un vehicle al transportista
	public function assignarVehicle($vehicle){
		$this->vehicle = setVehicle($vehicle);
	}

	//mètode per calcular la despesa diaria del transportista
	public function calcularDespesaDiaria($dia){
		$despesaDiaria = 0;
		for($i=0; $i<count($this->llistaAssignacions); $i++){
			if($dia == $this->llistaAssignacions[$i]->getDia()){
				$despesaDiaria = $this->llistaAssignacions[$i]->calcular_despesa_encarrec() + $despesaDiaria;
			}
		}
		//calcular si hi ha dieta: > 650km || > 2639€
		if($despesaDiaria > 2639 ){
			$despesaDiaria = $despesaDiaria + 15;
		}
		return $despesaDiaria;		
	}

	//mostrar dades
	public function mostrarDades( $id ){
		if ( $id == $this->codi ){
			$dades_transportista = "Nom: ".$this->nom.".<br>".
							   "Vehicle: ".$this->vehicle;
			return $dades_transportista;
		}
	}

	public function dades(){
		return "Codi: ".$this->getCodi()."<br>".
			   "Nom: ".$this->getNom()."<br>".
			   "Limit diari: ".$this->getlimitDiari()."<br>".
			   "Vehicle: ".$this->getVehicle();
	}
}

?>