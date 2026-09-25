<?php

namespace bo;

use dao\Incidencia as IncidenciaDAO;
use dto\Incidencia as IncidenciaDTO;

class Incidencia
{
    private IncidenciaDAO $dao;

    public function __construct()
    {

        $this->dao = new IncidenciaDAO();
    }

    public function registrar(  string $usuario, 
                                string $asunto,
                                string $prioridad): bool
    {
        $usuario = trim($usuario);
        $asunto = trim($asunto);
        $prioridad = strtoupper(trim($prioridad));

        if ($usuario === '' || $asunto === '' || !in_array($prioridad, ['ALTA', 'MEDIA', 'BAJA'], true)) {
            return false;
        }

        $incidencia = new IncidenciaDTO(
            null,
            $usuario,
            $asunto,
            $prioridad,
            'PENDIENTE'
        );

        return $this->dao->registrar($incidencia);
    }

    public function listar(): array
    {
        return $this->dao->listar();
    }

    public function buscar(string $texto): array
    {
        $texto = trim($texto);

        if ($texto === '') {
            return $this->listar();
        }

        return $this->dao->buscar($texto);
    }

    public function cambiarEstado(int $id): bool
    {
        if ($id <= 0) {
            return false;
        }

        return $this->dao->cambiarEstado($id);
    }
}
