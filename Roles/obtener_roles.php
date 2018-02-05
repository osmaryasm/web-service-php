<?php
/**
 * Obtiene todas los roles de la base de datos
 */

require 'Roles.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    // Manejar petición GET
    $roles = Roles::getAllRoles();

    if ($roles) {

        $datos["estado"] = 1;
        $datos["roles"] = $roles;

        print json_encode($datos);
    } else {
        print json_encode(array(
            "estado" => 2,
            "mensaje" => "Ha ocurrido un error"
        ));
    }
}

