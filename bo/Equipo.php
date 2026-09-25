<?php

namespace bo;

use dao\Equipo as EquipoDAO;
use dto\Equipo as EquipoDTO;

class Equipo
{
    private $dao;

    public function __construct()
    {
        $this->dao = new EquipoDAO();
    }

    public function registrar($codigo, $nombre, $categoria)
    {
        $equipo = new EquipoDTO($codigo, $nombre, $categoria);
        return $this->dao->registrar($equipo);
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
        return $this->dao->cambiarEstado($id);
    }
}
