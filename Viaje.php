<?php 

class Viaje{
    private $codigo;
    private $destino;
    private $cantMaximaPasajeros;
    private $colPasajerosViaje;// coleccion objPasajero
    private $responsableViaje; //objResponsable
    private $costoViaje;
    private $costoTotalAbonado;

	public function __construct($codigoV, $destinoV, $cantMaximaPasajerosV, $pasajerosViajeV,$objResponsableV,$costoviaje, $costototalabonado) {

		$this->codigo = $codigoV;
		$this->destino = $destinoV;
		$this->cantMaximaPasajeros = $cantMaximaPasajerosV;
		$this->colPasajerosViaje = $pasajerosViajeV;
        $this->responsableViaje = $objResponsableV;
        $this->costoViaje = $costoviaje;
        $this->costoTotalAbonado = $costototalabonado;
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

    public function getCostoViaje() {
        return $this->costoViaje;
    }

    public function setCostoViaje($costoviaje) {
        $this->costoViaje = $costoviaje;
    }

    public function getCostoTotalAbonado() {
        return $this->costoTotalAbonado;
    }

    public function setCostoTotalAbonado($costototalabonado) {
        $this->costoTotalAbonado = $costototalabonado;
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
   
    
    
    /**
     * retorna verdadero si la cantidad de pasajeros del viaje es menor a la cantidad máxima de pasajeros y
     *  falso caso contrario
     */
    public function hayPasajesDisponible(){
        $limite=$this->getCantMaximaPasajeros();
        $cantPasajeros=count($this->getColPasajerosViaje());
        $disponible=false;
        if($cantPasajeros<=$limite){
            $disponible=true;
        }
        return $disponible;
    }


    /**
     *  calcula el importe a pagar por el pasajero teniendo en cuenta el costo base del viaje y el porcentaje de incremento asociado al tipo de pasajero, actualiza el costo total recaudado del viaje y devuelve el importe a pagar.
     */
    private function calculoDelIncremento($objPasajero) {
        $incremento = $objPasajero->darPorcentajeIncremento();
        $importe = $this->getCostoViaje();
        $importeAPagar = $importe + (($importe * $incremento) / 100);
        $suma = $importeAPagar + $this->getCostoTotalAbonado();
        $this->setCostoTotalAbonado($suma);
        return $importeAPagar;
    }
    
    /**
     *  se encarga de vender un pasaje a un pasajero y determinar el importe a pagar por dicho pasaje. 
     */
    public function venderPasaje($objPasajero) {
    
        $importeAPagar = -1;
    
        if ($objPasajero instanceof PasajeroEstandar) {
            $importeAPagar = $this->calculoDelIncremento($objPasajero);
        }elseif ($objPasajero instanceof PasajeroVIP) {
            $importeAPagar = $this->calculoDelIncremento($objPasajero);
        }elseif ($objPasajero instanceof PasajeroEspecial) {
            $importeAPagar = $this->calculoDelIncremento($objPasajero);
        }
    
        return $importeAPagar;
    }

   


    public function __toString(){
        return "\nCodigo: ".$this->getCodigo()."\n".
                "Destino: ".$this->getDestino()."\n".
                "Cantidad maxima de pasajeros: ".$this->getCantMaximaPasajeros()."\n".
                "Pasajeros del viaje: ".$this->mostrarPasajeros()."\n".
				"Responsable del viaje: ".$this->getResponsableViaje()."\n".
                "Costo total abonado: " . $this->getCostoTotalAbonado() . "\n" .
                "Responsable del viaje: " . $this->getResponsableViaje() . "\n";
    }
}