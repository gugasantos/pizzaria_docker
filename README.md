# Pizzaria - Container/Docker

## Vision

This is a project thought to help a friend in his pizzeria and also to improve my programming knowledge

## How to use

If you want to run it locally (or in your own server), first you need to install
[docker](https://docs.docker.com/get-docker/) (even [docker-compose](https://docs.docker.com/compose/install/) it's also recommended).

You can have it all up and running in less than 10 minutes following this brief howto:
https://www.digitalocean.com/community/tutorials/how-to-install-docker-compose-on-debian-10

1. Clone this repository in your machine:

    ```bash
    git clone https://github.com/gugasantos/pizzaria_docker.git
    ```

2. create a copy of the .env:
    ```bash
    cp .env.example .env
    ```
3. Run the stack:
    ```bash
    docker-compose up -d
    ```

4. access the containe:

    ```bash
    docker-compose exec pizzaria bash
    ```
5. run composer install :

    ```bash
    composer install
    ```
6. create key:

    ```bash
    php artisan key:generate
    ```
7. run migration:

    ```bash
    php artisan migrate
    ```

8. Exit container and Access http://127.0.0.1:8000
