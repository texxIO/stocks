DOCKER_COMPOSE := $(shell command -v docker-compose 2> /dev/null || echo "docker compose")

up:
	$(DOCKER_COMPOSE) up -d
.PHONY: up

down:
	$(DOCKER_COMPOSE) down
.PHONY: down

composer-install:
	$(DOCKER_COMPOSE) exec -u $(shell id -u):$(shell id -g) php composer install --dev
.PHONY: composer-install


generate-application-key:
	$(DOCKER_COMPOSE) -u $(shell id -u):$(shell id -g) php php artisan key:generate
.PHONY: generate-application-key

artisan-migrate:
	$(DOCKER_COMPOSE) exec -u $(shell id -u):$(shell id -g) php php artisan migrate
.PHONY: artisan-migrate

artisan-session-table:
	-$(DOCKER_COMPOSE) exec -u $(shell id -u):$(shell id -g) php php artisan session:table
.PHONY: artisan-session-table

artisan-queues-table:
	-$(DOCKER_COMPOSE) exec -u $(shell id -u):$(shell id -g) php php artisan queue:table
.PHONY: artisan-queues-table

artisan-schedule-work:
	$(DOCKER_COMPOSE) exec -u $(shell id -u):$(shell id -g) php php artisan schedule:work
.PHONY: artisan-schedule-work

artisan-seed-currencies:
	$(DOCKER_COMPOSE) exec -u $(shell id -u):$(shell id -g) php php artisan db:seed ForexCurrencySeeder
.PHONY: artisan-seed-currencies

artisan-queue-work:
	$(DOCKER_COMPOSE) exec -u $(shell id -u):$(shell id -g) php php artisan queue:work
.PHONY: artisan-queue-work

npm-install:
	$(DOCKER_COMPOSE) exec -u $(shell id -u):$(shell id -g) php npm install
.PHONY: npm-install

npm-run-dev:
	$(DOCKER_COMPOSE) exec -u $(shell id -u):$(shell id -g) php npm run dev
.PHONY: npm-run-dev

clean-volumes:
	docker volume ls -qf "name=.*stocks.*" | xargs -r docker volume rm
.PHONY: clean-volumes

clean-containers:
	docker ps -a --format '{{.Names}}' | grep 'stocks' | xargs -r docker rm -f
.PHONY: clean-containers

clean-images:
	docker-compose down --rmi all
.PHONY: clean-images

setup: composer-install artisan-migrate artisan-session-table artisan-queues-table artisan-seed-currencies npm-install
.PHONY: .setup