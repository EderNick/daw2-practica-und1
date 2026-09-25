<?php

namespace dto;

class Prestamo
{
    private ?int $id;
    private string $estudiante;
    private string $equipo;
    private string $fecha;
    private string $estado;

    public function __construct(
        string $estudiante = "",
        string $equipo = "",
        string $fecha = "",
        string $estado = "PRESTADO",
        ?int $id = null
    ) {
        $this->id = $id;
        $this->estudiante = $estudiante;
        $this->equipo = $equipo;
        $this->fecha = $fecha;
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

    public function getEstudiante(): string
    {
        return $this->estudiante;
    }

    public function setEstudiante(string $estudiante): void
    {
        $this->estudiante = $estudiante;
    }

    public function getEquipo(): string
    {
        return $this->equipo;
    }

    public function setEquipo(string $equipo): void
    {
        $this->equipo = $equipo;
    }

    public function getFecha(): string
    {
        return $this->fecha;
    }

    public function setFecha(string $fecha): void
    {
        $this->fecha = $fecha;
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
