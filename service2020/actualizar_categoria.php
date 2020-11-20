<?php
include('main_class.php');

if (isset($_POST["id_cat"]) && ($_POST["nom_cat"]) && ($_POST["estado"])){
 	$id_categoria = $_POST['id_cat'];
 	$nom_categoria = $_POST['nom_cat'];
 	$estado_categoria = $_POST['estado'];

	$resultado = Mantenimiento::actualizar_Categoria($nom_categoria, $estado_categoria, $id_categoria,);
	
	if ($resultado==1) {
        header('Content-type: application/json; charset=utf-8');
        $json_string = json_encode(array("estado" => 1,"mensaje" => "Actualizacion aplicada correctamente."));
        echo $json_string;
        
        //$json_string = json_encode(array('estado' => '1','mensaje' => 'Actualizacion aplicada correctamente.'));
        //echo json_encode($json_string, JSON_UNESCAPED_UNICODE);
		
    } else {
        header('Content-type: application/json; charset=utf-8');
        $json_string = json_encode(array("estado" => 2,"mensaje" => "No se ha modificado ningun dato."));
		echo $json_string;
    }
    
    
}

?>