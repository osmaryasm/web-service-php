<?php

/**
 * Representa la estructura de las condiciones
 * almacenadas en la base de datos
 */
require 'Database.php';

class Condiciones
{
    function __construct()
    {
    }

    /**
     * Retorna en la fila especificada de la tabla 'condiciones'
     *
     * @param $id_cond Identificador del registro
     * @return array Datos del registro
     */
    public static function getAllConds()
    {
        $consulta = "SELECT * FROM condiciones";
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
     * Obtiene los campos de una marca con un identificador
     * determinado
     *
     * @param $id_cond Identificador de los condiciones
     * @return mixed
     */
    public static function getCondById($id_cond)
    {
        // Consulta de la tabla condiciones
        $consulta = "SELECT id_cond,
                            nom_cond
                             FROM condiciones
                             WHERE id_cond = ?";

        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($id_cond));
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
     * @param $id_cond      identificador
     * @param $nom_cond      nuevo nombre
     
     */
    public static function updateCond(
        $id_cond,
        $nom_cond
    )
    {
        // Creando consulta UPDATE
        $consulta = "UPDATE condiciones" . " SET nom_cond=? " . "WHERE id_cond=?";

        // Preparar la sentencia
        $cmd = Database::getInstance()->getDb()->prepare($consulta);

        // Relacionar y ejecutar la sentencia
        $cmd->execute(array($nom_cond, $id_cond));

        return $cmd;
    }

    /**
     * Insertar una nueva marca
     *
     * @param $nom_cond      nombre del nuevo registro
     * @return PDOStatement
     */
    public static function insertCond(
        $nom_cond
    )
    {
        // Sentencia INSERT
        $comando = "INSERT INTO condiciones ( " . "nom_cond" . " )" . " VALUES( ?)";

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(
            array(
                $nom_cond
            )
        );

    }

    /**
     * Eliminar el registro con el identificador especificado
     *
     * @param $id_cond identificador de la tabla condiciones
     * @return bool Respuesta de la eliminación
     */
    public static function deleteCond($id_cond)
    {
        // Sentencia DELETE
        $comando = "DELETE FROM condiciones WHERE id_cond=?";

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(array($id_cond));
    }
}

?>