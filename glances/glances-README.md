# Server

## dockers

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
## archivo glances.conf (por partes)

> [aqui hay una plantilla del archivo de configuracion por defecto](https://raw.githubusercontent.com/nicolargo/glances/master/conf/glances.conf)

### folders
```
[folders]

# Documentation: https://glances.readthedocs.io/en/stable/aoa/folders.html
disable=False
# Define a folder list to monitor
# The list is composed of items (list_#nb <= 10)
# An item is defined by:
# * path: absolute path
# * careful: optional careful threshold (in MB)
# * warning: optional warning threshold (in MB)
# * critical: optional critical threshold (in MB)
# * refresh: interval in second between two refreshs
folder_1_path=/wordpress
folder_1_careful=5000
folder_1_warning=10000
folder_1_critical=20000
folder_1_refresh=60
# folder_2_path=/#
# folder_2_careful=5000
# folder_2_warning=10000
# folder_2_critical=20000
# folder_2_refresh=60
#folder_2_path=/home/nicolargo/Videos
#folder_2_warning=17000
#folder_2_critical=20000
#folder_3_path=/nonexisting
#folder_4_path=/root
```

# Rpi





> Written with [StackEdit](https://stackedit.io/).
<!--stackedit_data:
eyJoaXN0b3J5IjpbLTIwMzA3MDE5NjksOTI4Mjg1OTUzLDExMD
IxMzc2NjUsLTQxNDM0MjIxNl19
-->