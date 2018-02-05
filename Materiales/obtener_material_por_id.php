<?php
/**
 * Obtiene el detalle de un material especificado por
 * su identificador "idmat"
 */

require 'Materiales.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    if (isset($_GET['idmat'])) {

        // Obtener parámetro idmat
        $parametro = $_GET['idmat'];

        // Tratar retorno
        $retorno = Materiales::getById($parametro);


        if ($retorno) {

            $material["estado"] = 1;		// cambio "1" a 1 porque no coge bien la cadena.
            $material["material"] = $retorno;
            // Enviar objeto json del material
            print json_encode($material);
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

