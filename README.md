# EIVOM

EIVOM é uma aplicação de cadastro e avaliação de filmes construída em PHP. O projeto segue o padrão MVC com uso de objetos de acesso a dados (DAO) para isolar a lógica de persistência. Os usuários podem criar conta, adicionar filmes, realizar buscas e registrar avaliações.

## Requisitos

- PHP 7.4 ou superior com extensões PDO e GD habilitadas;
- Servidor web (Apache/Nginx ou o servidor embutido do PHP);
- MySQL ou MariaDB.

## Instalação

1. Clone este repositório em seu servidor:
   ```bash
   git clone <repo>
   ```
2. Crie um banco de dados chamado `moviestar` e ajuste as credenciais no arquivo `19_moviestar/db.php`.
3. Certifique‑se de que o diretório `19_moviestar/img/` possui permissão de escrita para upload das imagens.
4. Inicie o servidor web apontando para a pasta `19_moviestar`.

## Uso básico

1. Acesse `auth.php` para criar um usuário ou realizar login;
2. Após autenticado, utilize a página `newmovie.php` para adicionar um filme;
3. Os filmes cadastrados podem ser vistos na página inicial (`index.php`) ou buscados por título em `search.php`;
4. É possível escrever avaliações e editar o perfil do usuário nas respectivas telas.

## Estrutura de pastas

```
19_moviestar/
├── auth.php
├── auth_process.php
├── css/
├── dao/
│   ├── MovieDAO.php
│   ├── ReviewDAO.php
│   └── UserDAO.php
├── db.php
├── globals.php
├── index.php
├── models/
│   ├── Message.php
│   ├── Movie.php
│   ├── Review.php
│   └── User.php
├── templates/
│   ├── footer.php
│   ├── header.php
│   ├── movie_card.php
│   └── user_review.php
└── (demais scripts PHP)
```

## Padrão arquitetural

O projeto adota o modelo MVC, onde:

- **Models** (pasta `models/`) definem as entidades e regras de negócio;
- **Views** (pasta `templates/`) concentram o código de apresentação;
- **Controllers** são representados pelos scripts PHP que recebem requisições e utilizam os DAOs para acesso aos dados (pasta `dao/`).

Os objetos DAO abstraem as operações de banco de dados, permitindo que a lógica de persistência não fique acoplada às camadas de controle ou visualização.
