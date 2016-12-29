<?php 
include_once(__DIR__ . '/conxx.php' );

$resultado = new stdClass();

if( !empty( $_POST) ){

	$query = $pdo->prepare("INSERT INTO newsletter (email) VALUES (:email);");
	$query->bindParam( 'email', $_POST['email'] );

	if( $registro = $query->execute() ){
		$resultado->exito = true;
		$resultado->folio = $pdo->lastInsertId();
	}
	else 
	{
		$resultado->exito = false;
		$resultado->error = $pdo->errorInfo();
	}

	header('Content-type: text/json');
	echo json_encode($resultado); 
}

//var_dump($_POST);

?>