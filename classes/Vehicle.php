<?php
//CLASSE VEHICLE

class Vehicle{

	//atributs
	private $codi = null;
	private $tipus = null;

	//constructor
	public function __construct($codi, $tipus){
		$this->setCodi($codi);
		$this->setTipus($tipus);
	}

	//getters i setters
	public function getCodi(){
		return $this->codi;
	}

	public function setCodi($codi){
		$this->codi = $codi;
	}

	public function getTipus(){
		return $this->tipus;
	}

	public function setCodi($tipus){
		$this->tipus = $tipus;
	}

	//mètodes
}


?>