<?php

namespace bo;

use \dao\Incidencia as IncidenciaDAO;
use \dto\Incidencia as IncidenciaDTO;

class Incidencia
{
    private $dao;

    public function __construct()
    {
        $this->dao = new IncidenciaDAO();
    }

    // Funciones exactas solicitadas para la VARIANTE B
    public function registrar($usuario, $asunto, $prioridad)
    {
        if (empty($usuario) || empty($asunto) || empty($prioridad)) {
            throw new \InvalidArgumentException("Todos los campos son obligatorios.");
        }

        $dto = new IncidenciaDTO();
        $dto->setUsuario($usuario);
        $dto->setAsunto($asunto);
        $dto->setPrioridad($prioridad);
        $dto->setEstado("PENDIENTE"); // El registro inicial debe ser PENDIENTE

        return $this->dao->registrar($dto);
    }

    public function listar()
    {
        return $this->dao->listar();
    }

    public function buscar($texto)
    {
        if (empty(trim((string)$texto))) {
            return $this->listar();
        }
        return $this->dao->buscar($texto);
    }

    public function cambiarEstado($id)
    {
        if (empty($id)) {
            throw new \InvalidArgumentException("ID de incidencia no válido.");
        }
        return $this->dao->cambiarEstado($id);
    }
}