<?php
/**
 * Obtiene todas las Marcas de la base de datos
 */

require 'Marcas.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    // Manejar petición GET
    $marcas = Marcas::getAllMarcas();

    if ($marcas) {

        $datos["estado"] = 1;
        $datos["marcas"] = $marcas;

        print json_encode($datos);
    } else {
        print json_encode(array(
            "estado" => 2,
            "mensaje" => "Ha ocurrido un error"
        ));
    }
}

