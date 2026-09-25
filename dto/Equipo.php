<?php

namespace dto;

class Equipo
{
    private ?int $id;
    private string $codigo;
    private string $nombre;
    private string $categoria;
    private string $estado;

    public function __construct(
        string $codigo,
        string $nombre,
        string $categoria,
        string $estado = 'OPERATIVO',
        ?int $id = null
    ) {
        $this->id = $id;
        $this->codigo = $codigo;
        $this->nombre = $nombre;
        $this->categoria = $categoria;
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

    public function getCodigo(): string
    {
        return $this->codigo;
    }

    public function setCodigo(string $codigo): void
    {
        $this->codigo = $codigo;
    }

    public function getNombre(): string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): void
    {
        $this->nombre = $nombre;
    }

    public function getCategoria(): string
    {
        return $this->categoria;
    }

    public function setCategoria(string $categoria): void
    {
        $this->categoria = $categoria;
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
