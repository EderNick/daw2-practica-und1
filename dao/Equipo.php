<?php

namespace Dao;

use dao\Conexion;
use dto\Equipo as EquipoDTO;

use PDO;

class Equipo
{
    private $conexion;

    public function __construct()
    {
        $conexion = new Conexion();
        $this->conexion = $conexion->getConexion();
    }

    public function registrar(EquipoDTO $equipo)
    {
        $sql = "INSERT INTO equipos
                (codigo, nombre, categoria, estado)
                VALUES
                (:codigo, :nombre, :categoria, :estado)";

        $sentencia = $this->conexion->prepare($sql);

        return $sentencia->execute([
            ':codigo' => $equipo->getCodigo(),
            ':nombre' => $equipo->getNombre(),
            ':categoria' => $equipo->getCategoria(),
            ':estado' => $equipo->getEstado()
        ]);
    }

    public function listar()
    {
        $sql = "SELECT *
                FROM equipos
                ORDER BY id DESC";

        $sentencia = $this->conexion->prepare($sql);
        $sentencia->execute();

        return $sentencia->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscar($texto)
    {
        $sql = "SELECT *
                FROM equipos
                WHERE categoria LIKE :texto
                ORDER BY id DESC";

        $sentencia = $this->conexion->prepare($sql);

        $sentencia->execute([
            ':texto' => '%' . $texto . '%'
        ]);

        return $sentencia->fetchAll(PDO::FETCH_ASSOC);
    }

    public function cambiarEstado($id)
    {
        $sql = "UPDATE equipos
                SET estado =
                    CASE
                        WHEN estado = 'OPERATIVO' THEN 'BAJA'
                        ELSE 'OPERATIVO'
                    END
                WHERE id = :id";

        $sentencia = $this->conexion->prepare($sql);

        return $sentencia->execute([
            ':id' => $id
        ]);
    }
}
