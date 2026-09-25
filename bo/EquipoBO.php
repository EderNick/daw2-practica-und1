<?php

namespace bo;

use dao\EquipoDAO;

class EquipoBO
{
    private EquipoDAO $equipoDAO;

    public function __construct()
    {
        $this->equipoDAO = new EquipoDAO();
    }

    // FUNCIONES PARA BO - VARIANTE C
    public function registrar($codigo, $nombre, $categoria)
    {
        return $this->equipoDAO->registrar($codigo, $nombre, $categoria);
    }

    public function listar()
    {
        return $this->equipoDAO->listar();
    }

    public function buscar($texto)
    {
        return $this->equipoDAO->buscar($texto);
    }

    public function cambiarEstado($id)
    {
        return $this->equipoDAO->cambiarEstado((int)$id);
    }
}
