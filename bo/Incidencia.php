<?php

namespace bo;

use dao\Incidencia as IncidenciaDAO;
use dto\Incidencia as IncidenciaDTO;

class Incidencia
{
    private $dao;

    public function __construct()
    {
        $this->dao = new IncidenciaDAO();
    }

    public function registrar($usuario, $asunto, $prioridad)
    {
        $incidencia = new IncidenciaDTO("", $usuario, $asunto, $prioridad, "PENDIENTE");
        return $this->dao->registrar($incidencia);
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