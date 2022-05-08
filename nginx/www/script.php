<?php
  if (!empty($_GET['act'])) {
          echo "No has mandado una foto a la media library del wordpress!";
	$file = file_get_contents( 'test.jpg' );
	$url = 'http://192.168.1.53:8080/wp-json/wp/v2/media/';
	$ch = curl_init();
	$username = 'pdfc';
	$password = 'hb4n 4ArB Y3R8 K0p4 SaXB fskK';

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
<form action="script.php" method="get">
  <input type="hidden" name="act" value="run">
  <input type="submit" value="Run me now!">
</form>

<?php
?>
