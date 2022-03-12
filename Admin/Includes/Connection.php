<?php
$hostname="localhost";
$username="root";
$pw="";
$database="final_project";
$port=ini_get("mysqli.default_port");
$socket=ini_get("mysqli.default_socket");

$Conn= mysqli_connect($hostname,$username,$pw,$database,$port,$socket);
if(!$Conn){
    die('The Server Cannot Connect');
}

?>