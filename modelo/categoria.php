<?php

class Categoria{

	private $id;
	private $nombre;

	function __construct($id, $nombre){	
		$this->id = $id;
		$this->nombre = $nombre;
	}

	public function getId(){
		return $this->id;
	}
	public function getNombre(){
		return $this->nombre;
	}

	public function setNombre($nombre){
		$this->nombre = $nombre;
	}
} 