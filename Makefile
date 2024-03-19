PHP_SERVER_NAME=php_server
WEB_SERVER_NAME=nginx_server
REDIS_SERVER_NAME=redis_server
POSTGRES_SERVER_NAME=postgres_server
DOCKER_NETWORK_IP := $(shell docker network inspect bridge -f '{{range .IPAM.Config}}{{.Gateway}}{{end}}' 2>/dev/null)
XDEBUG_ROUTE_LOG := /var/www/html/logs/xdebug/xdebug.log

export CURRENT_UID := $(shell id -u):$(shell id -g)

# docker compose up --abort-on-container-exit

define execute_command
	docker container exec ${1} ${2}
endef

define execute_commands
	docker container exec ${1} sh -c ${2}
endef

run:
	docker compose start

stop:
	docker compose stop

status:
	docker compose ps

destroy:
	docker compose down --volumes --rmi local
	echo "y" | docker builder prune

install:
	@if grep "taller-symfony-local.es" /etc/hosts; then echo 'Ya existe taller-symfony-local.es en /etc/hosts'; else echo '$(DOCKER_NETWORK_IP) taller-symfony-local.es' | sudo tee -a /etc/hosts; fi
	docker compose up -d

status:
	docker compose ps

log:
	docker compose logs

provision: destroy install

ssh-php:
	docker container exec -it $(PHP_SERVER_NAME) sh

ssh-nginx:
	docker container exec -it $(WEB_SERVER_NAME) sh

ssh-redis:
	docker container exec -it $(REDIS_SERVER_NAME) redis-cli

ssh-postgres:
	docker container exec -it $(POSTGRES_SERVER_NAME) sh

clear-xdebug-log:
	$(call execute_command, $(PHP_SERVER_NAME), truncate -s 0 $(XDEBUG_ROUTE_LOG))

composer-install:
	$(call execute_command, $(PHP_SERVER_NAME), composer install)

composer-update:
	$(call execute_command, $(PHP_SERVER_NAME), composer update)

back-composer-clear-cache:
	$(call execute_command, $(PHP_SERVER_NAME), composer clear-cache)
