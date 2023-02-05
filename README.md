

<h1 align="center">Testello</h1>

<p align="center">
  <a href="#sobre">Sobre</a> &#xa0; | &#xa0; 
  <a href="#Tecnologias">Tecnologias</a> &#xa0; | &#xa0;
  <a href="#Requisitos">Requisitos</a> &#xa0; | &#xa0;
  <a href="#Iniciando">Iniciando</a> &#xa0; | &#xa0;
  <a href="https://github.com/gabrielsouza988" target="_blank">Autor</a>
</p>

<br>

## :sobre ##

Somos uma transportadora e prestamos serviço para N clientes. Cada um possui sua tabela de frete com reajuste periódico.

Portanto, quando chega a época do reajuste são realizados manualmente a alteração de cada um dos clientes gerando custos para a empresa por alocação de horas de trabalho.

Precisamos criar uma solução que permita subir um CSV com a respectiva tabela de frete de cada um dos Clientes (1 ou +) de maneira eficiente e que suporte uma grande quantidade de registros (Essas tabelas podem chegar a ter 300mil linhas).

Como podemos resolver esse problema? De que maneira conseguimos fazer o upload de 1 ou + CSV's sem que o HTTP dê timeout?

## :white_check_mark: Requisitos ##

Antes de começar :checkered_flag:, você precisa ter o [Git](https://git-scm.com), e o docker/Docker compose instalados na sua maquina.

## :Iniciando ##

```bash
# Clonar o repositorio
$ git clone https://github.com/gabrielsouza988/Testello.git

# Acessar onde o projeto foi instalado
$ cd Testello

#navegue até a pasta do laradock para instalar os containers docker
$ cd ./laradock

#copiar a .env.example do laradock
$ cp .env.example ./.env

# instalar os containers docker
$ docker-compose up -d nginx postgres pgadmin workspace

#logar como usuario do workspace
$ docker-compose exec workspace bash

#instalar as depedencias do projeto
$ composer i

# copiar o arquivo do projeto .env.example para .env
$ cp .env.example ./.env

# gere uma chave para a sua aplicação
$ php artisan key:generate

# limpe o cache
$ php artisan optimize:clear

```

<h5>Crie o Banco de dados</h5>

<p>Acesse o link:</p>
<a href="http://localhost:5050">http://localhost:5050</a>

```bash
# iniciar o nosso banco de dados


# Agora rode o seguinte codigo para construir o nosso BD
$ php artisan migrate:fresh --seed

# Depois você irar até a pasta que esta o nosso Front-end
$ cd ./front-end

#Instalar dependecias do Front
$ npm i

# Para iniciar o projeto você deve rodar os seguintes comandos
# Dentro do diretorio do front-end rode
$ npm run serve -- --port=3000

# Dentro do diretorio do Back-end
$ php artisan serve --port=4000 

# Agora inicie o seu banco de dados de sua preferencia
# So lembre de verificar as credenciais de acesso a ele no arquivo .env


# OBS: Caso queira mudar a porta do servidor da api do Back-end
# Tem uma const dentro do front-end chamada urlApi
# está no arquivo src/main.js
$ export const urlApi = 'http://127.0.0.1:SUAPORTA/api/';

```

<a href="#top">Voltar para o início</a>
