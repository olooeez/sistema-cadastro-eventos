# sistema-cadastro-eventos

O Sistema de Cadastro de Eventos é um projeto desenvolvido em PHP, HTML, CSS, JavaScript, MySQL e Bootstrap. Ele tem como objetivo facilitar o gerenciamento e cadastro de eventos em uma aplicação web.

## Demo

![Demo de sistema-cadastro-eventos](https://raw.githubusercontent.com/olooeez/sistema-cadastro-eventos/main/docs/images/demo.png)

## Pré-requisitos

Certifique-se de que você possui os seguintes programas instalados em sua máquina:

1. **XAMPP**: O XAMPP é um pacote que contém o servidor web Apache, o banco de dados MySQL, o interpretador de linguagem de script PHP e outros componentes necessários para executar o projeto. Você pode baixar o XAMPP em [https://www.apachefriends.org/](https://www.apachefriends.org/) e siga as instruções de instalação adequadas para o seu sistema operacional.

2. **Composer**: O Composer é uma ferramenta de gerenciamento de dependências para o PHP. Você pode baixar e instalar o Composer em [https://getcomposer.org/](https://getcomposer.org/). Siga as instruções de instalação apropriadas para o seu sistema operacional.

## Instalação e desenvolvimento

### Passo 1: Clonar o repositório

Após instalar o XAMPP, acesse a pasta de instalação e localize a pasta "htdocs". Nesta pasta, você deve clonar o repositório do projeto usando o Git ou baixando o código-fonte como um arquivo ZIP e descompactando-o. Certifique-se de que o repositório fique em uma pasta chamada "sistema-cadastro-eventos" dentro da pasta "htdocs".

```
cd /caminho/para/o/xampp/htdocs
git clone https://github.com/olooeez/sistema-cadastro-eventos.git
```

Lembre-se também de dar permissão de escrita, leitura e execução na pasta "temp" do XAMPP para garantir o correto funcionamento do projeto.

### Passo 2: Instalar as dependências

Após clonar o repositório, navegue até o diretório do projeto e instale as dependências usando o Composer. As dependências serão especificadas no arquivo `composer.json`, e o comando `composer install` irá baixá-las e instalá-las automaticamente.

```
cd /caminho/para/o/xampp/htdocs/sistema-cadastro-eventos
composer install
```

### Passo 3: Configurar o banco de dados

Crie um banco de dados MySQL chamado 'SistemaCadastroEventosDB' em seu servidor local. Isso pode ser feito usando um cliente MySQL como o PhpMyAdmin ou a linha de comando.

Após criar o banco de dados, crie um arquivo chamado `.env` na raiz do projeto e preencha as informações do banco de dados nele, usando como base o arquivo `.env.sample` fornecido no projeto:

```ini
[MySQL]
database="SistemaCadastroEventosDB"
user="root"
password="root"
host="localhost:3306"
```

### Passo 4: Executar os scripts para criar tabelas e dados falsos

O projeto contém scripts que são responsáveis por criar as tabelas do banco de dados e preencher algumas informações iniciais (dados falsos ou seeds). Navegue até a pasta "scripts" e copie e cole no seu cliente MySQL como o PhpMyAdmin ou a linha de comando.

Após seguir esses passos, o projeto estará configurado e pronto para ser executado. Você pode acessá-lo no seu navegador usando a URL [http://localhost/sistema-cadastro-eventos](http://localhost/sistema-cadastro-eventos).

## Contribuindo

Se você deseja contribuir para este projeto, sinta-se à vontade para abrir um pull request. Todas as contribuições são bem-vindas!

## Licença

Este projeto está licenciado sob a [Licença MIT](https://github.com/olooeez/sistema-cadastro-eventos/blob/main/LICENSE). Consulte o arquivo LICENSE para obter mais detalhes.
