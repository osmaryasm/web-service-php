<?php
/**
 * Obtiene el detalle de un condicion especificado por
 * su identificador "idcond"
 */

require 'Condiciones.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    if (isset($_GET['idcond'])) {

        // Obtener parámetro idcond
        $parametro = $_GET['idcond'];

        // Tratar retorno
        $retorno = Condiciones::getCondById($parametro);


        if ($retorno) {

            $condicion["estado"] = 1;		// cambio "1" a 1 porque no coge bien la cadena.
            $condicion["condicion"] = $retorno;
            // Enviar objeto json del condicion
            print json_encode($condicion);
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

