<?php
$localhost = "localhost";
$username = "root";
$pswd = "";
$dbname = "barbearia";

$connection = mysqli_connect($localhost,$username,$pswd,$dbname);
/*
if($connection){
echo "Banco conectado";
}else{
die("Erro no banco".mysqli_connect_error());
}
*/

?>