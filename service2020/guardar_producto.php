<?php
include('main_class.php');

if (isset($_POST['id_prod']) && ($_POST['nom_prob']) && ($_POST['des_prod']) && ($_POST['stock'])) {
    # code...
    $id_producto = $_POST['id_prod'];
    $nombre_producto = $_POST['nom_prod'];
    $descripcion_producto = $_POST['des_prod'];
    $stock_producto = $_POST['stock'];
    $precio_producto = $_POST['precio'];
    $unimedida_producto = $_POST['uni_medida'];
    $estado_producto = $_POST['estado_prob'];
    $categoria_producto = $_POST['categoria'];

    $resultado = Mantenimiento::guardar_producto($id_producto, $nombre_producto, $descripcion_producto, $stock_producto, $precio_producto, $unimedida_producto, $estado_producto, $categoria_producto);

    if ($resultado==1) {
        # code...
        header('Content-type: application/json; charset=utf-8');
        $json_string = json_decode(array("estado" => 1, "mensaje" => "Registro guardador correctamente."));
        echo $json_string;
    }else{
        header('Content-type: application/json; charset=utf-8');
        $json_string = json_decode(array("estado" => 2, "mensaje" => "Error. No se puede guardar..."));
        echo $json_string;
    }

}else{
    header('Content-type: application/json; charset=utf-8');
    $json_string = json_decode(array("estado" => 3, "mensaje" => "No se ha enviado toda la informacion"));
    echo $json_string; 
}



?>