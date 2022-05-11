Sirve para monitorizar tanto las raspis como el servidor.

Se va a utilizar siempre el mismo *docker-compose.yml*:

```
version: '2'
services:
  monitoring:
    image: nicolargo/glances:3.2.5-full
    container_name: glances-3.2.5
    restart: always
    pid: host
    volumes:
      - /home/guille:/home/guille:ro
      - /var/run/docker.sock:/var/run/docker.sock:ro
      - /home/guille/Software/glances/glances.conf:/glances/conf/glances.conf
      - /home/guille/Software/sftpgo_docker/home/data/:/sftpgo:ro
    environment:
      - GLANCES_OPT=-w
    ports:
      - 61208-61209:61208-61209
    hostname: Raspberry PI 4 de Guille

#Sin docker compose:
#
##docker run -d --name=glances --restart="always" -p 61208-61209:61208-61209 -e GLANCES_OPT="-w" -v /home/guille/Software/glances/glances.conf:/glances/conf/glances.conf -v /var/run/docker.sock:/var/run/docker.sock:ro --pid host nicolargo/glances:3.2.5-full
```
```
docker compose up -d --build
```
Lo que va a cambiar después es el *archivo de configuración* llamado **glances.conf**

# Server
## archivo glances.conf (por partes)
> [aqui hay una plantilla del archivo de configuracion por defecto](https://raw.githubusercontent.com/nicolargo/glances/master/conf/glances.conf)




# Rpi





> Written with [StackEdit](https://stackedit.io/).
<!--stackedit_data:
eyJoaXN0b3J5IjpbLTQxNDM0MjIxNl19
-->