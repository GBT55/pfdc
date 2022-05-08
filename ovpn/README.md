# server
1.  pivpn: hay que instalar el servidor con este comando


```
curl -L https://install.pivpn.io | bash
```
2. Generamos el certificado sin contraseña:
```
pivpn -a nopass
```
3. pasamos el certificado con wormhole
```
wormhole send ovpns/*.ovpn
```

# rpi
1.  ovpn client cli
```
sudo su
```
```
apt install apt-transport-https
curl -fsSL https://swupdate.openvpn.net/repos/openvpn-repo-pkg-key.pub | gpg --dearmor > /etc/apt/trusted.gpg.d/openvpn-repo-pkg-keyring.gpg
curl -fsSL https://swupdate.openvpn.net/community/openvpn3/repos/openvpn3-bullseye.list >/etc/apt/sources.list.d/openvpn3.list
apt update
apt install openvpn3 -y
```
```
exit
```
2. probamos la conexión 

```
wormhole receive bar-foo
openvpn3 config-import --persistent --config *.ovpn
openvpn3 configs-list
openvpn3 session-start -persist-tun --config *.ovpn
openvpn3 sessions-list
```
<br>

> [source: OpenVPN3 documentation](https://community.openvpn.net/openvpn/wiki/OpenVPN3Linux/)

<br><br>

3. script para ovpn at startup

```
vi vpn_service.sh
sudo cp vpn_service.sh /usr/bin/vpn_service.sh
sudo chmod +x /usr/bin/vpn_service.sh
```
Creamos un *"unit file"* que define un servicio simple. El punto importante es **ExecStart**.
```
vi /lib/systemd/system/vpn_service.service
```
```
[Unit] 
Description=OPENVPN systemd service. 

[Service] 
Type=simple ExecStart=/bin/bash /usr/bin/vpn_service.sh 

[Install] 
WantedBy=multi-user.target
```
Una vez generado el archivo que define nuestro servicio simple, lo copiamos al directorio donde se ubican y desde el que se va a acceder a los servicios.
```
sudo cp vpn_service.service /etc/systemd/system/vpn_service.service
sudo chmod 644 /etc/systemd/system/vpn_service.service
```
Por último tenemos que probar que el servicio funciona de verdad
```
sudo systemctl start vpn_service ; sudo systemctl status vpn_service
sudo systemctl enable vpn_service
```

<br>

> [source: How to start a service at boot](https://www.linode.com/docs/guides/start-service-at-boot/)

<br><br><br><br><br>
> Written with [StackEdit](https://stackedit.io/).

