<?php

class Post{

	private $id;
	private $titulo;
	private $fecha;
	private $autor;
	private $contenido;
	private $categoria;

	function __construct($id, $titulo, $fecha, $autor, $contenido, $categoria){
		$this->id = $id;
		$this->titulo = $titulo;
		$this->fecha = $fecha;
		$this->autor = $autor;
		$this->contenido = $contenido;
		$this->categoria = $categoria;
	}

	public function getId(){
		return $this->id;
	}
	public function getTitulo(){
		return $this->titulo;
	}
	public function getSlug(){
		return str_replace(" ", "_", $this->titulo);
	}
	public function getFecha(){
		return $this->fecha;
	}
	public function getAutor(){
		return $this->autor;
	}
	public function getContenido(){
		return $this->contenido;
	}
	public function getCategoria(){
		return $this->categoria;
	}

	public function setTitulo($titulo){
		$this->titulo = $titulo;
	}
	public function setContenido($contenido){
		$this->contenido = $contenido;
	}
	public function setCategoria($categoria){
		$this->categoria = $categoria;
	}
}