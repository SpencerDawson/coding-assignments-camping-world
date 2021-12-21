# Camping World

## Assignment

> I need you to build a webpage where I can import the attached CSV, and show the results in a table setting. We expect to be able to sort each column. The sort options should be ascending and descending. We also need an option to search the ‘table’ and show the results, relating to what we placed in the search field.

File provided: [cw_makebrands.csv](https://github.com/SpencerDawson/coding-assignments-camping-world/blob/main/cw_makebrands.csv)

## Tools

Docker is used to host a local env for the site, running PHP, PostgrSQL, and NGINX. The project is based on Symfony.

#### Images
- php:7.4-fpm-alpine (modified)
- postgres:14-alpine
- nginx:stable-alpine

## Start Up

```Shell
$ docker-compose up -d
```

Site should load at http://localhost:9080/

### Notice

Most ENV vars exist only within the docker environment, so running `composer require x` for certain symfony packages will fail.  

```shell
$ docker exec -it cw_php sh
```

## Regarding .env files

.env files are stored in this project, as a sample only. files with sensitive information should never be shared in a repository and should be kept either locally or stored in a docker secret.