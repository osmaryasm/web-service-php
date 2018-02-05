<?php

/**
 * Representa la estructura de las Marcas
 * almacenadas en la base de datos
 */
require 'Database.php';

class Marcas
{
    function __construct()
    {
    }

    /**
     * Retorna en la fila especificada de la tabla 'marcas'
     *
     * @param $id_mar Identificador del registro
     * @return array Datos del registro
     */
    public static function getAllMarcas()
    {
        $consulta = "SELECT * FROM marcas";
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
     * @param $id_mar Identificador de los marcas
     * @return mixed
     */
    public static function getMarcaById($id_mar)
    {
        // Consulta de la tabla marcas
        $consulta = "SELECT id_mar,
                            nom_mar
                             FROM marcas
                             WHERE id_mar = ?";

        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($id_mar));
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
     * @param $id_mar      identificador
     * @param $nom_mar      nuevo nombre
     
     */
    public static function updateMarca(
        $id_mar,
        $nom_mar
    )
    {
        // Creando consulta UPDATE
        $consulta = "UPDATE marcas" . " SET nom_mar=? " . "WHERE id_mar=?";

        // Preparar la sentencia
        $cmd = Database::getInstance()->getDb()->prepare($consulta);

        // Relacionar y ejecutar la sentencia
        $cmd->execute(array($nom_mar, $id_mar));

        return $cmd;
    }

    /**
     * Insertar una nueva marca
     *
     * @param $nom_mar      nombre del nuevo registro
     * @return PDOStatement
     */
    public static function insertMarca(
        $nom_mar
    )
    {
        // Sentencia INSERT
        $comando = "INSERT INTO marcas ( " . "nom_mar" . " )" . " VALUES( ?)";

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(
            array(
                $nom_mar
            )
        );

    }

    /**
     * Eliminar el registro con el identificador especificado
     *
     * @param $id_mar identificador de la tabla marcas
     * @return bool Respuesta de la eliminación
     */
    public static function deleteMarca($id_mar)
    {
        // Sentencia DELETE
        $comando = "DELETE FROM marcas WHERE id_mar=?";

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(array($id_mar));
    }
}

?>