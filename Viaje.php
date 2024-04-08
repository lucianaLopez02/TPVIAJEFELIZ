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

	public function buscarPasajero($dni){
        $i = 0;
        
        $coleccionPasajeros = $this->getColPasajerosViaje(); // coleccion de pasajeros
        $cant = count($coleccionPasajeros);
        $buscado =  false;

        while ($i < $cant && !$buscado) {
            $objPasajero =$coleccionPasajeros[$i];
            if ($objPasajero->getNroDocumento() == $dni) {
                $pasajeroBuscado = $coleccionPasajeros[$i];
				$buscado = true;
            }
		
        }
       
        return $pasajeroBuscado;
    }

	/**
     * Agregar un pasajero a la coleccion Pasajeros
     * @param object //array $pasajeroNuevo
     */
    public function agregarPasajeros($coleccionPasajeros){  //recibe un obj
       
            $this->setColPasajerosViaje($coleccionPasajeros);
           
            return $coleccionPasajeros;

    }

	public function removerPasajero($dniEliminar){
            $coleccionPasajeros = $this->getColPasajerosViaje();
            // Inicializar variables
            $i = 0;
            $encontrado = false;
        
            // Buscar el pasajero por número de documento
            while ($i < count($coleccionPasajeros) && !$encontrado) {
                $pasajero = $coleccionPasajeros[$i];
                if ($pasajero->getNroDocumento() == $dniEliminar) {
                    $encontrado = true;
                }
            $i++;
            }
        
            // Si se encontró el pasajero, eliminarlo
            if ($encontrado) {
                unset($coleccionPasajeros[$i-1]);
                $this->setColPasajerosViaje($coleccionPasajeros); 
            } 
            return $encontrado;
	}

    /**
     * Verificar que el pasajero no se encuentre en la coleccion de Pasajeros o sea igual a otro pasajero
     * @return boolean
     */
    public function verificarPasajero($nroDocumento,$coleccionPasajeros){
        
        //recorrer la coleccion de pasajeros
            $i = 0;
            $verificacion = false;
            $buscado=false;
            
            while($i < count($coleccionPasajeros) && !$buscado){
            
                $pasajero = $coleccionPasajeros[$i];
                //echo "hola";
                    if ($nroDocumento == $pasajero->getNroDocumento()){
                        $verificacion = true;
                        $buscado = true;
                    }
                    $i++;
                }
            
        return $verificacion; 
    }



    public function __toString(){
        return "\nCodigo: ".$this->getCodigo()."\n".
                "Destino: ".$this->getDestino()."\n".
                "Cantidad maxima de pasajeros: ".$this->getCantMaximaPasajeros()."\n".
                "Pasajeros del viaje: ".$this->mostrarPasajeros()."\n".
				"Responsable del viaje: ".$this->getResponsableViaje()."\n";
    }
}