<?php

namespace dto;

class Incidencia
{
    private $id;
    private $usuario;
    private $asunto;
    private $prioridad;
    private $estado;

    public function getId() { return $this->id; }
    public function setId($id) { $this->id = $id; }

    public function getUsuario() { return $this->usuario; }
    public function setUsuario($usuario) { $this->usuario = $usuario; }

    public function getAsunto() { return $this->asunto; }
    public function setAsunto($asunto) { $this->asunto = $asunto; }

    public function getPrioridad() { return $this->prioridad; }
    public function setPrioridad($prioridad) { $this->prioridad = $prioridad; }

    public function getEstado() { return $this->estado; }
    public function setEstado($estado) { $this->estado = $estado; }
}