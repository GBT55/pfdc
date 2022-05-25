
# dockers 
instalador/script de docker

```
# curl -fsSL https://get.docker.com -o get-docker.sh
# chmod +x get-docker.sh
# ./get-docker.sh
```

 ## docker compose file
```


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
<!--stackedit_data:
eyJoaXN0b3J5IjpbLTk3NDQyMDEwNywtMTk3NDA4OTUxNF19
-->