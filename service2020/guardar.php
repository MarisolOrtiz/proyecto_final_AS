<?php
include('main_class.php');
//require 'main_class.php';
$codigo = $_POST['codigo'];
$descripcion = htmlspecialchars($_POST["descripcion"],ENT_QUOTES);
$precio = htmlspecialchars($_POST["precio"],ENT_QUOTES);
if (($codigo!="") and
    ($descripcion!="") and 
    ($precio!="")) {
     	
    $resultado = Mantenimiento::guardar_Articulos($codigo, $descripcion, $precio);

	if ($resultado==1) {
        header('Content-type: application/json; charset=utf-8');
        $json_string = json_encode(array("estado" => 1,"mensaje" => "Registro guardado correctamente."));
        echo $json_string;
        //echo "Registro guardado...";
    } else {
        header('Content-type: application/json; charset=utf-8');
        $json_string = json_encode(array("estado" => 2,"mensaje" => "No se ha guardado nada."));
		echo $json_string;
    }
}
?>