<?php 

/**
 * La empresa de Transporte de Pasajeros “Viaje Feliz” quiere registrar la información referente a sus viajes. 
 * De cada viaje se precisa almacenar el código del mismo, destino, cantidad máxima de pasajeros y los pasajeros del viaje.
 * Realice la implementación de la clase Viaje e implemente los métodos necesarios para modificar los atributos de dicha clase 
 * (incluso los datos de los pasajeros). Utilice clases y arreglos  para   almacenar la información correspondiente a los pasajeros.
 * Cada pasajero guarda  su “nombre”, “apellido” y “numero de documento”.
 * Implementar un script testViaje.php que cree una instancia de la clase Viaje y presente un menú que permita cargar la información del viaje, modificar y ver sus datos.
 * Modificar la clase Viaje para que ahora los pasajeros sean un objeto que tenga los atributos nombre, apellido, numero de documento y teléfono.
 * El viaje ahora contiene una referencia a una colección de objetos de la clase Pasajero. También se desea guardar la información de la persona responsable de realizar el viaje,
 * para ello cree una clase ResponsableV que registre el número de empleado, número de licencia, nombre y apellido. La clase Viaje debe hacer referencia al responsable de realizar el viaje.
 * Implementar las operaciones que permiten modificar el nombre, apellido y teléfono de un pasajero. Luego implementar la operación que agrega los pasajeros al viaje, solicitando por consola la información de los mismos. Se debe verificar que el pasajero no este cargado mas de una vez en el viaje. De la misma forma cargue la información del responsable del viaje.
 */

include_once 'Viaje.php';
include_once 'Pasajero.php';
include_once 'ResponsableV.php';

//Menu Principal
function mostrarMenuViaje(){
    echo "----------------[MENU PRINCIPAL]--------------\n";
    echo "1.Cargar Viaje\n";
    echo "2.Modificar Viaje\n";
    echo "3.Mostrar Viaje\n";
    echo "4.Salir\n";          
    echo "Eliga una opcion:\n";
    echo "----------------------------------------------\n";
    $opc = trim(fgets(STDIN));
    return $opc;
}

//Menu para modificar el viaje
function mostrarMenuModificarViaje(){
    echo "\n-----------[MODIFICACION PARA EL VIAJE]------------\n";
    echo "Que quiere modificar del viaje?"."\n";
    echo "1. codigo de viaje\n"; 
    echo "2. destino de viaje\n";
    echo "3. cantidad máxima de pasajeros\n";
    echo "4. informacion de los pasajeros\n";
    echo "5. Informacion del Responsable del viaje\n";
    echo "6. salir\n";
    $opc2 = trim(fgets(STDIN));
    return $opc2;
}

function menuModificarPasajero(){
    echo "------------[MENU PARA MODIFICAR INFORMACION DEL PASAJERO]-----------\n";
    echo "1.Modificar Nombre\n";
    echo "2.Modificar apellido\n";
    echo "3.Modificar numero documento\n";
    echo "4.Modificar telefono\n";

    $opc3 = trim(fgets(STDIN));
    return $opc3;
}

function menuModificarResponsable(){
echo "--------------[MENU PARA MODIFICAR RESPONSABLE]------------"."\n";
    echo "1.modificar numero de empleado: "."\n";
    echo "2.modificar numero de licencia; "."\n";
    echo "3.modificar nombre: "."\n";
    echo "4.modificar apellido: "."\n";
    echo"5.mostar responsable: "."\n";
    echo "6.Salir"."\n";
    $opc4 = trim(fgets(STDIN));
return $opc4;
}

