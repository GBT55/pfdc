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
### ports
Aqui podemos poner los dispositivos que queremos monitorizar por SNMP, o por puerto si lo especificamos.

```
[ports]

disable=False

# Interval in second between two scans

# Ports scanner plugin configuration

refresh=30

# Set the default timeout (in second) for a scan (can be overwritten in the scan list)

timeout=3

# If port_default_gateway is True, add the default gateway on top of the scan list

port_default_gateway=False

  

#

# Define the scan list (1 < x < 255)

# port_x_host (name or IP) is mandatory

# port_x_port (TCP port number) is optional (if not set, use ICMP)

# port_x_description is optional (if not set, define to host:port)

# port_x_timeout is optional and overwrite the default timeout value

# port_x_rtt_warning is optional and defines the warning threshold in ms

#

port_1_host=192.168.1.X

#port_1_port=80

port_1_description=RPI 1 (Planta Baja)

port_1_timeout=1

  

port_2_host=192.168.1.X

#port_1_port=80

port_2_description=RPI 1 (Planta 1)

port_2_timeout=1

  

port_4_host=192.168.1.150

#port_1_port=80

port_4_description=RPI 1 (Planta 2)

port_4_timeout=1

  

port_5_host=192.168.1.82

#port_2_port=80

port_5_description=RPI 1 (Planta 3)

port_5_timeout=10

port_6_host=192.168.1.82 
port_6_port=5900 
port_6_description=RPI 1 (Planta 3) - VNC Activado 
port_6_timeout=10

  

#port_2_host=www.free.fr

#port_2_description=My ISP

#port_3_host=www.google.com

#port_3_description=Internet ICMP

#port_3_rtt_warning=1000

#port_4_description=Internet Web

#port_4_host=www.google.com

#port_4_port=80

#port_4_rtt_warning=1000

#

# Define Web (URL) monitoring list (1 < x < 255)

# web_x_url is the URL to monitor (example: http://my.site.com/folder)

# web_x_description is optional (if not set, define to URL)

# web_x_timeout is optional and overwrite the default timeout value

# web_x_rtt_warning is optional and defines the warning respond time in ms (approximatively)

#

web_1_url=

web_1_description=aws maquina

web_1_rtt_warning=3000

#web_2_url=https://github.com

#web_3_url=http://www.google.fr

#web_3_description=Google Fr

#web_4_url=https://blog.nicolargo.com/nonexist

#web_4_description=Intranet

````

# Rpi





> Written with [StackEdit](https://stackedit.io/).
<!--stackedit_data:
eyJoaXN0b3J5IjpbLTgyMTUyMDY2OSwtMjAzMDcwMTk2OSw5Mj
gyODU5NTMsMTEwMjEzNzY2NSwtNDE0MzQyMjE2XX0=
-->