APP=php
COMPOSE=docker-compose exec
ARTISAN=$(COMPOSE) $(APP) php artisan

up: down
	docker-compose up -d
down:
	docker-compose down
build: install npm key
install:
	cp .env.example .env || true
	docker-compose build
	docker-compose up -d
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
rollback:
	$(ARTISAN) migrate:rollback
seed:
	$(ARTISAN) db:seed
optimize:
	$(ARTISAN) optimize
clear:
	$(ARTISAN) route:clear
	$(ARTISAN) cache:clear
	$(ARTISAN) config:clear
	$(ARTISAN) view:clear
tinker:
	$(ARTISAN) tinker
