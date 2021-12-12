FROM php:7.4-fpm-alpine

### Environment Vars
    ## Dependancies 
ENV DEPS_BUILD="curl php7-dev php7-pear libpq-dev postgresql-libs postgresql-dev"\
    DEPS="git bash libpq postgresql"\
    # PHP Extensions
    EXTENSIONS="opcache pgsql pdo pdo_pgsql"\
    ## Adding Composer to $PATH
    PATH=./vendor/bin:/composer/vendor/bin:$PATH\
    ## Add Composer vars
    COMPOSER_HOME=/composer\
    COMPOSER_ALLOW_SUPERUSER=1

### Install base packages and dependancies
RUN apk --no-cache --update --virtual .build-deps add ${PHPIZE_DEPS} ${DEPS_BUILD} &&\
    apk --no-cache --update add ${DEPS}
    ## Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
    ## Install Symfony
RUN curl -sS https://get.symfony.com/cli/installer | bash &&\
    mv /root/.symfony/bin/symfony /usr/local/bin/symfony

### Configure
    ## Generate default php.ini
RUN cp /usr/local/etc/php/php.ini-production /usr/local/etc/php/php.ini &&\
    ## Set local time
    ln -sf /usr/share/zoneinfo/US/Eastern /etc/localtime
    ## PHP Config
RUN pecl config-set php_ini /usr/local/etc/php/php.ini
    ## Configure extensions
RUN docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql &&\
    ## Install extensions
    docker-php-ext-install ${EXTENSIONS} &&\
    ## Enable extensions
    docker-php-ext-enable ${EXTENSIONS}
    ## Cleanup dev dependencies
RUN apk del -f .build-deps
    ## File Permissions
RUN chown -R www-data:www-data /var/www/html

### Setup working directory
WORKDIR /var/www/html
### Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]