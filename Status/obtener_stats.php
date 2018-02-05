<?php
/**
 * Obtiene todas los Status de la base de datos
 */

require 'Status.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    // Manejar petición GET
    $stats = Status::getAllStat();

    if ($stats) {

        $datos["estado"] = 1;
        $datos["stats"] = $stats;

        print json_encode($datos);
    } else {
        print json_encode(array(
            "estado" => 2,
            "mensaje" => "Ha ocurrido un error"
        ));
    }
}

