<?php
include_once 'library/security/PayPhoneDecrypt.php';
include_once 'library/models/DataSend.php';
include_once 'library/Configuration.php';

$config = ConfigurationManager::Instance();
$config->ApiPath = 'http://localhost:8888/EncryptLibrary(Boton)/response.php';
$config->Token = 'e8ebFhgY6wsi5WlylLbt9ILQOZjrwiX2bsB5sP3i7HZMP2WvuGNSjm_3Eo74FEj2F9ALNjY2lg67CIj-YNe1ajSQvdUo21jmFNablClOxGEIXfY7IuBnVvQMCBnQQDB7at3JrsZ3zCN4trIGJgJ55-S_zfQZ0GVR7uiV6u7JKtHDWLr98-DoH0V0HtuHuKcO6qoxDsHP3ZIOTDjJXWBXlWiS101F7KyS3NI5R31qjgYLw5F-dbzI8R_xQltmTkThBSQsn0_GJc_a7Sc3ZGrtISDDaCeqW_tumJXYQoxcAKbBMAvjtmpINoIPAUzJ5NYbFezh9dfC6g1C39o3gpBUMc91WcewECdZaHnkxlnRe7bZ0ugNm0SX-fXmnx2QWU5SFPxiWq4tcPAweg-2IVVUWlNZ0CAVMk2Ip78lqI6wSsCerirdApNCWRLXGvzFO34yUZJpy3wSUlwGFmCWkyqoiQ';
$config->ApplicationId = 'a75f6c1b-85c0-4144-91d9-717a3d5f67c7';
$config->ApplicationPublicKey = '<RSAKeyValue><Modulus>uLaPjovIkHmdaobVXMoozWYRe5xeiSMT1CF2v2Pb4BwZzLiRBSzp7EO72Vt68SsIgGbrzTaO9jRMdoHQilWcB2EjYhRr7dSDdFjsArCLh8iwszq+dNdZBlncT5kFikHQey8mAePSUYmMMiKoS+6Uy4cDZjcowdIF+ZOCsMeq/1U=</Modulus><Exponent>AQAB</Exponent></RSAKeyValue>';
$config->PrivateKey = '<RSAKeyValue><Modulus>xStUDkihNv8cAEVjIGWvOth4BwgcfALU06O7B3m22fryqBtw+DU/lMLfbagR3JyyHhcKiKkQ+tmNRgy47Rk/2dFAwUmOP7I3jB45J+KkyPb8KKIybaf+tz46rKLS6U3wtcic9OwPQMwCfoMZf5GPSbCcIm/mJRA+dCetOAGndo0=</Modulus><Exponent>AQAB</Exponent><P>5Y9kfs1pZPpSvW3Dib9CBBBvNVJpc8ho3Pc4piACFnz41zO7+70NNoPnvp5CSBhaWA+0KyYcBRkezNmQiSU1eQ==</P><Q>2+DjEYmGWBcm8T4JruLBFXXHAlra483Efjms4+pvmT1D9CS5TQfAQ41JnmbJOon34d/lTyxrqnO5rXbVNzvotQ==</Q><DP>Jd5Iqq5B85ljqsH/nqqBPmBjp/0nTiVCPyk9HBJtpb4J4p4zJWzjUBnkUcqTjocN6Db29qM7vg+NyCcfs7ACqQ==</DP><DQ>LawH3oOveSrN9vxI7J/DNZ7ySIXww7LhJsr6I5l1tuHn9JWQO/TpNd7qNNHq6JLx/2QPcKOsdYp2PhbZ8RArpQ==</DQ><InverseQ>P/cJ8ihwk3KT3acJRhnuLbuztM2EfsjrpEJRBvD8cNu/GCS+m4PRrQTLejyWOqnVbTF9w/X6COaMfiq/tp5amA==</InverseQ><D>HM5Je8O/L+iCCAUbKBzLBssg8BAOj0yfmOMDHGK7JOodoRNPRCgNZ7e3yk7De0p2WGCP5KrkpO17TxhlPRiTBAc9c0cszlT30Lo0+eG8QXmrNXU8Cq7pcvm1UD3t7dHyzebcptQtuJ7oZNfTJaiXlMjlCKZuQFAj6qVfmgU42Ik=</D></RSAKeyValue>';



$privateKey = $config->PrivateKey;

$decrypt = new PayPhoneDecrypt($privateKey);

$response = new DataSend();
$response->IV = $_POST['IV'];
$response->SessionKey = $_POST['SessionKey'];
$response->XmlReq = $_POST['XmlReq'];

//Desencripta los datos que se reciben en la url de respuesta
$decryptedData = $decrypt->Execute($response);

echo 'Telefono: '.$decryptedData->PhoneNumber.'<br/>';
echo 'Menssaje: '.$decryptedData->Message.'<br/>';
echo 'Codigo: '.$decryptedData->AuthorizationCode.'<br/>';

?>