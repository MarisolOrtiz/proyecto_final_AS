<?php
header('Content-type: application/json; charset=utf-8');
$json_string = json_encode(array("id" => 1,"nombre" => "Manuel Lopez"));
echo $json_string;
?>