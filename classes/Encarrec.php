<?php
//CLASSE ENCARREC

class Encarrec{

	//atributs
	private $codi = null;
	private $km = null;
	private $pes = null;
	private $direccio = null;

	//constructor
	public function __construct($codi, $km, $pes, $direccio){
		$this->setCodi($codi);
		$this->setKm($km);
		$this->setPes($pes);
		$this->setDireccio($direccio);
	}

	//getters i setters
	public function getCodi(){
		return $this->codi;
	}

	public function setCodi($codi){
		$this->codi = $codi;
	}

	public function getKm(){
		return $this->codi;
	}

	public function setKm($km){
		$this->km = $km;
	}

	public function getPes(){
		return $this->pes;
	}

	public function setPes($pes){
		$this->pes = $pes;
	}

	public function getDireccio(){
		return $this->direccio;
	}

	public function setDireccio($direccio){
		$this->direccio = $direccio;
	}

//mètodes

	public function mostrar_dades(){
		return "Codi: ".$this->codi."<br>".
			   "Km: ".$this->km."<br>".
			   "Pes: ".$this->pes."<br>".
			   "Direccio: ".$this->direccio;
	}

}

?>