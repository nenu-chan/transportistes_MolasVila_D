<?php
//CLASSE ASSIGNACIÓ ENCÀRREC TRANSPORTISTA
class AssignacioEncarrecTransportista{

	//atributs
	private $encarrec = null;
	private $transportista = null;
	private $dia = null;
	private $kmRecorrer = null;
	private $despesa = null;

	//constructor
	public function __construct($encarrec, $transportista, $dia){
		$this->setEncarrec($encarrec);
		$this->setTransportista($transportista);
		$this->setDia($dia);
	}

	//getters i setters
	public function getEncarrec(){
		return $this->encarrec;
	}

	public function setEncarrec($encarrec){
		$this->encarrec = $encarrec;
	}

	public function getTransportista(){
		return $this->transportista;
	}

	public function setTransportista($transportista){
		$this->transportista = $transportista;
	}

	public function getDia(){
		return $this->dia;
	}

	public function setDia($dia){
		$this->dia = $dia;
	}

	public function getKmRecorrer(){
		return $this->kmRecorrer;
	}

	public function getDespesa(){
		return $this->despesa;
	}

	//mètodes
	//calcular els km a recòrrer de l'encàrrec
	public function calcular_km_encarrec(){
		$res = 0;
		$res = $this->encarrec->getKm() * 2;
		return $res;
	}
	//calcular la despesa que suposa l'encàrrec
	public function calcular_despesa_encarrec(){
		$kilometres = $this->encarrec->getKm() * 2;
		$resultat = $kilometres * 4.06;
		return $resultat;
	}

	public function dades(){
		return "Encàrrec: ".$this->getEncarrec()->getCodi()."<br>".
		   "Transportista: ".$this->getTransportista()->getNom()."<br>".
		   "Dia: ".$this->getDia()."<br>".
		   "Km a recòrrer: ".$this->getKmRecorrer()."<br>".
		   "Despesa: ".$this->getDespesa();
	}
}

?>