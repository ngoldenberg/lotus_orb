Marmoles Travertino
===================

## Docker compose deploy



### Manual docker setup

#### Docker network
```bash
docker network create wordpress
```

#### Nginx
_This [repo](https://github.com/romeOz/docker-nginx-php)._


```
docker run --name app -d -p 8080:80 \
  -v /home/nik/Documents/projects/cantera_rincon/marmoles_travertino/html:/var/www/app/ \
  --net wordpress \
  romeoz/docker-nginx-php:5.6
```

Got to `app.localhost:8080`.


#### Mysql
```bash
docker run --name mysql -d -p 8081:3306 \
    -v /my/own/datadir:/var/lib/mysql \
    -e MYSQL_ROOT_PASSWORD=admin \
    -e MYSQL_USER=nik \
    -e MYSQL_PASSWORD=watchmen420 \
    --net wordpress \
    mysql:5.6
```
