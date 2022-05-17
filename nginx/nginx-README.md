## 1 - Habilitar app passwords sin SSL 
 Edito **../wp-config.php** y añado la siguiente línea:
 ```add_filter( 'wp_is_application_passwords_available', '__return_true' );```
<br>

 >[source: How to use Application Passwords in WordPress for REST API Authentication](https://artisansweb.net/how-to-use-application-passwords-in-wordpress-for-rest-api-authentication/)
## 2 - Creo la app password
1. usuario > editar usuario > crear 

2. coger la contraseña y el user para ponerlos más tarde en el script


## 3 - Instalar Nginx
1. Instalo nginx y el modulo de php
``` 
 sudo apt-get install nginx php-fpm php-curl -y
```
2. Edito la siguiente configuracion y lo sustituyó por el de abajo 
```
 sudo vi /etc/nginx/sites-available/default
```
```
server {
  listen   80;
  root /usr/share/nginx/www;
  index index.php index.html index.htm;
  server_name example.com;
  location / {
    try_files $uri $uri/ /index.html;
  }
  error_page 404 /404.html;
  error_page 500 502 503 504 /50x.html;
  location = /50x.html {
    root /usr/share/nginx/www;
  }
  # pass the PHP scripts to FastCGI server listening on 127.0.0.1:9000
  location ~ \.php$ {
    try_files $uri =404;
    fastcgi_pass unix:/var/run/php/php7.4-fpm.sock;
    fastcgi_index index.php;
    fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
    include fastcgi_params;
  }
}
```
3. Después reinicio los servicios para que los cambios de conf. surgan efecto

```
 sudo service nginx restart
 sudo service php7.4-fpm restart
```

4. Por ultimo me encargo de subir el script al siguiente directorio
```
 sudo mkdir /usr/share/nginx/www
 sudo touch /usr/share/nginx/www/index.php
 sudo chmod -R a+w /usr/share/nginx/www/
```
De gratis
```
 sudo tail -n 5 /var/log/nginx/error.log
```


<br>


 >[source: How to Configure Nginx to Execute PHP Using PHP-FPM](https://www.thegeekstuff.com/2013/12/nginx-php-fpm/)
 
 ## 4 - Montar el script
El script en si es asi: 
```
<?php

	$file =  file_get_contents( 'imagenEjemplo.jpg' );
	$url =  'http://35.180.2.4:8080/wp-json/wp/v2/media/';
	$ch =  curl_init();
	$username =  'user';
	$password =  'passwordCopiadadeAntes';

	curl_setopt( $ch, CURLOPT_URL, $url );
	curl_setopt( $ch, CURLOPT_POST, 1 );
	curl_setopt( $ch, CURLOPT_POSTFIELDS, $file );
	curl_setopt( $ch, CURLOPT_HTTPHEADER, [
	'Content-Disposition: form-data; filename="imagenEjemplo.jpg"',
	'Authorization: Basic '  .  base64_encode( $username .  ':'  . $password ),
	] );

	$result =  curl_exec( $ch );
	curl_close( $ch );
	print_r( json_decode( $result ) );
```

Si lo ejecutaramos en un boton HTML sería algo tipo este ejemplo:

```
sudo vi /usr/share/nginx/www/index.php
```

```
<?php
  if (!empty($_GET['act'])) {
          echo "No has mandado una foto a la media library del wordpress!";
	$file = file_get_contents( 'test.jpg' );
	$url = 'http://35.180.2.4:8080/wp-json/wp/v2/media/';
	$ch = curl_init();
	$username = 'pdfc';
	$password = 'KVkZ Q48f ztIw hnOT EKvj nC01';

	curl_setopt( $ch, CURLOPT_URL, $url );
	curl_setopt( $ch, CURLOPT_POST, 1 );
	curl_setopt( $ch, CURLOPT_POSTFIELDS, $file );
	curl_setopt( $ch, CURLOPT_HTTPHEADER, [
	        'Content-Disposition: form-data; filename="test.jpg"', //este es el parametro importante
	        'Authorization: Basic ' . base64_encode( $username . ':' . $password ), //este tambien es un parametro importante
	] );
	$result = curl_exec( $ch );
	curl_close( $ch ) ;
	print_r( json_decode( $result ) ) ;
	  } else
?>

(.. your html ..)
<form action="index.php" method="get">
  <input type="hidden" name="act" value="run">
  <input type="submit" value="Run me now!">
</form>

<?php
?>
```
El próximo paso sería simplemente crear un index.php como lo comentado anteriormente e introducir  este código ahí.

<br>

> [source: Upload a file using the WordPress REST API](https://gist.github.com/ahmadawais/0ccb8a32ea795ffac4adfae84797c19a)
>>[source: A button to start php script, how?](https://stackoverflow.com/questions/1697484/a-button-to-start-php-script-how)


















<br><br><br><br><br> 
## x 

> Written with [StackEdit](https://stackedit.io/).
<!--stackedit_data:
eyJoaXN0b3J5IjpbMTYzOTgwMzQxMF19
-->
