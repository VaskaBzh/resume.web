ifeq ($(CI),true)
	TTY_FLAG=-T
else
	TTY_FLAG=
endif

APP=php
COMPOSE=docker-compose exec $(TTY_FLAG)
ARTISAN=$(COMPOSE) $(APP) php artisan

kill:
	docker kill $$(docker ps -a -q) || true
up: kill
	docker-compose up -d
down:
	docker-compose down
build: install composer npm key migrate front
install:
	cp .env.example .env || true
	docker-compose build
	docker-compose up -d
composer:
	$(COMPOSE) $(APP) composer install
key:
	$(ARTISAN) key:gen --ansi
npm:
	$(COMPOSE) $(APP) npm install
dev:
	$(COMPOSE) $(APP) npm run dev
front:
	$(COMPOSE) $(APP) npm run build
update:
	$(COMPOSE) $(APP) composer update
migrate:
	$(ARTISAN) migrate
seed:
	$(ARTISAN) db:seed
clear:
	$(COMPOSE) $(APP) composer cc
	$(COMPOSE) $(APP) npm cache clean --force
	$(ARTISAN) config:clear
	$(ARTISAN) cache:clear
	$(ARTISAN) route:clear
optimize:
	$(ARTISAN) optimize
tinker:
	$(ARTISAN) tinker
test:
	@if [ -z "$(name)" ]; then \
		$(ARTISAN) test --testdox --env=testing; \
	else \
		$(ARTISAN) test --filter=$(name) --testdox --env=testing; \
	fi
remote_test:
	ssh mainuser@92.205.188.112
docs:
	$(ARTISAN) l5-swagger:generate
lint-test:
	$(COMPOSE) $(APP) ./vendor/bin/pint --test
lint:
	$(COMPOSE) $(APP) ./vendor/bin/pint -v
analyze:
	$(COMPOSE) $(APP) ./vendor/bin/phpstan analyse --memory-limit=2G

# app commands
worker-hashes:
	$(ARTISAN) make:worker-hashes
sync-workers:
	$(ARTISAN) sync:worker
stats:
	$(ARTISAN) update:stats
income:
	$(ARTISAN) income
role:
	$(ARTISAN) give:role
percent:
	$(ARTISAN) set:percent
