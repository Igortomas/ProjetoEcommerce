Sistema feito para teste da empresa CEA.
Feito em laravel 8
PHP 7.4.29
Usando boostrap(Bem basico)
- Não fiz nenhum tratamento e validação no sistema.
- Cadastro de usuario e login.
- Listagem de produto, cadastro, edição e inativação do produto (Excluir).

Para inciar o projeto rode:

1º crie um banco de dados com nome de testecea.
2º Excute o comando para criar a tabelas:
php artisan php artisan migrate
3º Execute o comano para criar a seeders:
php artisan db:seed

O sistema possui um sistema de nivel de usuario, tendo 0 = Cliente (padrão), no qual voce poderá comprar os produtos e 1 = Admin, no qual voce poderar adicionar, alterar e inativar os produtos.

Dados do usuario admin:
    login: admin    
    senha: 123

Dados do usuario cliente(Padrão):
    login: cliente    
    senha: 123
obs: Todos os registros são padrão nivel = 0