// Función para cargar un nuevo viaje
function cargarViaje() {
    echo "Ingrese el código del viaje: ";
    $codigo = trim(fgets(STDIN));
    echo "Ingrese el destino del viaje: ";
    $destino = trim(fgets(STDIN));

    echo "Ingresar cantidad máxima de pasajeros: ";
    $cantidadMaxima = intval(trim(fgets(STDIN)));

    // Crear objeto Viaje
    $viaje = new Viaje($codigo, $destino, $cantidadMaxima, [], null);

    // Solicitar la cantidad de pasajeros
    do {
        echo "Ingrese la cantidad de pasajeros que subirán al viaje: ";
        $cantPasajeros = intval(trim(fgets(STDIN)));
        if ($cantPasajeros > $cantidadMaxima) {
            echo "La cantidad de pasajeros no puede exceder la cantidad máxima permitida ($cantidadMaxima).\n";
        }
    } while ($cantPasajeros > $cantidadMaxima);

    // Cargar pasajeros
    $i = 0;
$documentosIngresados = []; // Array asociativo para almacenar los números de documento ya ingresados

while ($i < $cantPasajeros) {
    echo "Ingrese nombre del pasajero: ";
    $nombrePasajero = trim(fgets(STDIN));
    echo "Ingrese apellido del pasajero: ";
    $apellidoPasajero = trim(fgets(STDIN));
    
    $numeroDocumentoPasajero = null;
    $documentoExiste = true;

    do {
        echo "Ingrese número de documento del pasajero: ";
        $numeroDocumentoPasajero = trim(fgets(STDIN));

        // Verificar si el número de documento ya fue ingresado
        $documentoExiste = false;
        foreach ($documentosIngresados as $documento) {
            if ($documento == $numeroDocumentoPasajero) {
                $documentoExiste = true;
                echo "Ya existe un pasajero con el número de documento ingresado. Intente con otro número de documento.\n";
                break;
            }
        }
    } while ($documentoExiste);

    // Agregar el número de documento al array de documentos ingresados
    $documentosIngresados[] = $numeroDocumentoPasajero;

    echo "Ingrese teléfono del pasajero: ";
    $telefonoPasajero = trim(fgets(STDIN));
    
    // Crear objeto Pasajero
    $pasajero = new Pasajero($nombrePasajero, $apellidoPasajero, $numeroDocumentoPasajero, $telefonoPasajero);
    
    // Agregar pasajero al viaje
    $viaje->ingresaModificaPasajero($pasajero);
    
    $i++;
}

    // Crear objeto ResponsableV
    echo "--------ingresando datos del responsable-------\n";
    echo "Ingrese el número de empleado del responsable: ";
    $numeroEmpleado = trim(fgets(STDIN));
    echo "Ingrese el número de licencia del responsable: ";
    $numeroLicencia = trim(fgets(STDIN));
    echo "Ingrese el nombre del responsable: ";
    $nombreResponsable = trim(fgets(STDIN));
    echo "Ingrese el apellido del responsable: ";
    $apellidoResponsable = trim(fgets(STDIN));
    $responsable = new ResponsableV($numeroEmpleado, $numeroLicencia, $nombreResponsable, $apellidoResponsable);

    // Asignar responsable al viaje
    $viaje->setResponsableViaje($responsable);

    return $viaje;
}

