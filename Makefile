fresh:
	@make destroy
	@docker-compose build
	@docker-compose pull
	@make up

up:
	@docker-compose up -d

down:
	@docker-compose down --remove-orphans

destroy:
	@docker-compose down --remove-orphans --volumes