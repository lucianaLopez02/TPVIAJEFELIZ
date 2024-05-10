<?php 

class Viaje{
    private $codigo;
    private $destino;
    private $cantMaximaPasajeros;
    private $colPasajerosViaje;// coleccion objPasajero
    private $responsableViaje; //objResponsable

	public function __construct($codigoV, $destinoV, $cantMaximaPasajerosV, $pasajerosViajeV,$objResponsableV) {

		$this->codigo = $codigoV;
		$this->destino = $destinoV;
		$this->cantMaximaPasajeros = $cantMaximaPasajerosV;
		$this->colPasajerosViaje = $pasajerosViajeV;
        $this->responsableViaje = $objResponsableV;
    }
	public function getCodigo() {
		return $this->codigo;
	}

	public function setCodigo($codigoV) {
		$this->codigo = $codigoV;
	}

	public function getDestino() {
		return $this->destino;
	}

	public function setDestino($destinoV) {
		$this->destino = $destinoV;
	}

	public function getCantMaximaPasajeros() {
		return $this->cantMaximaPasajeros;
	}

	public function setCantMaximaPasajeros($cantMaximaPasajerosV) {
		$this->cantMaximaPasajeros = $cantMaximaPasajerosV;
	}

	public function getColPasajerosViaje() {
		return $this->colPasajerosViaje;
	}

	public function setColPasajerosViaje($pasajerosViajeV) {
		$this->colPasajerosViaje = $pasajerosViajeV;
	}

    public function getResponsableViaje(){
        return $this->responsableViaje;
    }

    public function setResponsableViaje($objResponsableV){
        $this->responsableViaje = $objResponsableV;
    }

    public function mostrarPasajeros(){
        $coleccionPasajeros = $this->getColPasajerosViaje();
        $cad = "";
        for ($i=0; $i < count($coleccionPasajeros); $i++) { 
            $pasajero = $coleccionPasajeros[$i];
            $cad .= "\nPasajero ".($i+1).":".$pasajero."\n";
        }
        return $cad;
    }

    
// Metodo que busca a un pasajero
public function buscarPasajero($documento){
    $arrPasajeros = $this->getColPasajerosViaje();
    $encontrado = false;
    $i = 0;
    while($i<count($arrPasajeros) && !$encontrado){
        $unPasajero = $arrPasajeros[$i];
        if($unPasajero->getNroDocumento() == $documento){
            $encontrado = true;
        }else{
            $i++;
        }
       
    }
    if(!$encontrado){
        $i = -1;
    }
    return $i;
}

    
//Método que verifica si el pasajero se encuentra en el viaje
public function pasajeroYaCargado($doc){
    if($this->buscarPasajero($doc) != -1){
        $pasajeroCargado = true;
    }else{
        $pasajeroCargado = false;
    }
    return $pasajeroCargado;
}
    //une las dos funcionalidades de cargar y modificar pasajero
    public function ingresaModificaPasajero($objInfoPasajero){
        $dni = $objInfoPasajero->getNroDocumento();
        $nombrePasajero = $objInfoPasajero->getNombre();
        $apellidoPasajero = $objInfoPasajero->getApellido();
        $telefonoPasajero = $objInfoPasajero->getTelefono();
        $pasajeros = $this->getColPasajerosViaje();
        if($this->pasajeroYaCargado($dni)){
            $indiceModifica = $this->buscarPasajero($dni);
            $elPasajero = $pasajeros[$indiceModifica];
            $elPasajero->modificarPasajero($nombrePasajero,$apellidoPasajero,$dni,$telefonoPasajero);
            $pasajeros[$indiceModifica] = $elPasajero;
            $this->setColPasajerosViaje($pasajeros);
        }else{
        $objPasajero =  new Pasajero($nombrePasajero,$apellidoPasajero,$dni,$telefonoPasajero);
        $pasajeros[]=$objPasajero;
        $this->setColPasajerosViaje($pasajeros);
        }
    }

   


    public function __toString(){
        return "\nCodigo: ".$this->getCodigo()."\n".
                "Destino: ".$this->getDestino()."\n".
                "Cantidad maxima de pasajeros: ".$this->getCantMaximaPasajeros()."\n".
                "Pasajeros del viaje: ".$this->mostrarPasajeros()."\n".
				"Responsable del viaje: ".$this->getResponsableViaje()."\n";
    }
}