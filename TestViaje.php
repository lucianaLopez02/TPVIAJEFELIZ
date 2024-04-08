<?php 

include_once 'Viaje.php';
include_once 'Pasajero.php';
include_once 'ResponsableV.php';

//-----------Menu para Viaje
    
    // echo "1.Cargar Viaje\n"; //ya deberia estar el viaje cargado
    // echo "¿Desea ingresar un viaje?(s/n)\n";
    // $rta = trim(fgets(STDIN));

    // while ($rta == "s") {

    $objViaje = new Viaje("","",0,[],null); //inicializo viaje
    $coleccionPasajeros = [];
    echo "Codigo: ";
    $cod = trim(fgets(STDIN));
    echo "Destino: ";
    $dest = trim(fgets(STDIN));
    echo "cantidad maxima de pasajeros: ";
    $cantMaxPasajeros = trim(fgets(STDIN));
    
    do {
        echo "Ingrese cantidad de pasajeros: ";
        $cantPasajeros = trim(fgets(STDIN));
        if ($cantPasajeros <= $cantMaxPasajeros) {
            for ($i = 0; $i < $cantPasajeros; $i++) { 
                $cargoPasajero = false;
                echo "Crear pasajero " . ($i + 1) . "\n";
                echo "Ingresar nombre: ";
                $nom = trim(fgets(STDIN));
                echo "Ingresar apellido: ";
                $ape = trim(fgets(STDIN));
                echo "Ingresar número documento: ";
                $nroDoc = trim(fgets(STDIN));
                
                while (!$cargoPasajero) {
                    if (!$objViaje->verificarPasajero($nroDoc, $coleccionPasajeros)) {
                        
                        echo "Ingresar teléfono: ";
                        $telefono = trim(fgets(STDIN));
     
                        // Crear un nuevo objeto Pasajero y agregarlo a la colección
                        $objPasajero = new Pasajero($nom, $ape, $nroDoc, $telefono);
                        $coleccionPasajeros[$i] = $objPasajero; // Agrega el pasajero al final de la colección
                        $coleccionPasajeros = $objViaje->agregarPasajeros($coleccionPasajeros);
                        // print_r($coleccionPasajeros);
                        $cargoPasajero = true;
                    } else {
                        echo "El pasajero ya existe.\n";
                        // Actualizar datos para volver a verificar
                        echo "Ingresar nombre: ";
                        $nom = trim(fgets(STDIN));
                        echo "Ingresar apellido: ";
                        $ape = trim(fgets(STDIN));
                        echo "Ingresar número documento: ";
                        $nroDoc = trim(fgets(STDIN));
                    }
                }
            }
            
        } else {
            echo "Supera número máximo de pasajeros permitidos.\n";
        }
    } while ($cantPasajeros > $cantMaxPasajeros);
    

    echo "Ingresar un responsable "."\n";
    echo "Ingrese numero de empleado: "."\n";
    $nroEmpleado = trim(fgets(STDIN));
    echo "Ingrese numero de licencia: "."\n";
    $nroLicencia = trim(fgets(STDIN));
    echo "Ingrese nombre: "."\n";
    $nomR = trim(fgets(STDIN));
    echo "Ingrese apellido: "."\n";
    $apeR = trim(fgets(STDIN));
    $objResponsable = new ResponsableV($nroEmpleado,$nroLicencia,$nomR,$apeR);

    // Cargo informacion al viaje
    $objViaje->setCodigo($cod);
    $objViaje->setDestino($dest);
    $objViaje->setCantMaximaPasajeros($cantMaxPasajeros);
    $objViaje->setColPasajerosViaje($coleccionPasajeros);
    $objViaje->setResponsableViaje($objResponsable);


    

    do {
        echo "----------------[Menu principal]------------\n";
        echo "1.Modificar Viaje\n";
        echo "2.Mostrar Viaje\n";
        echo "3.Salir\n";
        echo "Eliga una opcion: \n";

        $numOpcion = trim(fgets(STDIN));
        switch ($numOpcion) {
            case '1':
                do{
                echo "\n-----------[OPCIONES DE MODIFICACION PARA EL VIAJE]------------\n";
                echo "Que quiere modificar del viaje?"."\n";
                echo "1. codigo de viaje\n"; 
                echo "2. destino de viaje\n";
                echo "3. cantidad máxima de pasajeros\n";
                echo "4. Coleccion de pasajeros\n";
                echo "5. Responsable del viaje\n";
                echo "6. salir\n";
             
                $opc =trim(fgets(STDIN));
    
                if ($opc == 1) {
                    echo "Ingrese nuevo código de viaje: \n";
                    $nuevoCodigo = trim(fgets(STDIN));
                    $objViaje->setCodigo($nuevoCodigo); 
                }elseif ($opc == 2) {
                    echo "Ingrese el nuevo destino del viaje:\n";
                    $nuevoDestino = trim(fgets(STDIN));
                    $objViaje->setDestino($nuevoDestino);
                }elseif ($opc == 3) {
                    echo "Ingrese la nueva capacidad máxima de pasajeros: \n";
                    $nuevaCantMaxima = trim(fgets(STDIN));
                    if ($nuevaCantMaxima >= count($objViaje->getColPasajerosViaje($coleccionPasajeros))) {
                        $objViaje->setCantMaximaPasajeros($nuevaCantMaxima);
                    }else{
                        echo "la nueva cantidad debe ser mayor a la cantidad de pasajeros\n";
                        echo "la cantidad actual de pasajeros es:".count($objViaje->getColPasajerosViaje($coleccionPasajeros))."\n";
                    }
                 }elseif ($opc == 4) {
                    do {
                        echo "------------[Menu para pasajeros]-------------\n";
                    echo "1.Agregar nuevo pasajero \n"; //array push
                    echo "2.Modificar pasajero \n";
                    echo "3.Eliminar pasajero \n"; //funcion unset
                    echo "4.Mostrar pasajero \n";
                    echo "5.Salir \n";
    
                    $numOpc = trim(fgets(STDIN));
    
                    if ($numOpc == 1) {
                        
                        if (count($coleccionPasajeros) < $objViaje->getCantMaximaPasajeros()) {
                                $cargoPasajero = false;
                                echo "Crear pasajero " . ($i + 1) . "\n";
                                echo "Ingresar nombre: ";
                                $nom = trim(fgets(STDIN));
                                echo "Ingresar apellido: ";
                                $ape = trim(fgets(STDIN));
                                echo "Ingresar número documento: ";
                                $nroDoc = trim(fgets(STDIN));
                                
                                // Verificar si el pasajero ya existe en la colección
                                while (!$cargoPasajero) {
                                    if (!$objViaje->verificarPasajero($nroDoc, $coleccionPasajeros)) {
                                        // Si el pasajero no existe, permitir al usuario ingresar los datos del pasajero
                                        echo "Ingresar teléfono: ";
                                        $telefono = trim(fgets(STDIN));
                     
                                        // Crear un nuevo objeto Pasajero y agregarlo a la colección
                                        $objPasajero = new Pasajero($nom, $ape, $nroDoc, $telefono);
                                        $coleccionPasajeros[] = $objPasajero; // Agrega el pasajero al final de la colección
                                        $coleccionPasajeros = $objViaje->agregarPasajeros($coleccionPasajeros);
                                        // print_r($coleccionPasajeros);
                                        $cargoPasajero = true;
                                    } else {
                                        echo "El pasajero ya existe.\n";
                                        // Actualizar datos para volver a verificar
                                        echo "Ingresar nombre: ";
                                        $nom = trim(fgets(STDIN));
                                        echo "Ingresar apellido: ";
                                        $ape = trim(fgets(STDIN));
                                        echo "Ingresar número documento: ";
                                        $nroDoc = trim(fgets(STDIN));
                                    }
                                }
                        } else {
                            echo "No se puede agregar nuevos pasajeros por la capacidad máxima.\n";
                        }
                    
    
                    }elseif($numOpc == 2){
                        echo "Que quiere editar del pasajero?";
                        echo "1.Nombre";
                        echo "2.Apellido";
                        echo "3.numero Documento";
                        echo "4.telefono";
                        $nroOpc = trim(fgets(STDIN));
                        if ($nroOpc == 1) {
                            echo "Ingrese el dni del pasajero para modificar: \n";
                            $dniPasajero = trim(fgets(STDIN));
                            $pasajeroBuscado = $objViaje->buscarPasajero($dniPasajero);
                            echo "Ingrese nuevo nombre: \n";
                            $nomNuevo =  trim(fgets(STDIN));
                            $pasajeroBuscado->setNombre($nomNuevo);
    
                        }elseif($nrOpc == 2){
                            echo "Ingrese el dni del pasajero para modificar: \n";
                            $dniPasajero = trim(fgets(STDIN));
                            $pasajeroBuscado = $objViaje->buscarPasajero($dniPasajero);
                            echo "Ingrese nuevo apellido: \n";
                            $apeNuevo =  trim(fgets(STDIN));
                            $pasajeroBuscado->setApellido($apeNuevo);
                        }elseif($nroOpc == 3){
                            echo "Ingrese el dni del pasajero para modificar: \n";
                            $dniPasajero = trim(fgets(STDIN));
                            $pasajeroBuscado = $objViaje->buscarPasajero($dniPasajero);
                            echo "Ingrese nuevo numero documento: \n";
                            $nroDocumentoNuevo =  trim(fgets(STDIN));
                            $pasajeroBuscado->setNroDocumento($nroDocumentoNuevo);
                        }elseif($nroOpc == 4){
                            echo "Ingrese el dni del pasajero para modificar: \n";
                            $dniPasajero = trim(fgets(STDIN));
                            $pasajeroBuscado = $objViaje->buscarPasajero($dniPasajero);
                            echo "Ingrese telefono: ";
                            $telefonoNuevo =  trim(fgets(STDIN));
                            $pasajeroBuscado->setTelefono($apeNuevo);
                        }
    
                    }elseif($numOpc == 3){
                        echo "Ingrese el dni del pasajero que quiere eliminar: \n";
                        $dniEliminar = trim(fgets(STDIN));
    
    
                        if($objViaje->removerPasajero($dniEliminar)){
                            echo "Pasajero encontrado y eliminado\n";
                        }else{
                            echo "No existe el pasajero con ese dni\n";
                        }
    
                    }elseif($numOpc == 4){
                       echo $objViaje->mostrarPasajeros(); //Muestra el listado de los pasajeros
                    }
                    
                }while ($numOpc != 5);
                // echo $objViaje;
                }elseif ($opc == 5) {
                    do{
                        echo "--------------MENU PARA RESPONSABLE------------"."\n";
                        echo "1.modificar numero de empleado: "."\n";
                        echo "2.modificar numero de licencia; "."\n";
                        echo "3.modificar nombre: "."\n";
                        echo "4.modificar apellido: "."\n";
                        echo"5.mostar responsable: "."\n";
                        echo "6.Salir"."\n";
                        $opcR = trim(fgets(STDIN));

                        if ($opcR == 1) {
                        
                            echo "Ingrese nuevo numero de empleado: \n";
                            $numNuevo =  trim(fgets(STDIN));
                            $objResponsable->setNumeroEmpleado($numNuevo);
    
                        }elseif($opcR == 2){
                            echo "Ingrese nuevo numero de licencia: \n";
                            $licNuevo =  trim(fgets(STDIN));
                            $objResponsable->setNumeroLifcencia($licNuevo);
                        }elseif($opcR == 3){
                            echo "Ingrese el nuevo nombre: \n";
                            $nomNuevo =  trim(fgets(STDIN));
                            $objResponsable->setNombre($nomNuevo);
                        }elseif($opcR == 4){
                            echo "Ingrese apellido: ";
                            $apellidoNuevo =  trim(fgets(STDIN));
                            $objResponsable->setApellido($apellidoNuevo);
                        }elseif ($opcR == 5) {
                         echo $objResponsable;
                        }

                     } while($opcR != 6);
                }
            }while($opc != 6);
                break;
            case '2':
                echo "-----------DATOS DEL VIAJE------------";
                echo $objViaje;
                
                break;
            case '3':
                echo "Salida del menu";
                break;
                    
            
            default:
                echo "Elija otra opcion";
                break;
                }
            }while ($numOpcion != 3);
        // }
