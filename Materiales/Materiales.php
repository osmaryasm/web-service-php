<?php

/**
 * Representa la estructura de los Materiales
 * almacenadas en la base de datos
 */
require 'Database.php';

class Materiales
{
    function __construct()
    {
    }

    /**
     * Retorna en la fila especificada de la tabla 'Materiales'
     *
     * @param $id_mat Identificador del registro
     * @return array Datos del registro
     */
    public static function getAllMat()
    {
        $consulta = "SELECT * FROM materiales";
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
     * Obtiene los campos de un material con un identificador
     * determinado
     *
     * @param $id_mat Identificador del material
     * @return mixed
     */
    public static function getMatById($id_mat)
    {
        // Consulta de la tabla materiales
        $consulta = "SELECT id_mat,
                            nom_mat
                             FROM materiales
                             WHERE id_mat = ?";

        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($id_mat));
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
     * @param $id_mat      identificador
     * @param $nom_mat      nuevo nombre
     
     */
    public static function updateMat(
        $id_mat,
        $nom_mat
    )
    {
        // Creando consulta UPDATE
        $consulta = "UPDATE materiales" . " SET nom_mat=? " . "WHERE id_mat=?";

        // Preparar la sentencia
        $cmd = Database::getInstance()->getDb()->prepare($consulta);

        // Relacionar y ejecutar la sentencia
        $cmd->execute(array($nom_mat, $id_mat));

        return $cmd;
    }

    /**
     * Insertar un nuevo Material
     *
     * @param $nom_mat      nombre del nuevo registro
     * @return PDOStatement
     */
    public static function insertMat(
        $nom_mat   
        )
    {
        // Sentencia INSERT
        $comando = "INSERT INTO materiales ( " . "nom_mat" . " )" . " VALUES( ?)";

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(
            array(
                $nom_mat
            )
        );

    }

    /**
     * Eliminar el registro con el identificador especificado
     *
     * @param $id_mat identificador de la tabla materiales
     * @return bool Respuesta de la eliminación
     */
    public static function deleteMat($id_mat)
    {
        // Sentencia DELETE
        $comando = "DELETE FROM materiales WHERE id_mat=?";

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(array($id_mat));
    }
}

?>