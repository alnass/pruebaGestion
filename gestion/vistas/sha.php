<?php 

$usu_pass = 123456;
$usu_pass = hash("SHA256", $usu_pass);
echo $usu_pass;

 ?>