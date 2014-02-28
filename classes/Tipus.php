<?php
//CLASSE CAMIÓ

class Tipus {

	//atributs
	private $zona = null;
	private $capacitat = null;
	private $nom = null;

	//constructor
	public function __construct($zona, $capacitat, $nom){
		$this->setZona($zona);
		$this->setCapacitat($capacitat);
		$this->setNom($nom);
	}

	//getters i setters

	public function getZona(){
		return $this->zona;
	}

	public function setZona($zona){
		$this->zona = $zona;
	}

	public function getCapacitat(){
		return $this->capacitat;
	}

	public function setCapacitat($capacitat){
		$this->capacitat = $capacitat;
	}

	public function getNom(){
		return $this->nom;
	}

	public function setNom($nom){
		$this->nom = $nom;
	}

	//mètodes
}

?>