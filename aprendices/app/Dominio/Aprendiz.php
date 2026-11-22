<?php

namespace App\Dominio;

class Aprendiz
{
    public $nombre;
    public $programa;

    public function __construct($nombre, $programa)
    {
        $this->nombre = $nombre;
        $this->programa = $programa;
    }

    public function presentarse()
    {
        return "Soy el aprendiz " . $this->nombre . " del programa " . $this->programa;
    }
}