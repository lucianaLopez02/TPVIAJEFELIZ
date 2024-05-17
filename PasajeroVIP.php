<?php 

include_once "Pasajero.php";

class PasajeroVIP extends Pasajero{
    private $numeroViajeroFrecuente;
    private $cantidadMillas;

    public function __construct($nombreP, $apellidoP, $nroDocP, $telefonoP,$numeroasiento,$numeroticket,$numeroviajerofrecuente,$cantidadmillas){
        parent::__construct($nombreP, $apellidoP, $nroDocP, $telefonoP,$numeroasiento,$numeroticket);

        $this->numeroViajeroFrecuente = $numeroviajerofrecuente;
        $this->cantidadMillas = $cantidadmillas;
    }

    public function getNumeroViajeroFrecuente(){
        return $this->numeroViajeroFrecuente;
    }

    public function setNumeroViajeroFrecuente($numeroviajerofrecuente){
        return $this->numeroViajeroFrecuente = $numeroviajerofrecuente;
    }

    public function getCantidadMillas(){
        return $this->cantidadMillas;
    }

    public function setCantidadMillas($cantidadmillas){
        return $this->cantidadMillas = $cantidadmillas;
    }

    public function darPorcentajeIncremento(){

        $porcentaje = parent::darPorcentajeIncremento();

        if ($this->getCantidadMillas() < 300) {
            $porcentajeIncremento = $porcentaje + 30;
        }else{
            $porcentajeIncremento=$porcentaje + 35;
        }
        return $porcentajeIncremento;
    }

    public function modificarPasajeroVIP($nombre, $apellido,$dni, $telefono, $numeroAsiento, $numeroTicket, $numeroviajerofrecuente,$cantidadmillas){
        parent::modificarPasajero($nombre, $apellido, $dni,$telefono, $numeroAsiento, $numeroTicket);
        $this->setNumeroViajeroFrecuente($numeroviajerofrecuente);
        $this->setCantidadMillas($cantidadmillas);
    }

    public function __toString(){
        $cad = parent::__toString();
        $cad = $cad . "Numero de viajero frecuente: ".$this->getNumeroViajeroFrecuente()."\n". 
            "Cantidad de millas del pasajero: ".$this->getCantidadMillas()."\n";
        return $cad;
    }

}

?>