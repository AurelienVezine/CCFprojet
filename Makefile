.PHONY: deploy install

deploy:
    ssh 'cd sites/arcadia.myprojet.fr && git pull origin main && make install'

install: vendor/autoload.php
    /opt/php8.2/bin/php bin/console d:m:m -n
    /opt/php8.2/bin/composer dump-env prod
    /opt/php8.2/bin/php bin/console cache:clear

vendor/autoload.php: composer.json composer.lock
    /opt/php8.2/bin/composer install --no-dev --optimize-autoloader
    touch vendor/autoload.php