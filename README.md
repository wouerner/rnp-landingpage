# Projeto Drupal + Docker


## Pre-requisitos:
* Docker 18+
* docker-compose 1.22+

## Instalação

### 1. hosts
Linux: Adicionar ao arquivo `/etc/hosts` a linha `127.0.0.1 rsl-dev.vivoplataformadigital.com.br`

### 2. Certificados
adicionar na pasta do projetos os certificadados **certificate.crt** e **certificate.key** para dentro da pasta do projeto `docker/certs/`

### 3. Executar o projeto
```
cd docker/
```
```
docker-compose up
```

### 4. Enjoy

### Observações:
* O docker-compose vai criar uma pasta na raiz do projeto chamada "data" essa pasta vai conter os dados Postgres 9.5, ao apagar essa pasta teremos a perda dos dados do banco de dados.
* Dentro da pasta src/ tem todos os arquivos do Drupal (pois o projeto foi customizado além da pasta sites :( )
* Todos os **.sql** dentro da pasta `docker/docker-entrypoint-initdb.d` serão executados.