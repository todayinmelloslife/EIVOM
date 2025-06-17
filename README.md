# EIVOM

## Configuração de Banco de Dados

O arquivo `19_moviestar/db.php` utiliza variáveis de ambiente ou um arquivo `config.ini` para definir as informações de acesso ao banco de dados.

Defina as variáveis de ambiente abaixo antes de executar o projeto:

- `DB_NAME`
- `DB_HOST`
- `DB_USER`
- `DB_PASS`

Como alternativa, crie um arquivo `19_moviestar/config.ini` com o conteúdo:

```
DB_NAME=nome_do_banco
DB_HOST=localhost
DB_USER=usuario
DB_PASS=senha
```

O `config.ini` está listado no `.gitignore` e não deve ser versionado para que as credenciais permaneçam seguras.
