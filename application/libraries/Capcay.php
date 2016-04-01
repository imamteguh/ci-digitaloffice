<?php
session_start();
class Capcay {
	
	private $bil1;
 
	private $bil2;
	 
	private $operator;
	 
	function initial() {
		$listoperator = array('+', '-', 'x');
		 
		$this->bil1 = rand(1, 99);
		 
		$this->bil2 = rand(1, 9);
		 
		$this->operator = $listoperator[rand(0, 2)];
	}
	
	function generatekode() {
	 
		$this->initial();
		if ($this->operator == '+'):
			$hasil = $this->bil1 + $this->bil2;
		elseif ($this->operator == '-'):
			$hasil = $this->bil1 - $this->bil2;
		elseif ($this->operator == 'x'):
			$hasil = $this->bil1 * $this->bil2;
		endif;
		$_SESSION['kode'] = $hasil;
	}
	
	function showcaptcha() {
	 
		echo "Berapa hasil dari <b>".$this->bil1."</b> ".$this->operator." <b>".$this->bil2."</b> = ". '';
	 	//echo $_SESSION['kode'];
	}
	
	function resultcaptcha() {
	 
		return $_SESSION['kode'];
	 
	}
}
?>