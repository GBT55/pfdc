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
folder_1_path=/wordpress
folder_1_careful=5000
folder_1_warning=10000
folder_1_critical=20000
folder_1_refresh=60
```
### ports
Aqui podemos poner los dispositivos que queremos monitorizar por SNMP, o por puerto si lo especificamos.

```
[ports]
disable=False
refresh=30
timeout=3

port_default_gateway=False

port_1_host=192.168.1.X
port_1_description=RPI 1 (Planta Baja)
port_1_timeout=1

port_2_host=192.168.1.X
port_2_description=RPI 1 (Planta 1)
port_2_timeout=1

port_4_host=192.168.1.150
port_4_description=RPI 1 (Planta 2)
port_4_timeout=1

port_5_host=192.168.1.82
port_5_description=RPI 1 (Planta 3)
port_5_timeout=10

port_6_host=192.168.1.82 
port_6_port=5900 
port_6_description=RPI 1 (Planta 3) - VNC Activado 
port_6_timeout=10

web_7_url=
web_7_description=aws maquina
web_7_rtt_warning=3000
```

### fs


```
[fs]
disable=False
hide=/boot.*,/snap.*,dev*,/wordpress-db,/wordpress-data,/etc/hosts,/wordpress-data,/glances/conf/glances.conf,_olv.conf,_hostname,.*olv.conf,.*hostname
careful=50
warning=70
critical=90
allow=overlay
```

### ports
```
[ports]
```

# Rpi





> Written with [StackEdit](https://stackedit.io/).
<!--stackedit_data:
eyJoaXN0b3J5IjpbMTkyMTg5NDkzNSwxMDk2MTg5MTA0LC04Mj
E1MjA2NjksLTIwMzA3MDE5NjksOTI4Mjg1OTUzLDExMDIxMzc2
NjUsLTQxNDM0MjIxNl19
-->