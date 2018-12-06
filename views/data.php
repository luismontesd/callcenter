<?php
session_start();
if ( !isset($_SESSION['data']) ) $_SESSION['data']=array();
$post = json_decode(file_get_contents('php://input'), true);
if ( isSet( $post["correo"] ) ) {
	array_push( $_SESSION['data'], array( "correo"=>$post["correo"], "password"=>$post["password"] ) );
	}
echo json_encode( $_SESSION['data'] );
?>