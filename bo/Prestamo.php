<?php

namespace bo;

use dao\Prestamo as PrestamoDAO;
use dto\Prestamo as PrestamoDTO;

class Prestamo
{
    private PrestamoDAO $dao;

    public function __construct()
    {
        $this->dao = new PrestamoDAO();
    }

    public function registrar($estudiante, $equipo, $fecha)
    {
        $prestamo = new PrestamoDTO($estudiante, $equipo, $fecha, "PRESTADO");

        return $this->dao->registrar($prestamo);
    }

    public function listar()
    {
        return $this->dao->listar();
    }

    public function buscar($texto)
    {
        return $this->dao->buscar($texto);
    }

    public function cambiarEstado($id)
    {
        return $this->dao->cambiarEstado((int) $id, "DEVUELTO");
    }
}