// Función para modificar un viaje existente
function modificarViaje(Viaje $viaje) {
    $opcion = mostrarMenuModificarViaje();
    switch ($opcion) {
        case 1:
            echo "Ingrese el nuevo código del viaje: ";
            $codigo = trim(fgets(STDIN));
            $viaje->setCodigo($codigo);
            break;
        case 2:
            echo "Ingrese el nuevo destino del viaje: ";
            $destino = trim(fgets(STDIN));
            $viaje->setDestino($destino);
            break;
        case 3:
            echo "Ingrese la nueva cantidad máxima de pasajeros: ";
            $cantMaximaPasajeros = trim(fgets(STDIN));
            // Verificar si la nueva cantidad es mayor que cero
            if ($cantMaximaPasajeros <= 0) {
                echo "La cantidad máxima de pasajeros debe ser mayor que cero.\n";
                break;
            }
            // Verificar si la nueva cantidad es mayor o igual que la cantidad actual de pasajeros
            if ($cantMaximaPasajeros < count($viaje->getColPasajerosViaje())) {
                echo "La nueva cantidad máxima de pasajeros debe ser mayor o igual que la cantidad actual de pasajeros en el viaje.\n";
                break;
            }
            $viaje->setCantMaximaPasajeros($cantMaximaPasajeros);
            break;
        case 4:
            $pasajeros = $viaje->getColPasajerosViaje();
            echo "En el viaje hay ".count($viaje->getColPasajerosViaje())." pasajeros\n";
            echo $viaje->mostrarPasajeros();
            echo "Ingrese el dni del pasajero que quiere modificar su informacion:\n";
            $dniPasajero = trim(fgets(STDIN));
            $aPasajero = $viaje->buscarPasajero($dniPasajero);
        if($aPasajero != -1){
            $unPasajero = $pasajeros[$aPasajero];
            // Si se encontró el pasajero, solicitar la información para modificar
                $opcionModificarPasajero = menuModificarPasajero();
                switch ($opcionModificarPasajero) {
                    case 1:
                        echo "Ingrese el nuevo nombre del pasajero: ";
                        $nombre = trim(fgets(STDIN));
                        // Modificar el nombre del pasajero encontrado
                        $unPasajero->setNombre($nombre);
                        break;
        case 2:
            echo "Ingrese el nuevo apellido del pasajero: ";
            $apellido = trim(fgets(STDIN));
            $unPasajero->setApellido($apellido);
            break;
        case 3:
            echo "Ingrese el nuevo número de documento del pasajero: ";
            $numeroDocumento = trim(fgets(STDIN));
            $unPasajero->setNumeroDocumento($numeroDocumento);
            break;
        case 4:
            echo "Ingrese el nuevo teléfono del pasajero: ";
            $telefono = trim(fgets(STDIN));
            $unPasajero->setTelefono($telefono);
            break;
        default:
            echo "Opción no válida.\n";
            break;
    }
} else { // Si el pasajero no se encuentra, preguntar si se desea agregar
    echo "No se encontró ningún pasajero con el número de documento proporcionado.\n";
    echo "¿Desea agregar este pasajero al viaje? (s/n): ";
    $opcionAgregarPasajero = (trim(fgets(STDIN)));
    if ($opcionAgregarPasajero === "s") {
        // Verificar si se puede agregar más pasajeros al viaje
        if (count($viaje->getColPasajerosViaje()) < $viaje->getCantMaximaPasajeros()) {
            // Solicitar la información del nuevo pasajero
            echo "Ingrese nombre del pasajero: ";
            $nombrePasajero = trim(fgets(STDIN));
            echo "Ingrese apellido del pasajero: ";
            $apellidoPasajero = trim(fgets(STDIN));
            echo "Ingrese numero documento del pasajero: ";
            $nroDocPasajero = trim(fgets(STDIN));
            echo "Ingrese telefono del pasajero: ";
            $telefonoPasajero = trim(fgets(STDIN));

            // Crear el objeto Pasajero
            $nuevoPasajero = new Pasajero($nombrePasajero, $apellidoPasajero,$nroDocPasajero,$telefonoPasajero);

            // Agregar el nuevo pasajero al viaje
            $viaje->ingresaModificaPasajero($nuevoPasajero);

            echo "Pasajero agregado al viaje exitosamente.\n";
        } else {
            echo "No se puede agregar más pasajeros. La cantidad máxima ha sido alcanzada.\n";
        }
    }
}
    
            break;
        case 5:
            // Lógica para modificar el responsable
            $opcionModificarResponsable = menuModificarResponsable();
            // Implementar la lógica de modificación del responsable
    
        switch ($opcionModificarResponsable) {
        case 1:
            echo "Ingrese el nuevo número de empleado del responsable: ";
            $numeroEmpleado = trim(fgets(STDIN));
            $viaje->getResponsableViaje()->setNumeroEmpleado($numeroEmpleado);
            break;
        case 2:
            echo "Ingrese el nuevo número de licencia del responsable: ";
            $numeroLicencia = trim(fgets(STDIN));
            $viaje->getResponsableViaje()->setNumeroLicencia($numeroLicencia);
            break;
        case 3:
            echo "Ingrese el nuevo nombre del responsable: ";
            $nombre = trim(fgets(STDIN));
            $viaje->getResponsableViaje()->setNombre($nombre);
            break;
        case 4:
            echo "Ingrese el nuevo apellido del responsable: ";
            $apellido = trim(fgets(STDIN));
            $viaje->getResponsableViaje()->setApellido($apellido);
            break;
        case 5:
            // Mostrar información del responsable
            echo "Información actual del responsable:\n";
            echo $viaje->getResponsable();
            break;
        case 6:
            echo "Volviendo al menú principal...\n";
            break;
        default:
            echo "Opción no válida.\n";
            break;
}
            break;
        case 6:
            echo "Volviendo al menú principal...\n";
            break;
        default:
            echo "Opción no válida.\n";
            break;
    }
}

// Función para mostrar la información de un viaje
function mostrarViaje(Viaje $viaje) {
    echo $viaje;
}

// Función principal
    $opcion = mostrarMenuViaje();
    $viaje = null; // Variable para almacenar el viaje actual

    while ($opcion != 4) {
        switch ($opcion) {
            case 1:
                $viaje = cargarViaje();
                echo "Viaje cargado exitosamente.\n";
                break;
            case 2:
                if ($viaje != null) {
                    modificarViaje($viaje);
                } else {
                    echo "Primero debe cargar un viaje.\n";
                }
                break;
            case 3:
                if ($viaje != null) {
                    mostrarViaje($viaje);
                } else {
                    echo "No hay ningún viaje cargado.\n";
                }
                break;
            default:
                echo "Opción no válida.\n";
                break;
        }

        $opcion = mostrarMenuViaje();
    }

    echo "Saliendo del programa....";

?>