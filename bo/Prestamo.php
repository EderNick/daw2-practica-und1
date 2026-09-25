<?php

namespace bo;

use dao\Prestamo as PrestamoDAO;
use dto\Prestamo as PrestamoDTO;
use Exception;

class Prestamo
{
    private $dao;

    public function __construct()
    {
        $this->dao = new PrestamoDAO();
    }

    public function registrar($estudiante, $equipo, $fecha)
    {
        $estudiante = trim($estudiante);
        $equipo = trim($equipo);

        if ($estudiante === "" || $equipo === "" || $fecha === "") {
            throw new Exception("Complete estudiante, equipo y fecha.");
        }

        $prestamo = new PrestamoDTO(null, $estudiante, $equipo, $fecha, "PRESTADO");
        return $this->dao->registrar($prestamo);
    }

    public function listar()
    {
        return $this->dao->listar();
    }

    public function buscar($texto)
    {
        return $this->dao->buscar(trim($texto));
    }

    public function cambiarEstado($id)
    {
        return $this->dao->cambiarEstado($id, "DEVUELTO");
    }
}
