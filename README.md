# laravel-docker-crud

Atividade para estudo de docker com Laravel.

## Objetivo

O objetivo desse projeto é criar um ambiente PHP com banco de dados Mysql que rode uma aplicação web desenvolvida em Laravel.
- [x]A aplicação consiste em um CRUD de produtos com as seguintes funcionalidades:
  - [x] Listagem de produtos cadastrados;
  - [x] Visualização de produto existente;
  - [x] Adição de novo produto, com possibilidade de upload de imagem do produto;
  - [x] Edição de produto existente;
  - [x] Exclusão de produto existente;

## Descrição do **[Docker compose](https://docs.docker.com/compose/)**

- [php-fpm](https://www.php.net/manual/en/install.fpm.php) v. `7.4`.
- servidor [nginx](https://www.nginx.com/) rodando nas portas **8000**.
- [mysql](https://www.mysql.com/) na porta **3306**.
- [phpmyadmin](https://www.phpmyadmin.net/) na porta **8080**.

### Diretórios do projeto
- **[src](https://github.com/LucasAmara1/laravel-docker-crud/tree/main/src)**: arquivos do projeto **Laravel (PHP)**.
  - **[docker-compose](https://github.com/LucasAmara1/laravel-docker-crud/tree/main/src/docker-compose)**: contém arquivos de configuração do **nginx** e configurações e persistência do **mysql**.

## Executando o projeto

### Pré-requisitos
* git
* docker
* docker-compose

### Executando o projeto

Clone o projeto:
```
git clone https://github.com/LucasAmara1/laravel-docker-crud.git
```

O arquivo `.env.example` possuem dados genéricos para configuração da aplicação. Faça uma copia do `.env.example` e renomeie para `.env`.

No arquivo **[docker-composer.yml](https://github.com/LucasAmara1/laravel-docker-crud/blob/main/src/docker-compose.yml)**,  altere em args, o `user`, de lucas para seu username do linux.

Vá até a raiz do diretório clonado:
```
cd src
```

Execute os contêineres do docker:
```
docker-compose up -d
```

Entre no contêiner do PHP:
```
docker exec -it laravel-docker-crud-app bash
```

Obs: O comando anterior te levará direto para o WORKDIR do contêiner: /var/www.

Dentro do contêiner, instale as dependências:
```
composer install
```

Gere o APP_KEY executando:
```
php artisan key:generate
```

Realize a migração do banco de dados e execute os seeds para criação dos usuários para testes e configurações necessárias:
```
php artisan migrate --seed
```
## Sobre o autor
> [Lucas Amaral](https://www.linkedin.com/in/lucas-amaral-727b1613a/)
> 
> [lucasamaralcc1@gmail.com](mailto:lucasamaralcc1@gmail.com)


