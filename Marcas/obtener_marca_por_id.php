<?php
/**
 * Obtiene el detalle de una marca especificado por
 * su identificador "idmar"
 */

require 'Marcas.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    if (isset($_GET['idmar'])) {

        // Obtener parámetro idmar
        $parametro = $_GET['idmar'];

        // Tratar retorno
        $retorno = Marcas::getMarcaById($parametro);


        if ($retorno) {

            $marca["estado"] = 1;		// cambio "1" a 1 porque no coge bien la cadena.
            $marca["marca"] = $retorno;
            // Enviar objeto json del marca
            print json_encode($marca);
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

