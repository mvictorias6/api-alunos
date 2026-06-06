# API RESTful de Gerenciamento de Alunos

Uma API RESTful para gerenciamento de alunos desenvolvida em PHP utilizando o **Slim Framework v4**. O projeto adota a arquitetura **MVC** combinada com o padrão **DAO** para persistência de dados no MySQL, além de aplicar práticas de tratamento de status codes HTTP.

---

## Tecnologias e Ferramentas Utilizadas

* **Linguagem:** PHP 8.x
* **Framework:** Slim Framework v4
* **Persistência:** PDO & MySQL
* **Gerenciador de Dependências:** Composer
* **Segurança:** Vlucas/Phpdotenv (Isolamento de credenciais em arquivo `.env`)
* **Arquitetura:** MVC + DAO
* **Testes:** Postman

---

## Estrutura do Projeto

```text
api-alunos/
├── app/
│   ├── Controllers/  
│   ├── DAO/          
│   ├── Database/     
│   └── Models/       
├── public/
│   └── index.php     
├── .env.example      
├── .gitignore       
└── composer.json    
