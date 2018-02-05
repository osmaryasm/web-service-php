<?php
/**
 * Obtiene el detalle de un alumno especificado por
 * su identificador "iduser"
 */

require 'Usuarios.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    if (isset($_GET['iduser'])) {

        // Obtener parámetro idalumno
        $parametro = $_GET['iduser'];

        // Tratar retorno
        $retorno = Usuarios::getUserById($parametro);


        if ($retorno) {

            $user["estado"] = 1;		// cambio "1" a 1 porque no coge bien la cadena.
            $user["user"] = $retorno;
            // Enviar objeto json del user
            print json_encode($user);
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

