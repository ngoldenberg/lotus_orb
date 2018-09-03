Marmoles Travertino
===================
_Multi-site deployment._

## Instructions

#### Clone repos
```bash
./utils/clone-repos.sh
```

#### Create data directory 
_Can skip if you already have a data dir._
```bash
mkdir data
```

#### Set envs 
Check config files on `/config`. 

## Docker compose deploy

#### Run
```bash
docker-compose -p cr up -d
```

#### Stop
```bash
docker-compose -p cr stop
```

#### Remove
```bash
docker-compose -p cr rm
```

#### Stop & remove
```bash
docker-compose -p cr stop && \
    docker-compose -p cr rm -y
```

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

## Notes

#### Migrate site domain
Use [this](https://interconnectit.com/products/search-and-replace-for-wordpress-databases/) tool.

#### Thumbnails not displayed
**Error**: `wordpress 4.3 timthumb.php? permission denied`.

**Fix**: 
_Run inside app container_ 
```bash
chown -R www-data:www-data ./
chmod -R 755 ./
```

