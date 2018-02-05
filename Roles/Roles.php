<?php

/**
 * Representa la estructura de los roles
 * almacenadas en la base de datos
 */
require 'Database.php';

class Roles
{
    function __construct()
    {
    }

    /**
     * Retorna en la fila especificada de la tabla 'roles'
     *
     * @param $id_rol Identificador del registro
     * @return array Datos del registro
     */
    public static function getAllRoles()
    {
        $consulta = "SELECT * FROM roles";
        //error_log("Esto es un query ".$consulta,3,"error.txt");
        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute();

            return $comando->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            return false;
        }
    }

    /**
     * Obtiene los campos de un Rol con un identificador
     * determinado
     *
     * @param $id_rol Identificador del alumno
     * @return mixed
     */
    public static function getRolById($idAlumno)
    {
        // Consulta de la tabla roles
        $consulta = "SELECT id_rol,
                            nom_rol
                             FROM roles
                             WHERE id_rol = ?";

        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($id_rol));
            // Capturar primera fila del resultado
            $row = $comando->fetch(PDO::FETCH_ASSOC);
            return $row;

        } catch (PDOException $e) {
            // Aquí puedes clasificar el error dependiendo de la excepción
            // para presentarlo en la respuesta Json
            return -1;
        }
    }

    /**
     * Actualiza un registro de la bases de datos basado
     * en los nuevos valores relacionados con un identificador
     *
     * @param $id_rol      identificador
     * @param $nom_rol      nuevo nombre
     
     
     */
    public static function updateRol(
        $id_rol,
        $nom_rol
    )
    {
        // Creando consulta UPDATE
        $consulta = "UPDATE roles" .
            " SET nom_rol=? " .
            "WHERE id_rol=?";

        // Preparar la sentencia
        $cmd = Database::getInstance()->getDb()->prepare($consulta);

        // Relacionar y ejecutar la sentencia
        $cmd->execute(array($nom_rol, $id_rol));

        return $cmd;
    }

    /**
     * Insertar un nuevo Rol
     *
     * @param $nom_rol      nombre del nuevo registro
     * @return PDOStatement
     */
    public static function insertRol(
        $nom_rol
     )
    {
        // Sentencia INSERT
        $comando = "INSERT INTO roles ( " .
            "nom_rol," . ")" .
            " VALUES( ?)";

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(
            array(
                $nom_rol

            )
        );

    }

    /**
     * Eliminar el registro con el identificador especificado
     *
     * @param $id_rol identificador de la tabla roles
     * @return bool Respuesta de la eliminación
     */
    public static function deleteRol($id_rol)
    {
        // Sentencia DELETE
        $comando = "DELETE FROM roles WHERE id_rol=?";

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(array($id_rol));
    }
}

?>