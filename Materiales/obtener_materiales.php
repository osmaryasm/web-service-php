<?php
/**
 * Obtiene todas los materiales de la base de datos
 */

require 'Materiales.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    // Manejar petición GET
    $materiales = Materiales::getAll();

    if ($alumnos) {

        $datos["estado"] = 1;
        $datos["materiales"] = $materiales;

        print json_encode($datos);
    } else {
        print json_encode(array(
            "estado" => 2,
            "mensaje" => "Ha ocurrido un error"
        ));
    }
}

