# Getting started
## Clone this repository
```
git clone git@github.com:calvin-wjy/simple-verification-service.git
```

## Pre-requisites
- Setup .env in local machine
    - Copy .env.example and name it .env
    - Change `DB_CONNECTION` value to `pgsql`
    - Change `DB_PORT` value to `5432`
    - And set `DB_DATABASE`, `DB_USERNAME`, and `DB_PASSWORD` accordingly

- Setup postgreSQL database
  - Download docker on your machine
  - Execute ```docker run --name some-postgres -e POSTGRES_PASSWORD=<password> -d -p 5432:5432 postgres```
  - Replace `password` with password in .env (copy .env.example for reference) file
  - Execute ```docker exec -it some-postgres bash```
  - Once inside the container, execute ```psql -U postgres```
  - Create DB by executing, ```CREATE DATABASE <DB_DATABASE>``` (replace DB_DATABASE with value in .env file)

TODO: Add getting started
TODO: Add code coverage
TODO: Add roadmap
