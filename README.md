# laravel-docker-crud

Atividade para estudo de docker com Laravel.
O objetivo desse projeto é criar um ambiente PHP com banco de dados Mysql que rode uma aplicação Laravel.

# Descrição do ambiente

O ambiente PHP criado a partir dos arquivos Dockerfile e docker-compose.yml, contêm as seguintes especificações:

- Dockerfile baseado na imagem php:7.4-fpm.

- docker-compose.yml com as configurações dos serviços abaixo:

1 - app, serviço que faz build da imagem php:7.4-fpm, e gera o container base da aplicação;

2 - db, serviço que gera o container mysql com base na imagem mysql:8;

3 - phpmyadmin, serviço que gera o container phpmyadmin com base na imagem phpmyadmin;

4 - nginx, serviço que roda um servidor para a aplicação. Através de um relacionamento de portas, poderemos acessar a porta 80 do container a partir da porta 8000 da máquina host.



