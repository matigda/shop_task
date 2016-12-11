shop
====

A simple Symfony project

Step by step after seting up containers:

```
docker exec -it docker_php_1 bas
```

```
php bin/console doctrine:database:create

```
 
```
php bin/console doctrine:migrations:migrate

```
 
```
php bin/console fos:elastica:populate

```
