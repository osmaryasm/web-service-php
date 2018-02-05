<?php
/**
 * Obtiene todas las Condiciones de la base de datos
 */

require 'Condiciones.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    // Manejar petición GET
    $conds = Condiciones::getAllConds();

    if ($conds) {

        $datos["estado"] = 1;
        $datos["conds"] = $conds;

        print json_encode($datos);
    } else {
        print json_encode(array(
            "estado" => 2,
            "mensaje" => "Ha ocurrido un error"
        ));
    }
}

