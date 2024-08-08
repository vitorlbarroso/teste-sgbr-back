# Projeto Localizações - Teste Back-end SGBR

Esse projeto se trata de um teste para a vaga de desenvolvedor back-end na empresa sgbr.

## Links úteis
- [Documentação](https://apidog.com/apidoc/shared-9dfd031b-7226-41bd-b737-482a926aa854) - Documentação completa das rotas, respostas e parâmetros das requisições;
- [Contato WhatsApp](https://wa.me/+5527999971368) - Contato direto com o Vitor Barroso no Whatsapp.
- [Página pessoal](https://vitorlbarroso.tech/) - Página pessoal do Vitor Barroso, com mais informações para contato.

## Descrição
Este repositório contém um projeto Laravel 10 configurado para rodar em um ambiente Docker usando Nginx como servidor web e PostgreSQL 16 como banco de dados. Siga as instruções abaixo para configurar e executar o projeto localmente.
<br/>
<br/>
Esse projeto possui um CRUD voltado para o gerenciamento de localizações. Nele, você poderá criar novas localizações, com nome, slug (residencia-x), cidade e estado. Também será possível listar todos os endereços paginados, com a possibilidade de filtrar por nome e slug. Terá disponível, também, a possibilidade de buscar as informações de uma localização específica e atualizar uma localização.

## Pré-requisitos
Antes de começar, certifique-se de ter os seguintes softwares instalados em sua máquina:

- [Docker](https://www.docker.com/get-started) - Docker é uma plataforma para desenvolver, enviar e executar aplicativos em containers.
- [Docker Compose](https://docs.docker.com/compose/install) - Ferramenta para definir e executar aplicações multi-containers Docker.

## Configuração Inicial

### 1. Clonando o Repositório:
Clone este repositório para sua máquina local:

```bash
git clone https://github.com/vitorlbarroso/teste-sgbr-back
cd teste-sgbr-back
```

### 2. Criando o Arquivo `.env`:
Crie uma cópia do arquivo de exemplo .env:
```bash
cp .env.example .env
```
Abra o arquivo .env e configure as variáveis de ambiente para o banco de dados PostgreSQL. Use as seguintes configurações:
```bash
DB_CONNECTION=pgsql
DB_HOST=db
DB_PORT=5432
DB_DATABASE=nome_do_banco
DB_USERNAME=usuario_do_banco
DB_PASSWORD=senha_do_banco
```
### 3. Configurando as Dependências do Laravel
Certifique-se de ter o [Composer](https://getcomposer.org/) instalado em sua máquina para gerenciar as dependências do Laravel. No diretório raiz do projeto, execute:
```bash
composer install
```

### 4. Gerando a Chave da Aplicação
O Laravel requer uma chave de aplicação para encriptação de dados. Gere essa chave executando o comando:

```bash
php artisan key:generate
```

Este comando irá gerar uma chave única e configurá-la no arquivo .env.

## Configuração do Docker

### 1. Estrutura de Arquivos
Seu projeto deve conter os seguintes arquivos e diretórios para a configuração do Docker:

- `Dockerfile`
- `docker-compose.yml`
- `docker/nginx/default.conf`
- `docker/postgres/Dockerfile`

### 2. Subindo os Containers
Para iniciar os containers do Docker, navegue até o diretório raiz do projeto e execute:

```bash
docker-compose up -d
```

Esse comando vai construir as imagens e iniciar os containers em segundo plano. Os serviços incluídos são:
<br />

**App**: Container PHP-FPM rodando Laravel.

**Web**: Container Nginx servindo o frontend.

**DB**: Container PostgreSQL rodando o banco de dados.

### 3. Acessando a Aplicação
Depois que os containers estiverem em execução, você pode acessar a aplicação Laravel no navegador através do endereço:

```bash
http://localhost:8000
```

## 4. Migrando o Banco de Dados
Com os containers rodando, você precisa aplicar as migrações do banco de dados. Execute o comando abaixo

```bash
docker-compose exec app php artisan migrate
```

## Comandos Úteis

### Parar os Containers
Para parar todos os containers em execução, use:

```bash
docker-compose down
```

### Acessar o Container Laravel
Para acessar o shell do container Laravel, execute:

```bash
docker-compose exec app bash
```

### Rodar Comandos Artisan
Você pode rodar comandos Artisan diretamente no container Laravel:

```bash
docker-compose exec app php artisan <comando>
```

## Troubleshooting

### Erros de Permissão
Se você encontrar erros de permissão ao acessar o container ou ao tentar executar comandos, pode ser necessário ajustar as permissões das pastas storage e bootstrap/cache:

``` bash
sudo chown -R www-data:www-data storage bootstrap/cache
```

### Conflitos de Porta
Se a porta 8000 já estiver em uso, você pode alterá-la no arquivo docker-compose.yml:

```bash
web:
  ports:
    - "8000:80"
```

Altere o valor 8000 para outra porta disponível, por exemplo, 8080:80.
