<?php

class Usuario{

	private $id;
	private $nombre;
	private $apellidos;
	private $email;
	private $nick;
	private $md5pass;

	function __construct($id, $nombre, $apellidos, $email, $nick, $md5pass){
		$this->id = $id;
		$this->nombre = $nombre;
		$this->apellidos = $apellidos;
		$this->email = $email;
		$this->nick = $nick;
		$this->md5pass = $md5pass;
	}

	public function getId(){
		return $this->id;
	}

	public function getNombre(){
		return $this->nombre;
	}

	public function getApellidos(){
		return $this->apellidos;
	}

	public function getEmail(){
		return $this->email;
	}

	public function getNick(){
		return $this->nick;
	}

	public function setNombre($nombre){
		$this->nombre = $nombre;
	}

	public function setApellidos($apellidos){
		$this->apellidos = $apellidos;
	}

	public function setEmail($email){
		$this->email = $email;
	}

	public function setNick($nick){
		$this->nick = $nick;
	}

	public function auth($pass){
		return ($this->md5pass == md5($pass));
	}
}