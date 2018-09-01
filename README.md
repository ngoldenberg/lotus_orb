Marmoles Travertino
===================

# Docker setup

#### Nginx
_This [repo](https://github.com/romeOz/docker-nginx-php)._


```
docker run --name app -d -p 8080:80 \
  -v /home/nik/Documents/projects/cantera_rincon/marmoles_travertino/html:/var/www/app/ \
  romeoz/docker-nginx-php:5.6
```

Got to `app.localhost:8080`.


#### Mysql

```bash
docker run --name mysql -d \
  -e 'MYSQL_PASS=admin' \
  -v /home/nik/Documents/projects/cantera_rincon/marmoles_travertino/data:/var/lib/mysql \
  romeoz/docker-mysql:5.6
```

```bash
docker run --name mysql -d \
  -e 'MYSQL_PASS=admin' \
  -v /home/nik/Documents/projects/cantera_rincon/marmoles_travertino/data:/var/lib/mysql \
  romeoz/docker-mysql
```

```bash
docker run --name mysql -d -p 8081:3306 \
    -v /my/own/datadir:/var/lib/mysql \
    -e MYSQL_ROOT_PASSWORD=admin \
    -e MYSQL_USER=nik \
    -e MYSQL_PASSWORD=watchmen420 \
    mysql:5.6
```
