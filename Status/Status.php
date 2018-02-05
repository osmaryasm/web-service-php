<?php

/**
 * Representa la estructura de los status
 * almacenadas en la base de datos
 */
require 'Database.php';

class Status
{
    function __construct()
    {
    }

    /**
     * Retorna en la fila especificada de la tabla 'status'
     *
     * @param $id_stat Identificador del registro
     * @return array Datos del registro
     */
    public static function getAllStat()
    {
        $consulta = "SELECT * FROM status";
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
     * Obtiene los campos de un status con un identificador
     * determinado
     *
     * @param $id_stat Identificador de la ubicacion
     * @return mixed
     */
    public static function getStatById($id_stat)
    {
        // Consulta de la tabla status
        $consulta = "SELECT id_stat,
                            nom_stat
                             FROM status
                             WHERE id_stat = ?";

        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($id_stat));
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
     * @param $id_stat      identificador
     * @param $nom_stat      nuevo nombre
     
     */
    public static function updateStatus(
        $id_stat,
        $nom_stat
    )
    {
        // Creando consulta UPDATE
        $consulta = "UPDATE status" . " SET nom_stat=? " . "WHERE id_stat=?";

        // Preparar la sentencia
        $cmd = Database::getInstance()->getDb()->prepare($consulta);

        // Relacionar y ejecutar la sentencia
        $cmd->execute(array($nom_stat, $id_stat));

        return $cmd;
    }

    /**
     * Insertar un nuevo status
     *
     * @param $nom_stat      nombre del nuevo registro
     * @return PDOStatement
     */
    public static function insertStatus(
        $nom_stat
    )
    {
        // Sentencia INSERT
        $comando = "INSERT INTO status ( " . "nom_stat" . " )" . " VALUES( ?)";

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(
            array(
                $nom_stat
            )
        );

    }

    /**
     * Eliminar el registro con el identificador especificado
     *
     * @param $id_stat identificador de la tabla status
     * @return bool Respuesta de la eliminación
     */
    public static function deleteStatus($id_stat)
    {
        // Sentencia DELETE
        $comando = "DELETE FROM status WHERE id_stat=?";

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(array($id_stat));
    }
}

?>