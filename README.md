Marmoles Travertino
===================
_Multi-site deployment._

## Instructions

1. Clone repos:
    ```bash
    ./utils/clone-repos.sh
    ```

2. Create data directory (_can skip if you already have a data dir_):
    ```bash
    mkdir data
    ```

3. Set envs: check config files on `/config`. 

5. Add extra containers.

6. Map containers on `nginx` conf.

7. Run containers:
    ```bash
    docker-compose -p cr up -d
    ```

## Docker compose deploy

#### Run
```bash
docker-compose -p cr up -d
```

#### Stop
```bash
docker-compose -p cr stop
```

#### Stop & remove
```bash
docker-compose -p cr down
```

## Manual docker setup

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

## Nginx configuration

#### Add new container to reverse proxy
Add to `config/nginx/conf`:
```smartyconfig
  server {
    listen {outside_port};
    server_name {outside_web_url};

    location / {
      proxy_pass http://{container}:{container_port};
    }
  }
```
_This must be added inside `http { }` closure.


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

