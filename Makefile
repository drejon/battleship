build:
	docker-compose build

run:
	@docker-compose build
	docker-compose run --rm battleship
