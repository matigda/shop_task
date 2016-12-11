#!/usr/bin/env bash

composer install -no --prefer-source

php bin/console ass:du

php bin/console rabbitmq:multiple-consumer product -w &

php-fpm
