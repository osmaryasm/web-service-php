<?php
/**
 * Obtiene el detalle de un rol especificado por
 * su identificador "idrol"
 */

require 'Roles.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    if (isset($_GET['idrol'])) {

        // Obtener parámetro idrol
        $parametro = $_GET['idrol'];

        // Tratar retorno
        $retorno = Roles::getRolById($parametro);


        if ($retorno) {

            $rol["estado"] = 1;		// cambio "1" a 1 porque no coge bien la cadena.
            $rol["rol"] = $retorno;
            // Enviar objeto json del rol
            print json_encode($rol);
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

