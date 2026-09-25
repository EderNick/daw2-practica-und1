<?php

namespace dto;

class Prestamo
{
    private $id;
    private $estudiante;
    private $equipo;
    private $fecha;
    private $estado;

    public function __construct($id = null, $estudiante = "", $equipo = "", $fecha = "", $estado = "PRESTADO")
    {
        $this->id = $id;
        $this->estudiante = $estudiante;
        $this->equipo = $equipo;
        $this->fecha = $fecha;
        $this->estado = $estado;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getEstudiante()
    {
        return $this->estudiante;
    }

    public function getEquipo()
    {
        return $this->equipo;
    }

    public function getFecha()
    {
        return $this->fecha;
    }

    public function getEstado()
    {
        return $this->estado;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setEstudiante($estudiante)
    {
        $this->estudiante = $estudiante;
    }

    public function setEquipo($equipo)
    {
        $this->equipo = $equipo;
    }

    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }

    public function setEstado($estado)
    {
        $this->estado = $estado;
    }
}
