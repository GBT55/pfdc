
# dockers 
instalador/script de docker

```
# curl -fsSL https://get.docker.com -o get-docker.sh
# chmod +x get-docker.sh
# ./get-docker.sh
```

 ## docker compose file
```
version: '3'

services:
    db:
        image: mariadb:10.3.9
        volumes:
            - data:/var/lib/mysql
        environment:
            - MYSQL_ROOT_PASSWORD=secret
            - MYSQL_DATABASE=wordpress
            - MYSQL_USER=manager
            - MYSQL_PASSWORD=secret
    web:
        image: wordpress:5.9
        depends_on:
            - db
        volumes:
            - ./carpetacontenedora:/var/www/html
        environment:
            - WORDPRESS_DB_USER=manager
            - WORDPRESS_DB_PASSWORD=secret
            - WORDPRESS_DB_HOST=db
        ports:
            - 8080:80

    pma:
        depends_on:
            - db
        image: phpmyadmin
     # container_name: phpmyadmin_web
        restart: always
        ports:
            - 9080:80
volumes:
    data:

```
Lo puedo levantar luego de dos maneras
```
# docker compose up -d --build
```
```
# docker swarm init
# docker stack deploy -c archivo.yml nombredelStack
```
Para consultar  los contenedores corriendo:
```
# docker service ls
# docker ps
```
 ## plugin foyer



> Written with [StackEdit](https://stackedit.io/).
