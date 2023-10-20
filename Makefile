APP=php
COMPOSE=docker-compose exec
ARTISAN=$(COMPOSE) $(APP) php artisan

ifeq ($(CI),true)
	TTY_FLAG=-T
else
	TTY_FLAG=
endif

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
	$(COMPOSE) $(TTY_FLAG) $(APP) composer install
key:
	$(ARTISAN) $(TTY_FLAG) key:gen --ansi
npm:
	$(COMPOSE) $(TTY_FLAG) $(APP) npm install
dev:
	$(COMPOSE) $(APP) npm run dev
front:
	$(COMPOSE) $(TTY_FLAG) $(APP) npm run build
update:
	$(COMPOSE) $(APP) composer update
migrate:
	$(ARTISAN) $(TTY_FLAG) migrate
rollback:
	$(ARTISAN) $(TTY_FLAG) migrate:rollback
seed:
	$(ARTISAN) $(TTY_FLAG) db:seed
optimize:
	$(ARTISAN) optimize
clear:
	$(COMPOSE) $(APP) composer cc
	$(COMPOSE) $(APP) npm cache clean --force
	$(ARTISAN) optimize:clear
tinker:
	$(ARTISAN) tinker
test:
	$(ARTISAN) config:clear
	$(ARTISAN) $(TTY_FLAG) test --env=testing
remote_test:
	ssh mainuser@92.205.188.112
docs:
	$(ARTISAN) l5-swagger:generate

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
