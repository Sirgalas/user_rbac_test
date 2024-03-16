SHELL = /bin/bash

docker_compose_bin := $(shell command -v docker-compose 2> /dev/null)
APP_CONTAINER_NAME := backend

.DEFAULT_GOAL := help

help: ## Show this help
	@awk 'BEGIN {FS = ":.*?## "} /^[a-zA-Z_-]+:.*?## / {printf "  \033[36m%-15s\033[0m %s\n", $$1, $$2}' $(MAKEFILE_LIST)

init: down build up composer-update migrate fixtures
install : build up composer-install migrate fixtures

up: ## Start all containers in background for developers
	$(docker_compose_bin) up --no-recreate -d

down: ## Stop all containers
	$(docker_compose_bin) down

build : ## Stop all containers
	$(docker_compose_bin) build

restart: ## Restart all containers
	$(docker_compose_bin) restart

shell: up ## Start shell in backend
	$(docker_compose_bin) exec "${APP_CONTAINER_NAME}" $(SHELL)

composer-install:
	docker-compose run --rm backend composer install

composer-update:
	docker-compose run --rm backend composer update

migrate:
	docker-compose run --rm backend php bin/console.php migrations:migrate

fixtures:
	docker-compose run --rm backend php bin/console.php fixtures:load