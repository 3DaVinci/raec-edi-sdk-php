DOCKER_PHP_EXEC = docker exec -ti raec-edi-sdk-php
COMPOSER        = $(EXEC_PHP) composer

app_bash:
	${DOCKER_PHP_EXEC} sh
php: app_bash

phpstan:
	${DOCKER_PHP_EXEC} vendor/bin/phpstan analyse src -c phpstan.dist.neon; \
 	${DOCKER_PHP_EXEC} vendor/bin/phpstan clear-result-cache

composer_validate:
	${COMPOSER} validate
