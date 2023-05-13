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
  - Create DB by executing ```CREATE DATABASE <DB_DATABASE>``` (replace DB_DATABASE with value in .env file)
  - After DB is created, in terminal go to project's working directory and execute ```php artisan migrate```. If done correctly, terminal show the database and table being created.

## How to test
- Go to project's directory and run `php artisan serve`
- Verification API
  - Download Postman collection this [postman collection](https://github.com/calvin-wjy/simple-verification-service/blob/master/Verification%20API.postman_collection.json) and import it to Postman
  - Try to hit with different requests
  <img width="301" alt="Screen Shot 2023-05-13 at 15 28 52" src="https://github.com/calvin-wjy/simple-verification-service/assets/90295805/1277933f-73e4-40a3-b280-9166c356059f">
- Code Coverage
  - Run `./vendor/bin/pest --coverage`
  <img width="1594" alt="Screen Shot 2023-05-13 at 15 42 25" src="https://github.com/calvin-wjy/simple-verification-service/assets/90295805/2fdd6f3a-e22f-499d-a8bd-1bdd766b48dd">
- API Documentation
  - Can be accessed through `localhost:8000/api/documentation`
  <img width="1708" alt="Screen Shot 2023-05-13 at 15 49 15" src="https://github.com/calvin-wjy/simple-verification-service/assets/90295805/35bc04cb-a3aa-43ba-8b68-ca5af8fd1911">
