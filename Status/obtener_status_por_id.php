<?php
/**
 * Obtiene el detalle de un alumno especificado por
 * su identificador "idstat"
 */

require 'Status.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    if (isset($_GET['idstat'])) {

        // Obtener parámetro idstat
        $parametro = $_GET['idstat'];

        // Tratar retorno
        $retorno = Status::getStatById($parametro);


        if ($retorno) {

            $stat["estado"] = 1;		// cambio "1" a 1 porque no coge bien la cadena.
            $stat["stat"] = $retorno;
            // Enviar objeto json del status
            print json_encode($stat);
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

