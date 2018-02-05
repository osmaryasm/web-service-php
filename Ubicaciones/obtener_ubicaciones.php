<?php
/**
 * Obtiene todas las ubicaciones de la base de datos
 */

require 'Ubicaciones.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    // Manejar petición GET
    $ubicaciones = Ubicaciones::getAllUbi();

    if ($ubicaciones) {

        $datos["estado"] = 1;
        $datos["ubicaciones"] = $ubicaciones;

        print json_encode($datos);
    } else {
        print json_encode(array(
            "estado" => 2,
            "mensaje" => "Ha ocurrido un error"
        ));
    }
}

