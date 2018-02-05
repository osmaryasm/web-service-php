<?php
/**
 * Obtiene el detalle de un ubicacion especificado por
 * su identificador "idubi"
 */

require 'Ubicaciones.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    if (isset($_GET['idubi'])) {

        // Obtener parámetro idubi
        $parametro = $_GET['idubi'];

        // Tratar retorno
        $retorno = Ubicaciones::getUbiById($parametro);


        if ($retorno) {

            $ubicacion["estado"] = 1;		// cambio "1" a 1 porque no coge bien la cadena.
            $ubicacion["ubicacion"] = $retorno;
            // Enviar objeto json de la ubicacion
            print json_encode($ubicacion);
        } else {
            // Enviar respuesta de error general
            print json_encode(
                array(
                    'estado' => '2',
                    'mensaje' => 'No se obtuvo el registro'
                )
            );
        }

    } else {
        // Enviar respuesta de error
        print json_encode(
            array(
                'estado' => '3',
                'mensaje' => 'Se necesita un identificador'
            )
        );
    }
}

