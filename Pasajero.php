<?php 

class Pasajero{
    private $nombre;
    private $apellido;
    private $nroDocumento;
    private $telefono;

	public function __construct($nombreP, $apellidoP, $nroDocP, $telefonoP) {

		$this->nombre = $nombreP;
		$this->apellido = $apellidoP;
		$this->nroDocumento = $nroDocP;
		$this->telefono = $telefonoP;
	}

	public function getNombre() {
		return $this->nombre;
	}

	public function setNombre($nombreP) {
		$this->nombre = $nombreP;
	}

	public function getApellido() {
		return $this->apellido;
	}

	public function setApellido($apellidoP) {
		$this->apellido = $apellidoP;
	}

	public function getNroDocumento() {
		return $this->nroDocumento;
	}

	public function setNroDocumento($nroDocP) {
		$this->nroDocumento = $nroDocP;
	}

	public function getTelefono() {
		return $this->telefono;
	}

	public function setTelefono($telefonoP) {
		$this->telefono = $telefonoP;
	}
	
	//Modifica la informacion del pasajero
	public function modificarPasajero($nombre,$apellido,$phone){
		$this->setNombre($nombre);
		$this->setApellido($apellido);
		$this->setTelefono($phone);
	}

    public function __toString(){
        return "\nNombre: ".$this->getNombre()."\n".
                "Apellido: ".$this->getApellido()."\n".
                "Numero de documento: ".$this->getNroDocumento()."\n".
                "Telefono: ".$this->getTelefono()."\n";
    }
}