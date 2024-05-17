<?php 

class Pasajero{
    private $nombre;
    private $apellido;
    private $nroDocumento;
    private $telefono;
	private $numeroAsiento;
	private $numeroTicket;

	public function __construct($nombreP, $apellidoP, $nroDocP, $telefonoP,$numeroasiento,$numeroticket ) {

		$this->nombre = $nombreP;
		$this->apellido = $apellidoP;
		$this->nroDocumento = $nroDocP;
		$this->telefono = $telefonoP;
		$this->numeroAsiento = $numeroasiento;
		$this->numeroTicket = $numeroticket;
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

	public function getNumeroAsiento(){
		return $this->numeroAsiento;
	}

	public function setNumeroAsiento($numeroasiento){
		$this->numeroAsiento = $numeroasiento;
	}

	public function getNumeroTicket(){
		return $this->numeroTicket;
	}

	public function setNumeroTicket($numeroticket){
		$this->numeroTicket = $numeroticket;
	}
	
	 //Funciones del pasajero
	//Modifica la informacion del pasajero
	public function modificarPasajero($nombre,$apellido,$dni,$telefono,$numeroAsiento,$numeroTicket ){
		$this->setNombre($nombre);
		$this->setApellido($apellido);
		$this->setNroDocumento($dni);
		$this->setTelefono($telefono);
		$this->setNumeroAsiento($numeroAsiento);
		$this->setNumeroTicket($numeroTicket);

	}

    /**
     *  retorne el porcentaje que debe aplicarse como incremento según las características del pasajero.
     */
    public function darPorcentajeIncremento(){
        return (0);
    }

    public function __toString(){
        return "\nNombre: ".$this->getNombre()."\n".
                "Apellido: ".$this->getApellido()."\n".
                "Numero de documento: ".$this->getNroDocumento()."\n".
                "Telefono: ".$this->getTelefono()."\n".
				"Numero de asiento: ".$this->getNumeroAsiento()."\n".
				"Numero de ticket del pasaje: ".$this->getNumeroTicket()."\n";
    }
}