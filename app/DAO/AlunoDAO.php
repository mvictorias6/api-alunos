<?php

namespace App\DAO;

use App\Database\Conexao;
use App\Models\Aluno;
use PDO;

class AlunoDAO {
    private $conexao;

    public function __construct() {
        $this->conexao = Conexao::getConexao();

    }

    // Método para inserir um novo aluno no banco de dados
    public function inserir(Aluno $aluno) {
        $sql = "INSERT INTO alunos (nome, matricula, curso) VALUES (:nome, :matricula, :curso)";
        $stmt = $this->conexao->prepare($sql);

        $stmt->bindValue(':nome', $aluno->nome);
        $stmt->bindValue(':matricula', $aluno->matricula);
        $stmt->bindValue(':curso', $aluno->curso);

        $stmt->execute();

        return $this->conexao->lastInsertId(); // Retorna o ID gerado pelo banco para o novo aluno
    }

    // Método para listar todos os alunos do banco de dados
    public function listarTodos() {
        $sql = "SELECT * FROM alunos";
        $stmt = $this->conexao->query($sql);

        return $stmt->fetchAll();
    }

    // Método para buscar um aluno por ID
    public function buscarPorId($id) {
        $sql = "SELECT * FROM alunos WHERE id = :id";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();

        return $stmt->fetch();
    }

    // Método para atualizar os dados de um aluno
    public function atualizar(Aluno $aluno) {
        $sql = "UPDATE alunos SET nome = :nome, matricula = :matricula, curso = :curso WHERE id = :id";
        $stmt = $this->conexao->prepare($sql); 

        $stmt->bindValue(':nome', $aluno->nome);
        $stmt->bindValue(':matricula', $aluno->matricula);
        $stmt->bindValue(':curso', $aluno->curso);
        $stmt->bindValue(':id', $aluno->id);

        return $stmt->execute();
    }

    // Método para deletar um aluno 
    public function deletar($id) {
        $sql = "DELETE FROM alunos WHERE id = :id";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(':id', $id);
        
        return $stmt->execute();
    }
}