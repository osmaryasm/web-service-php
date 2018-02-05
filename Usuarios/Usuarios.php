<?php

 * Representa la estructura de los usuari
/**os
 * almacenadas en la base de datos
 */
require 'Database.php';

class Usuarios
{
    function __construct()
    {
    }

    /**
     * Retorna en la fila especificada de la tabla 'Usuarios'
     *
     * @param $id_us Identificador del registro
     * @return array Datos del registro
     */
    public static function getAllUsers()
    {
        $consulta = "SELECT * FROM usuarios";
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
     * Obtiene los campos de un usuario con un identificador
     * determinado
     *
     * @param $id_us Identificador del usuario
     * @return mixed
     */
    public static function getUserById($id_us)
    {
        // Consulta de la tabla usuarios
        $consulta = "SELECT id_us,
                            nombre,
                            apellido,
                            tlf,
                            email,
                             FROM usuarios
                             WHERE id_us = ?";

        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($id_us));
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
     * @param $id_us      identificador
     * @param $nombre      nuevo nombre
     * @param $apellido nuevo apellido
     * @param $tlf nuevo tlf
     * @param $email nuevo email
     
     */
    public static function updateUser(
        $id_us,
        $nombre,
        $apellido,
        $tlf,
        $email
    )
    {
        // Creando consulta UPDATE
        $consulta = "UPDATE usuarios" . " SET nombre=?, apellido=?, tlf=?, email=? " . "WHERE id_us=?";

        // Preparar la sentencia
        $cmd = Database::getInstance()->getDb()->prepare($consulta);

        // Relacionar y ejecutar la sentencia
        $cmd->execute(array($nombre, $apellido, $tlf, $email, $idAlumno));

        return $cmd;
    }

    /**
     * Insertar un nuevo usuario
     *
     * @param $nombre      nombre del nuevo registro
     * @param $apellido nuevo apellido
     * @param $tlf nuevo tlf
     * @param $email nuevo email
     * @return PDOStatement
     */
    public static function insertUser(
        $nombre,
        $apellido,
        $tlf,
        $email
    )
    {
        // Sentencia INSERT
        $comando = "INSERT INTO usuarios ( " . "nombre," . "apellido," . "tlf," . " email)" . " VALUES( ?,?,?,?)";

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(
            array(
                $nombre,
                $apellido,
                $tlf,
                $email
            )
        );

    }

    /**
     * Eliminar el registro con el identificador especificado
     *
     * @param $id_us identificador de la tabla usuarios
     * @return bool Respuesta de la eliminación
     */
    public static function deleteUser($id_us)
    {
        // Sentencia DELETE
        $comando = "DELETE FROM usuarios WHERE id_us=?";

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(array($id_us));
    }
}

?>