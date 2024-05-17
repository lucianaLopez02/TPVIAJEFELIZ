<?php 

include_once "Pasajero.php";
class PasajeroEspecial extends Pasajero{
    //tienen valores booleanos
    private $sillaRuedas;
    private $asistencia; //embarque o desembarque
    private $comidaEspecial;

    public function __construct($nombreP, $apellidoP, $nroDocP, $telefonoP,$numeroasiento,$numeroticket,$sillaruedas,$asistencia,$comidaespecial){
        parent::__construct($nombreP, $apellidoP, $nroDocP, $telefonoP,$numeroasiento,$numeroticket );
        $this->sillaRuedas = $sillaruedas;
        $this->asistencia = $asistencia; //embarque y desembarque
        $this->comidaEspecial = $comidaespecial;
    }

    public function getSillaRuedas(){
        return $this->sillaruedas;
    }

    public function setSillaRuedas($sillaruedas){
        $this->sillaRuedas = $sillaruedas;
    }

    public function getAsistencia(){
        return $this->asistencia;
    }

    public function setAsistencia($asistencia){
        $this->asistencia = $asistencia;
    }

    public function getComidaEspecial(){
        return $this->comidaEspecial;
    }

    public function setComidaEspecial($comidaespecial){
        $this->comidaEspecial = $comidaespecial;
    }

    public function darPorcentajeIncremento(){

        $porcentaje = parent::darPorcentajeIncremento();

        if($this->getSillaRuedas() && $this->getAsistencia() && $this->getComidaEspecial()==true){

            $porcentajeIncremento = $porcentaje + 30;

        }elseif($this->getSillaRuedas() && !$this->getAsistencia() && !$this->getComidaEspecial()){
            $porcentajeIncremento = $porcentaje + 15;

        }elseif(!$this->getSillaRuedas() && $this->getAsistencia() && !$this->getComidaEspecial()){
            $porcentajeIncremento = $porcentaje + 15;

        }elseif(!$this->getSillaRuedas() && !$this->getAsistencia() && $this->getComidaEspecial()){
            $porcentajeIncremento = $porcentaje + 15;
        }
        return $porcentajeIncremento;
    }

    public function modificarPasajeroEspecial($nombre, $apellido,$dni, $telefono, $numeroAsiento, $numeroTicket, $sillaruedas,$asistencia,$comidaespecial){
        parent::modificarPasajero($nombre, $apellido,$dni, $telefono, $numeroAsiento, $numeroTicket);
        $this->setSillaRuedas($sillaruedas);
        $this->setAsistencia($asistencia);
        $this->setComidaEspecial($comidaespecial);
    }


    public function __toString(){
        $cad = parent::__toString();
        $cad = $cad ."\n".$this->getSillaRuedas(). "\n Asistencia: ".$this->getAsistencia(). "\n Comida Especial: ".$this->getComidaEspecial();
        return $cad;
    }

}

?>