<?php 
//CLASSE EMPRESA
include "Tipus.php";
include "Transportista.php";
include "Encarrec.php";


class Empresa{

	//atributs
	private $codi = null;
	private $nom = null;
	private $llistaEncarrecs = null;//provisional --> bbdd
	private $llistaTransportistes = null;//provisional --> bbdd
	private $llistaVehicles = null;//provisional --> bbdd
	//constants
	const preuKm = 4.06;
	/*const camio = new Tipus(3,24,"camió");
	const furgoneta = new Tipus(2,15,"furgoneta");
	const moto = new Tipus(1,0.5,"moto");*/

	//constructor
	public function __construct($codi, $nom){
		$this->setCodi($codi);
		$this->setNom($nom);
		$this->llistaEncarrecs=array();
		$this->llistaTransportistes=array();
		$this->llistaVehicles=array();
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

	public function getllistaTransportistes(){
		return $this->llistaTransportistes;
	}

	public function getllistaEncarrecs(){
		return $this->llistaEncarrecs;
	}	
	//mètodes
	//llistar assignacions

	//populate encarrecs:
	public function populateEncarrecs($encarrecs){
		foreach ( $encarrecs AS $encarrec ){
			$this->altaEncarrec($encarrec["id"],$encarrec["km"],$encarrec["pes"],$encarrec["direccio"]);
		}
	}

	//llistar encarrecs per assignar
	public function llistarEncarrecs(){
		$llistat_enc = "";
		for($i=0; $i<count($this->llistaEncarrecs); $i++){
			$llistat_enc .= $this->llistaEncarrecs[$i]->mostrar_dades()."<br>";
		}
		return $llistat_enc;
	}
	//llistar transportistes
	public function llistarTransportistes(){
		$llistat_trans = "";
		for($i=0; $i<count($this->llistaTransportistes); $i++){
			$llistat_trans .= $this->llistaTransportistes[$i]->dades()."<br>";
		}
		return $llistat_trans;
	}

	//llistar vehicles
	//alta encàrrec
	public function altaEncarrec($codi, $km, $pes, $direccio){
		$encarrec = new Encarrec($codi, $km, $pes, $direccio);
		array_push($this->llistaEncarrecs, $encarrec);
	}	
	//baixa encàrrec
	//alta vehicle
	//baixa vehicle
	//alta transportista
	public function altaTransportista($codi, $nom, $limitDiari, $vehicle){
		$transportista = new Transportista($codi, $nom, $limitDiari, $vehicle);
		array_push($this->llistaTransportistes, $transportista);
	}
	
	//baixa transportisa
	//llistar transportistes vàlids per a assignar encàrrec (segons tipus de vehicle i km a recórrer)
	public function llistar_transp_valids($encarrec){
		$llistat_transp_valids = array();
		for($i=0; $i<count($this->llistaTransportistes); $i++){
			if(($encarrec->getPes() <= $this->llistaTransportistes[$i]->getVehicle()->getTipus()->getCapacitat()) && ($encarrec->getKm() <= $this->llistaTransportistes[$i]->kmRespecteLimit())){
				$llistat_transp_valids[$i] = $this->llistaTransportistes[$i]->getNom();
			}
		}
		return $llistat_transp_valids;
	}
}


?>