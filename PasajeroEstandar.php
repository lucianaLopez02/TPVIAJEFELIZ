<?php 

include_once "Pasajero.php";

class PasajeroEstandar extends Pasajero{

    public function __construct($nombreP, $apellidoP, $nroDocP, $telefonoP,$numeroasiento,$numeroticket){
        parent::__construct($nombreP, $apellidoP, $nroDocP, $telefonoP,$numeroasiento,$numeroticket);
    }

    public function darPorcentajeIncremento(){
        $porcentaje = parent::darPorcentajeIncremento();
        
        $porcentajeIncremento = $porcentaje + 10;
        return $porcentajeIncremento;
    }

    public function modificarPasajeroEstandar($nombre, $apellido,$dni, $telefono, $numeroAsiento, $numeroTicket){
        parent::modificarPasajero($nombre, $apellido,$dni, $telefono, $numeroAsiento, $numeroTicket);
    }

    public function __toString(){
        $cad = parent::__toString();
        return $cad;
    }

}

?>