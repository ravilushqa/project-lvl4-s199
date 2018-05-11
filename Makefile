install:
	composer install

lint:
	composer run-script phpcs -- --standard=PSR2  app routes tests

lint-fix:
	composer run-script phpcbf -- --standard=PSR2 app routes tests

test:
	composer run-script phpunit tests