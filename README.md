
# Teste para vaga de Analista Desenvolvedor PHP
## Informações Gerais
O projeto foi desenvolvido utilizando as seguintes tecnologias e metodologias:

 - PHP
 - HTML
 - Bootstrap
 - Javascript (com JQuery)
 - Padrão MVC
 - Phinx (biblioteca para gerenciamento de  *migrations*)
 - Composer (gerenciador de dependências)

## Pré-Requisitos
- **PHP** 7.x
- Banco de dados **MySQL**
- **Composer** (informações sobre como baixar e instalar [aqui](https://getcomposer.org/))

## Instruções de instalação:
 - Fazer fork do repositório
 - Editar o arquivo **/config/database.php** com as configurações do banco de dados da aplicação (o banco já deve existir)
 - A pasta-raiz padrão da aplicação é **teste-php**, caso  deseje modificar, altere o valor da constante `BASE_URL` no arquivo **config.php** na raiz do projeto
 - Rodar o script **install.php** na raiz do projeto.
	 - Esse script carrega as dependências do projeto, cria as tabelas no banco de dados e popula com informações fictícias.
	 - Ao fim da instalação você será redirecionado para a "home" da aplicação.

### Problemas com o script "install.php"?

Se o script de instalação **install.php** não estiver funcionando tente verificar o seguinte:

 - Verifique se a sua instalação do **Composer** foi feita de forma global, ou seja, você consegue rodar através do comando `composer` direto no seu console.
 - Verifique se o banco de dados informado no arquivo **/config/database.php** existe
 - Verifique as informações de banco de dados foram preenchidas no arquivo **/config/database.php** estão corretas

### Obrigado!

