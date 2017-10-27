<!DOCTYPE html>
<html>
  <head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
  </head>
  <body>
<?php
include_once 'library/security/PayPhoneDecrypt.php';
include_once 'library/models/DataSend.php';
include_once 'library/Configuration.php';

$config = ConfigurationManager::Instance();
$config->ApiPath = 'http://35.163.77.209/response';
$config->Token = 'o7fcqijsueWG4e6_iCeqK9ZT8M7g3NvyGdDADnr-3BGQhguJy6LG6iLe8d9S-LaKPKHBOx8wAXjBCKN1cL4fKZlRhT7ckOY_C1dGumZArSNDbFLfPwCgyMXBg9kbMgRE4QhPyta1W6eOTOSglv6_o204ao2P1KPMRgaKSgzAVI9yuX-vaPcbyD2IyMyBI1OC52kyqkMPcoXkZ-ilHAtgZDIAA0K6S86veYN-Pq7Cm4lEktBHyCeLCCADrxKjgzi75ajhlIs55Lu-xcJ4oW5LnhJcASvVaiNTnjhO4shCGqK_EbIvGloIRVUbXn2hA8-W2yqGrX52mKeniV3mz0NOf8SQ7kf97VpxK-dvqL1W1-M0KQwkqzt4AEE3EbS1iPsjAWnHK4Tdzg9rieqxe4spaSSkVIMsUyBFcKVqL-TkvblqM2C9qvllUkH8a-VCG_cppz18P-lrPIuZYISp_8EMlg';
$config->ApplicationPublicKey = '<RSAKeyValue><Modulus>tp+ciq7wLovm2HIk16OUCwp/nBsKZD30co/Sf3VDEtPvFQ/8ZBqm9joh70KEPbS5VZsIDRj1huwjN6zmqHt5JcT53+KxhMLKa7QAJn0zyTW7J8MmH0VlelL3OIlfM9YN4489j255UHb1J00D2uqzEE9DQxTNBv79PPSI3+AI5fc=</Modulus><Exponent>AQAB</Exponent></RSAKeyValue>';
$config->PrivateKey = '<RSAKeyValue><Modulus>rrtw1Cemk4x1Zph1ZdT2OijfljRm786eJCtn/Oy0q+K/9laBdEoPAzrlzJVeJiTNDGGIZZ8XJZCEwlBNESAwdbkxyrfC7pgg0JtiMBt798v7VvV3tmuoJFIfWrLDs3/W7xi/avaBOFeysgkHWIRZGG5Dlm9gkCn0iCiht+b6Sa0=</Modulus><Exponent>AQAB</Exponent><P>2fns4L/tLq4RTFuRESDUTUcGFfGFuE78wNjvzmb12OKNPP3cJab2z7ZyN5mLIZ8Xm8tu8EoscRT9GGyeN/qodw==</P><Q>zTZh+ZX7fYtC9fTNw9hQRClkC6KsigjprTV4w/p8j+I5eg6ydokbDaUhXAyE1x7NYw8qbBYflrJUfFT7UVYL+w==</Q><DP>n7iowE8iZvAZsM/vzpM1vaJrbSzbBSCryEut/JopT1FCmQyTgeuEMtPHgcI61toSnJBGrEBNrFbq1jjQ/sfnJQ==</DP><DQ>FDGCyJ2ipsL6btuNF/WESIDOMHrsgZTI8dtuK9LNSRdY0pL5qsJpIBmcw8MTm1uTmGjYotQ2fYzE1YtDQ8i02w==</DQ><InverseQ>XbZ/nKzE5lxDouAyJQDHlRICSuN4/OeXIqcexWVZXeMPR1dire+xAFahk7+ndJqiKlHxnDbgQMx8G0NpgPsNQw==</InverseQ><D>Az2fvJeVq9Plk4cNWlumS3LZnsAPDrCO103kylibizqT49473WvINn+fpnk4u01gbjPa40OdmslA5Re3LjOiImz5ERKMxJjY/MHsJi0AHSnPTNArPpbDkbpKpCr8l4d1g0E4n4SfT67iMcLskHtiYARXdqYlEZ5upz374KRNEmM=</D></RSAKeyValue>';


$privateKey = $config->PrivateKey;

$decrypt = new PayPhoneDecrypt($privateKey);

$response = new DataSend();
if( isset($_POST['IV']) && isset($_POST['SessionKey']) && isset($_POST['XmlReq']) )
{
$response->IV = $_POST['IV'];
$response->SessionKey = $_POST['SessionKey'];
$response->XmlReq = $_POST['XmlReq'];

//Desencripta los datos que se reciben en la url de respuesta
$decryptedData = $decrypt->Execute($response);

#echo 'Telefono: '.$decryptedData->PhoneNumber.'<br/>';
#echo 'Menssaje: '.$decryptedData->Message.'<br/>';
#echo 'Codigo: '.$decryptedData->AuthorizationCode.'<br/>';
echo '
<div class="row">
        <div class="col-lg-6 col-lg-offset-3 text-center">
                <div class="card text-center" style="width: 45rem; background-color: #fafafa; border-color: #333;">
                        <img class="card-img-top" src="images/logo_centro.png" alt="Card image cap">
                        <div class="card-block">
                                <div class="alert alert-success text-center">
                                <strong>Perfecto</strong>  Transacción exitosa.
                        </div>
                                <p class="card-text text-center">Estimado cliente su transacción fue completada con exito.</p>
				<p class="card-text text-center"> Mensaje: '.$decryptedData->Message.'.</p>
                                <p class="card-text text-center"> Codigo: '.$decryptedData->AuthorizationCode.'.</p>
                                <p class="card-text text-center"> Codigo: '.$decryptedData->PhoneNumber.'.</p>
                                <a href="http://35.163.77.209" class="btn btn-primary">Regresar</a>
                        </div>
                </div>
        </div>
</div>
';


}else{
echo '
<div class="row">
	<div class="col-lg-6 col-lg-offset-3 text-center">
 		<div class="card text-center" style="width: 45rem; background-color: #fafafa; border-color: #333;">
  			<img class="card-img-top" src="images/logo_centro.png" alt="Card image cap">
  			<div class="card-block">
    				<div class="alert alert-danger text-center">
      				<strong>Error!</strong>  Transacción Cancelada.
    			</div>    
    				<p class="card-text text-center">Estimado cliente su transacción no pudo ser completada.</p>
    				<a href="http://35.163.77.209" class="btn btn-primary">Regresar</a>
  			</div>
 		</div>
	</div>
</div>
';
}
?>
  </body>
</html> 
