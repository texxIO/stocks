composer-install:
	docker compose exec -u $(shell id -u):$(shell id -g) php composer install --dev
.PHONY: composer-install


generate-application-key:
	docker compose exec -u $(shell id -u):$(shell id -g) php php artisan key:generate
.PHONY: composer-install

artisan-migrate:
	docker compose exec -u $(shell id -u):$(shell id -g) php php artisan migrate
.PHONY: artisan-migrate

artisan-session-table:
	docker compose exec -u $(shell id -u):$(shell id -g) php php artisan session:table
.PHONY: artisan-session-table

artisan-queues-table:
	docker compose exec -u $(shell id -u):$(shell id -g) php php artisan queue:table
.PHONY: artisan-queues-table

artisan-schedule-work:
	docker compose exec -u $(shell id -u):$(shell id -g) php php artisan schedule:work
.PHONY: artisan-schedule-work

artisan-seed-currencies:
	docker compose exec -u $(shell id -u):$(shell id -g) php php artisan db:seed ForexCurrencySeeder
.PHONY: artisan-seed-currencies

artisan-queue-work:
	docker compose exec -u $(shell id -u):$(shell id -g) php php artisan queue:work
.PHONY: artisan-queue-work

behat:
	docker compose exec -u $(shell id -u):$(shell id -g) php vendor/bin/behat
.PHONY: behat

clean-volumes:
	docker volume rm stocks_mysql_data stocks_redis_data
.PHONY: clean-volumes