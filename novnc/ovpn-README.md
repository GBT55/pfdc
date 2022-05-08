
# Server Ubuntu

## wp

 1. docker compose
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

 2. Instalar plugin foyer


3. mariadb cheatsheet
-   mysql -u *username* -p

- SHOW DATABASES; USE <databasename>;

- SHOW tables; SELECT * FROM <databasetablename> DESCRIBE <databasetablename>;

	

## novnc

``` 
# sudo snap install novnc
# novnc --listen 6080 --vnc IPdelaRaspberry:5900
```
o, para que corra siempre: 

```
# sudo snap install novnc
# sudo snap set novnc services.n6080.listen=6080 services.n6080.vnc= IPdelaRaspberry:5900
# sudo snap get novnc services.n6080
```
> [source: GitHub: novnc/noVNC](https://github.com/novnc/noVNC)

## Vagrant

# MAQUINAS RPI
1 cambiar hostnames 
2 poner ip estática a cada una y preguntar si se puede asignar por dhcp por seguridad. Si no habra que utilizar la ip de cada interfaz del tunel vpn 
3 escribir un SCRIPT o utilizar vagrant para mandar los scripts e instalarlo en las 5 
4 server vnc, ssh, y archivo .ovpn 
5 docker: rpi-monitor, glances

<br><br><br><br>

> Written with [StackEdit](https://stackedit.io/).
<!--stackedit_data:
eyJoaXN0b3J5IjpbODM4NTkyNzE5XX0=
-->