<?php
/**
 * Obtiene el detalle de un modelo especificado por
 * su identificador "idmod"
 */

require 'Modelos.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    if (isset($_GET['idmod'])) {

        // Obtener parámetro idalumno
        $parametro = $_GET['idmod'];

        // Tratar retorno
        $retorno = Modelos::getModById($parametro);


        if ($retorno) {

            $modelo["estado"] = 1;		// cambio "1" a 1 porque no coge bien la cadena.
            $modelo["modelo"] = $retorno;
            // Enviar objeto json del modelo
            print json_encode($modelo);
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

