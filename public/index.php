<?php
use Slim\Factory\AppFactory;
use App\Controllers\AlunoController;
use Slim\App;

require __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

$app = AppFactory::create();

$app->addBodyParsingMiddleware();

$app->addErrorMiddleware(true, true, true);

//Listar todos os alunos
$app->get('/alunos', [AlunoController::class, 'listar']);

// Buscar um aluno por ID
$app->get('/alunos/{id}', [AlunoController::class, 'buscarPorId']);

// Cadastrar um novo aluno
$app->post('/alunos', [AlunoController::class, 'cadastrar']);

// Atualizar os dados de um aluno
$app->put('/alunos/{id}', [AlunoController::class, 'atualizar']);

// Deletar um aluno
$app->delete('/alunos/{id}', [AlunoController::class, 'deletar']);

$app->run();