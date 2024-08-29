#!/bin/bash

cp .env.example .env

composer install

docker compose build --no-cache

docker compose up -d

sleep 3

docker compose exec php php bin/console doctrine:migrations:migrate --no-interaction

docker compose exec php php bin/console doctrine:fixtures:load --append --no-interaction
