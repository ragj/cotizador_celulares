<?php
//$dsn = 'mysql:host=70.32.109.112;dbname=ampyplastp';
$dsn = 'mysql:host=localhost;dbname=cencel';
//$nombre_usuario = 'ampyplastp';
$nombre_usuario = 'adanzilla';
//$password = 'gPdrW2bGrvP2AEfMfj*';
$password = 'campanitas';
$opciones = array(
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
); 

$pdo = new PDO($dsn, $nombre_usuario, $password, $opciones);
?>