<?php
namespace dao;

use Exception;
use PDOException;

class Prestamo {
    private $conn = null;

    public function __construct() {
        try {
            $objConexion = new Conexion();
            $this->conn = $objConexion->getConexion();
        } catch (PDOException $e) {
            throw $e;
        }
    }

    public function registrar($estudiante, $equipo, $fecha) {
        if ($this->conn == null) {
            throw new Exception("Conexión vacía.");
        }

        try {
            $sql = "INSERT INTO prestamos (estudiante, equipo, fecha, estado) VALUES (?, ?, ?, 'PRESTADO')";
            $stmt = $this->conn->prepare($sql);
            return $stmt->execute([$estudiante, $equipo, $fecha]);
        } catch (PDOException $e) {
            throw $e;
        }
    }

    public function listar() {
        if ($this->conn == null) {
            throw new Exception("Conexión vacía.");
        }

        try {
            $stmt = $this->conn->prepare("SELECT * FROM prestamos ORDER BY id DESC");
            $stmt->setFetchMode(\PDO::FETCH_ASSOC);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            throw $e;
        }
    }

    public function buscar($texto) {
        if ($this->conn == null) {
            throw new Exception("Conexión vacía.");
        }

        try {
            $sql = "SELECT * FROM prestamos WHERE estudiante LIKE ? ORDER BY id DESC";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(["%" . $texto . "%"]);
            $stmt->setFetchMode(\PDO::FETCH_ASSOC);
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            throw $e;
        }
    }

    public function cambiarEstado($id) {
        if ($this->conn == null) {
            throw new Exception("Conexión vacía.");
        }
        try {
            $sql = "UPDATE prestamos SET estado = 'DEVUELTO' WHERE id = ?";
            $stmt = $this->conn->prepare($sql);
            return $stmt->execute([$id]);
        } catch (PDOException $e) {
            throw $e;
        }
    }
}