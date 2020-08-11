start:
	docker-compose up -d
	docker-compose exec php composer install
	docker-compose exec php php bin/console doctrine:migrations:migrate
	docker-compose exec php php bin/console doctrine:fixtures:load

down:
	docker-compose down

restart:
	docker-compose exec php composer install
	docker-compose exec php bin/console doctrine:migrations:migrate first
	docker-compose down
	docker-compose up -d
	docker-compose exec php bin/console doctrine:migrations:migrate
	docker-compose exec php bin/console doctrine:fixtures:load

build:
	cp .env.example .env
	docker-compose up -d --build
	docker-compose exec php composer install
	docker-compose exec php php bin/console doctrine:migrations:migrate
