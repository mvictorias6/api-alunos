<?php
namespace App\Controllers;

use App\DAO\AlunoDAO;
use App\Models\Aluno;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class AlunoController {

    // Listar todos os alunos
    public function listar(Request $request, Response $response) {
        $dao = new AlunoDAO();
        $alunos = $dao->listarTodos();

        $response->getBody()->write(json_encode($alunos));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    }

    // Buscar um aluno por ID
    public function buscarPorId(Request $request, Response $response, array $args) {
        $id = $args['id'];
        $dao = new AlunoDAO();
        $aluno = $dao->buscarPorId($id);

        if (!$aluno) {
            $response->getBody()->write(json_encode(["mensagem" => "Aluno não encontrado"]));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(404);
        } 

        $response->getBody()->write(json_encode($aluno));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    }

    // Cadastrar um novo aluno
    public function cadastrar(Request $request, Response $response) {
        // Pega os dados enviados no corpo (body) da requisição POST
        $dados = $request->getParsedBody();

        if(empty($dados['nome']) || empty($dados['matricula']) || empty($dados['curso'])) {
            $response->getBody()->write(json_encode(["mensagem" => "Dados incompletos"]));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(400);
        }

        $aluno = new Aluno($dados['nome'], $dados['matricula'], $dados['curso']);

        $dao = new AlunoDAO();
        $id = $dao->inserir($aluno);

        $response->getBody()->write(json_encode(["mensagem" => "Aluno cadastrado com sucesso", "id" => $id]));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(201);
    }

    // Atualizar os dados de um aluno
   public function atualizar(Request $request, Response $response, array $args) {
    $id = $args['id'];
    $dados = $request->getParsedBody();

    $dao = new AlunoDAO();
    $alunoExistente = $dao->buscarPorId($id);

    if (!$alunoExistente) {
        $response->getBody()->write(json_encode(["mensagem" => "Aluno nao encontrado"]));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(404);
    }

    $aluno = new Aluno(
        $dados['nome'] ?? $alunoExistente['nome'], 
        $dados['matricula'] ?? $alunoExistente['matricula'], 
        $dados['curso'] ?? $alunoExistente['curso'],
        $id
    );
    
    $dao->atualizar($aluno);

    $response->getBody()->write(json_encode(["mensagem" => "Aluno atualizado com sucesso"]));
    return $response->withHeader('Content-Type', 'application/json')->withStatus(200);

    }

    // 5. Deletar um aluno
    public function deletar(Request $request, Response $response, array $args) {
        $id = $args['id']; // Resgata o ID enviado na URL
        
        $dao = new AlunoDAO();
        $alunoExistente = $dao->buscarPorId($id);
        
        // Verifica se o aluno realmente existe antes de tentar deletar
        if (!$alunoExistente) {
            $response->getBody()->write(json_encode(["mensagem" => "Aluno nao encontrado"]));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(404);
        }
        
        // Executa a exclusão no banco de dados
        $dao->deletar($id);
        
        $response->getBody()->write(json_encode(["mensagem" => "Aluno deletado com sucesso"]));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    }
}