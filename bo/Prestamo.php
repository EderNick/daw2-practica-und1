<?php
namespace bo;

use \dao\Prestamo as PrestamoDAO;

class Prestamo {
    private $dao = null;

    public function __construct() {
        $this->dao = new PrestamoDAO();
    }

    public function registrar($estudiante, $equipo, $fecha) {
        try {
            return $this->dao->registrar($estudiante, $equipo, $fecha);
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
        return false;
    }

    public function listar(): array {
        try {
            return $this->dao->listar();
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
        return [];
    }

    public function buscar($texto): array{
        try {
            return $this->dao->buscar($texto);
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
        return [];
    }

    public function cambiarEstado($id) {
        try {
            return $this->dao->cambiarEstado($id);
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
        return false;
    }
}

