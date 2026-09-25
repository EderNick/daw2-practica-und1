<?php

namespace dto;

class Incidencia
{
    private ?int $id;
    private string $usuario;
    private string $asunto;
    private string $prioridad;
    private string $estado;

    public function __construct(
        ?int $id = null,
        string $usuario = '',
        string $asunto = '',
        string $prioridad = '',
        string $estado = 'PENDIENTE'
    ) {
        $this->id = $id;
        $this->usuario = $usuario;
        $this->asunto = $asunto;
        $this->prioridad = $prioridad;
        $this->estado = $estado;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getUsuario(): string
    {
        return $this->usuario;
    }

    public function setUsuario(string $usuario): void
    {
        $this->usuario = $usuario;
    }

    public function getAsunto(): string
    {
        return $this->asunto;
    }

    public function setAsunto(string $asunto): void
    {
        $this->asunto = $asunto;
    }

    public function getPrioridad(): string
    {
        return $this->prioridad;
    }

    public function setPrioridad(string $prioridad): void
    {
        $this->prioridad = $prioridad;
    }

    public function getEstado(): string
    {
        return $this->estado;
    }

    public function setEstado(string $estado): void
    {
        $this->estado = $estado;
    }
}
