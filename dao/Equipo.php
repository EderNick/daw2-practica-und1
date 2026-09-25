<?php

namespace dao;

use PDO;

class Equipo
{
    private $conexion;

    public function __construct()
    {
        $conexion = new Conexion();
        $this->conexion = $conexion->getConexion();
    }

    public function registrar($equipo)
    {
        $sql = "INSERT INTO equipos (codigo, nombre, categoria, estado) VALUES (:codigo, :nombre, :categoria, :estado)";
        $consulta = $this->conexion->prepare($sql);
        return $consulta->execute([
            'codigo' => $equipo->getCodigo(),
            'nombre' => $equipo->getNombre(),
            'categoria' => $equipo->getCategoria(),
            'estado' => $equipo->getEstado()
        ]);
    }

    public function listar()
    {
        $consulta = $this->conexion->prepare("SELECT * FROM equipos ORDER BY id");
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscar($texto)
    {
        $consulta = $this->conexion->prepare("SELECT * FROM equipos WHERE categoria LIKE :categoria ORDER BY id");
        $consulta->execute(['categoria' => '%' . $texto . '%']);
        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }

    public function cambiarEstado($id)
    {
        $consulta = $this->conexion->prepare("SELECT estado FROM equipos WHERE id = :id");
        $consulta->execute(['id' => $id]);
        $estado = $consulta->fetchColumn();

        if ($estado === false) {
            return false;
        }

        $nuevoEstado = $estado === 'OPERATIVO' ? 'BAJA' : 'OPERATIVO';
        $actualizar = $this->conexion->prepare("UPDATE equipos SET estado = :estado WHERE id = :id");
        return $actualizar->execute([
            'estado' => $nuevoEstado,
            'id' => $id
        ]);
    }
}
