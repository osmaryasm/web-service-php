<?php

/**
 * Representa la estructura de los modelos
 * almacenadas en la base de datos
 */
require 'Database.php';

class Modelos
{
    function __construct()
    {
    }

    /**
     * Retorna en la fila especificada de la tabla 'modelos'
     *
     * @param $id_mod Identificador del registro
     * @return array Datos del registro
     */
    public static function getAllMods()
    {
        $consulta = "SELECT * FROM modelos";
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
     * Obtiene los campos de un modelo con un identificador
     * determinado
     *
     * @param $id_mod Identificador de los modelos
     * @return mixed
     */
    public static function getModById($id_mod)
    {
        // Consulta de la tabla modelos
        $consulta = "SELECT id_mod,
                            nom_mod
                             FROM modelos
                             WHERE id_mod = ?";

        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($id_mod));
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
     * @param $id_mod      identificador
     * @param $nom_mod      nuevo nombre
     
     */
    public static function updateMod(
        $id_mod,
        $nom_mod
    )
    {
        // Creando consulta UPDATE
        $consulta = "UPDATE modelos" . " SET nom_mod=? " . "WHERE id_mod=?";

        // Preparar la sentencia
        $cmd = Database::getInstance()->getDb()->prepare($consulta);

        // Relacionar y ejecutar la sentencia
        $cmd->execute(array($nom_mod, $id_mod));

        return $cmd;
    }

    /**
     * Insertar un nuevo modelo
     *
     * @param $nom_mod      nombre del nuevo registro
     * @return PDOStatement
     */
    public static function insertMod(
        $nom_mod
    )
    {
        // Sentencia INSERT
        $comando = "INSERT INTO modelos ( " . "nom_stat" . " )" . " VALUES( ?)";

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(
            array(
                $nom_mod
            )
        );

    }

    /**
     * Eliminar el registro con el identificador especificado
     *
     * @param $id_mod identificador de la tabla modelos
     * @return bool Respuesta de la eliminación
     */
    public static function deleteMod($id_mod)
    {
        // Sentencia DELETE
        $comando = "DELETE FROM modelos WHERE id_mod=?";

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(array($id_mod));
    }
}

?>