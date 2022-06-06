# subir videos de hasta 2Gb con un curl a wordpress api rest v2

## script CURL en php
```
<?php

ini_set('memory_limit', '2000M'); //esto es lo que permite que el archivo sea grande, xq asi el script puede usar mas RAM para ejecutarse

$archivo = "/var/www/Digital_Signage/formulario/".$_GET["ruta"]; // Guardamos la ruta en la variable archivo
$username = 'gpda';   //usuario
$password = 'Pvry ZQ3N uypF 1AY6 876h yC8B'; // contraseña

$curl = curl_init(); //Inicia una nueva sesión del curl
$data = file_get_contents( $archivo );

curl_setopt_array($curl, array( // Dentro del curl_setopt se definen las opciones para nuestra sesión
  CURLOPT_URL => "http://10.124.133.1:8182/wp-json/wp/v2/media/", //Define la URL de la petición HTTP
  CURLOPT_RETURNTRANSFER => true, //Muestra el resultado del proceso (El contenido que devuelve la página se almacene en una variable)
  CURLOPT_ENCODING => "", //se enviarán todos los tipos de condificación soportados
  CURLOPT_MAXREDIRS => 10, //Número máximo de redirecciones HTTP a seguir.
  CURLOPT_TIMEOUT => 30, //Número máximo de segundos permitido para ejectuar funciones cURL
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1, // Versión HTTP
  CURLOPT_CUSTOMREQUEST => "POST", // Método de petición
  CURLOPT_HTTPHEADER => array( //Array de campos a configurar para el header HTTP
    'Authorization: Basic ' . base64_encode( $username . ':' . $password ),
    "cache-control: no-cache",
    'Content-Disposition: attachment; filename="'.basename($archivo).'"',
  ),
  CURLOPT_POSTFIELDS => $data,
));

//Redireccionamos a peticiones.php
header('Location: peticiones.php');

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "No se ha podido insertar en la galeria de medios de Wordpress!" . $err;
} else {
  echo "Exito se ha insertado en la galeria de medios de Wordpress!".  $response;
}


?>
```
Luego editamos wp-config.php (en este caso xq estamos en docker) o php.ini y añadimos las siguientes variables

```
###importante
@ini_set( 'upload_max_size' , '2000M' );
@ini_set( 'post_max_size', '2000M');
@ini_set( 'memory_limit', '2000M' );

define( 'WP_DEBUG', true ); #ns si esta funciona
define( 'WP_DEBUG_LOG', true ); #ns si esta funciona

define('WP_MEMORY_LIMIT', '2000M'); #ns si esta funciona
```
reiniciamos el docker, apache y php y ya deberia funcionar
