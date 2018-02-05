<?php
/**
 * Obtiene todas los modelos de la base de datos
 */

require 'Modelos.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    // Manejar petición GET
    $modelos = Modelos::getAll();

    if ($modelos) {

        $datos["estado"] = 1;
        $datos["modelos"] = $modelos;

        print json_encode($datos);
    } else {
        print json_encode(array(
            "estado" => 2,
            "mensaje" => "Ha ocurrido un error"
        ));
    }
}

