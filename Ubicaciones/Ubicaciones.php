<?php

/**
 * Representa la estructura de las ubicaciones
 * almacenadas en la base de datos
 */
require 'Database.php';

class Ubicaciones
{
    function __construct()
    {
    }

    /**
     * Retorna en la fila especificada de la tabla 'ubicaciones'
     *
     * @param $id_ubi Identificador del registro
     * @return array Datos del registro
     */
    public static function getAllUbi()
    {
        $consulta = "SELECT * FROM ubicaciones";
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
     * Obtiene los campos de una ubicacion con un identificador
     * determinado
     *
     * @param $id_ubi Identificador de la ubicacion
     * @return mixed
     */
    public static function getUbiById($id_ubi)
    {
        // Consulta de la tabla ubicaciones
        $consulta = "SELECT id_ubi,
                            nom_ubi
                             FROM ubicaciones
                             WHERE id_ubi = ?";

        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($id_ubi));
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
     * @param $id_ubi      identificador
     * @param $nom_ubi      nuevo nombre
     
     */
    public static function updateUbi(
        $id_ubi,
        $nom_ubi
    )
    {
        // Creando consulta UPDATE
        $consulta = "UPDATE ubicaciones" . " SET nom_ubi=? " . "WHERE id_ubi=?";

        // Preparar la sentencia
        $cmd = Database::getInstance()->getDb()->prepare($consulta);

        // Relacionar y ejecutar la sentencia
        $cmd->execute(array($nom_ubi, $id_ubi));

        return $cmd;
    }

    /**
     * Insertar un nueva ubicacion
     *
     * @param $nom_ubi      nombre del nuevo registro
     * @return PDOStatement
     */
    public static function insertUbi(
        $nom_ubi
    )
    {
        // Sentencia INSERT
        $comando = "INSERT INTO ubicaciones ( " . "nom_ubi" . " )" . " VALUES( ?)";

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(
            array(
                $nom_ubi
            )
        );

    }

    /**
     * Eliminar el registro con el identificador especificado
     *
     * @param $id_ubi identificador de la tabla ubicaciones
     * @return bool Respuesta de la eliminación
     */
    public static function deleteUbi($id_ubi)
    {
        // Sentencia DELETE
        $comando = "DELETE FROM ubicaciones WHERE id_ubi=?";

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(array($id_ubi));
    }
}

?>