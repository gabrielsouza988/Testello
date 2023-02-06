

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

# copiar arquivo de config do ngix
$ cp ./nginx/sites/laravel.conf.example ./laravel.conf

# instalar os containers docker
$ docker-compose up -d nginx postgres pgadmin workspace

# entre no container do workspace
$ docker-compose exec workspace bash

# instalar as depedencias do projeto
$ composer i

# copiar o arquivo do projeto .env.example para .env
$ cp .env.example ./.env

# gere uma chave para a sua aplicação
$ php artisan key:generate

# limpe o cache
$ php artisan optimize:clear

```

<p>Acesse o link:</p>
<a href="http://localhost:5050">http://localhost:5050</a>

<p>Dados de acesso padrão do pgadmin:</p>
email: pgadmin4@pgadmin.org
senha: admin

<h5>Crie o Banco de dados</h5>

<p>Dados de acesso padrão do postgres:</p>
usuario: postgres
senha: root

<h6>Abra novamente o terminal e execute os seguintes comandos.</h6>

```bash
# entre com no container do workspace
$ docker-compose exec workspace bash

# para contruir as tabelas e inserir dados
$ php artisan migrate:fresh --seed

```
<h6>lembre-se de verificar as credenciais de acesso ao banco de dados no arquivo .env</h6>

<h5>Inicie a Fila do queue</h5>
<h6>Com o terminal ainda aberto inicie o seguinte comando</h6>

```bash
# Este comando inicia a fila do queue, vc irar ter que mante-ló em andamento para funcionar as filas
$ php artisan queue:work

#Obs: verifique se esta dentro do container do workspace
# $ docker-compose exec workspace bash

```

<a href="#top">Voltar para o início</a>
