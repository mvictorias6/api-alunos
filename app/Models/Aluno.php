<?php

namespace App\Models; 
class Aluno {
    public $id;
    public $nome;
    public $matricula;
    public $curso;

    public function __construct($nome = null, $matricula = null, $curso = null, $id = null) {
        $this->id = $id;
        $this->nome = $nome;
        $this->matricula = $matricula;
        $this->curso = $curso;
    }
}