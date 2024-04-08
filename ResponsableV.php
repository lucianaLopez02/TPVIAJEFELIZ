<?php 

class ResponsableV{
    private $numeroEmpleado;
    private $numeroLicencia;
    private $nombre;
    private $apellido;

	public function __construct($nroEmpleadoR, $nroLicenciaR, $nombreR, $apellidoR) {

		$this->numeroEmpleado = $nroEmpleadoR;
		$this->numeroLicencia = $nroLicenciaR;
		$this->nombre = $nombreR;
		$this->apellido = $apellidoR;
	}

	public function getNumeroEmpleado() {
		return $this->numeroEmpleado;
	}

	public function setNumeroEmpleado($nroEmpleadoR) {
		$this->numeroEmpleado = $nroEmpleadoR;
	}

	public function getNumeroLicencia() {
		return $this->numeroLicencia;
	}

	public function setNumeroLicencia($nroLicenciaR) {
		$this->numeroLicencia = $nroLicenciaR;
	}

	public function getNombre() {
		return $this->nombre;
	}

	public function setNombre( $nombreR) {
		$this->nombre = $nombreR;
	}

	public function getApellido() {
		return $this->apellido;
	}

	public function setApellido($apellidoR) {
		$this->apellido = $apellidoR;
	}

    public function __toString(){
        return "\n"."Numero de empleado: ".$this->getNumeroEmpleado()."\n".
                "Numero de licencia: ".$this->getNumeroLicencia()."\n".
                "nombre: ".$this->getNombre()."\n".
                "apellido: ".$this->getApellido()."\n";
    }
}