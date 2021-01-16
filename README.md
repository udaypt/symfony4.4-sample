# symfony4.4-sample

## Pre setup checks
Make sure port `8080` is not being used on the machine (If so, please change the port in `docker-compose.yml` or set `NGINX_PORT` on environment variable)
## Setup application
#### Run build
`docker-compose build`
#### Start application
`docker-compose up -d`
#### install composer packages
`docker-compose exec -u www-data fpm composer install`


### To use the application open a web browser and access this link http://localhost:8080

Note: Default username and password has been hard-coded on the login form.
