<?php
  //require_once("connection_db.php");
class Mantenimiento{
    
    public static function guardar_categoria($id_categoria, $nom_categoria, $estado_categoria){
        include("connection_db.php");
        $query = "INSERT INTO  tb_categoria (id_categoria, nom_categoria, estado_categoria)
                                VALUES (?, ?, ?)";
        try{    
          $link=conexion();    
          $comando = $link->prepare($query);
          $comando->execute(array($id_categoria, $nom_categoria, $estado_categoria));
          $count = $comando->rowCount();
        
          if($count > 0){
              return 1;
          }else{
              return 0;
          }
        } catch (PDOException $e) {
            return -1;
        }                        
    }
    
    
    
    
    public static function eliminar_Categoria($id_categoria){
      include("connection_db.php");
      $query = "DELETE from tb_categoria where id_categoria=?";
      try{
          $link=conexion();
          $comando=$link->prepare($query);
          $comando->execute(array($id_categoria));
          //return $comando;
          $count = $comando->rowCount(); 
          if($count>0){
              return 1;
          }else{
              return 0;   
          }
          
      }catch (PDOException $e){
          return -1;
      }
  }
  
  
  
  public static function actualizar_Categoria($nom_categoria, $estado_categoria, $id_categoria){
        include("connection_db.php");
        $query = "UPDATE tb_categoria SET nom_categoria=?, estado_categoria=? WHERE id_categoria=?";

        try {    
          $link=conexion();    
          $comando = $link->prepare($query);
          $comando->execute(array($nom_categoria, $estado_categoria, $id_categoria));
          //return $comando;
          $count = $comando->rowCount(); 
          if($count>0){
              return 1;
          }else{
              return 0;   
          }

        } catch (PDOException $e) {
            // Aqui puedes clasificar el error dependiendo de la excepcion
            // para presentarlo en la respuesta Json
            return -1;
        }
    }
    
    
    
    
    public static function getCategoriaId($id_categoria) {
        include("connection_db.php");
        $query = "SELECT id_categoria,nom_categoria,estado_categoria from tb_categoria where id_categoria = ?";
    try {    
          $link=conexion();    
          $comando = $link->prepare($query);
          $comando->execute(array($id_categoria));
          $row = $comando->fetch(PDO::FETCH_ASSOC);
          return $row;

        } catch (PDOException $e) {
            // Aqui puedes clasificar el error dependiendo de la excepcion
            // para presentarlo en la respuesta Json
            return -1;
        }
  }
  
  
  public static function getCategoriaNombre($nom_categoria) {
        include("connection_db.php");
        $query = "SELECT id_categoria,nom_categoria,estado_categoria from tb_categoria where nom_categoria = ?";
    try {    
          $link=conexion();    
          $comando = $link->prepare($query);
          $comando->execute(array($nom_categoria));
          $row = $comando->fetch(PDO::FETCH_ASSOC);
          return $row;

        } catch (PDOException $e) {
            // Aqui puedes clasificar el error dependiendo de la excepcion
            // para presentarlo en la respuesta Json
            return -1;
        }
  }
  
  
  
   public static function getAllCategoria() {
        include("connection_db.php");
        
        $query = "SELECT id_categoria,nom_categoria,estado_categoria FROM tb_categoria";

        try {
            $link=conexion();    
            $comando = $link->prepare($query);
            // Ejecutar sentencia preparada
            $comando->execute();
            
            $rows_array = array();
            while($result = $comando->fetch(PDO::FETCH_ASSOC))
                {
                    //$temp = array();
                    //$temp['codigo'] = $result['codigo'];
                    //$temp['descripcion'] = $result['descripcion'];
                    //$temp['precio'] = $result['precio'];
                                            
                     $array [] = array('id_categoria' => $result['id_categoria'], 'nom_categoria' => $result['nom_categoria'], 'estado_categoria' => $result['estado_categoria']);
                    
                    /*
                    $rows_array['codigo'] = $result['codigo'];
                    $rows_array['descripcion'] = $result['descripcion'];
                    $rows_array['precio'] = $result['precio'];
                    */
                }
                
                array_map("utf8_encode", $array);
  	            header('Content-type: application/json; charset=utf-8');
  	            return print_r(json_encode($array), JSON_UNESCAPED_UNICODE);
  	            
  	            
  	            //json_encode($datos, JSON_UNESCAPED_UNICODE);
                //return (var_dump($array));
                //return print_r($array);
        } catch (PDOException $e) {
            return false;
        }
        
    }

   
/****************Producto**************************************************************** */  
  
public static function guardar_producto($a, $b, $c, $d, $e, $f, $g, $h){
    include("connection_db.php");
    $query = "INSERT INTO  tb_producto (id_producto, nom_producto, des_producto, stock, precio, unidad_de_medida, estado_producto, categoria)
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    try{    
      $link=conexion();    
      $comando = $link->prepare($query);
      $comando->execute(array($a, $b, $c, $d, $e, $f, $g, $h));
      $count = $comando->rowCount();
    
      if($count > 0){
          return 1;
      }else{
          return 0;
      }
    } catch (PDOException $e) {
        return -1;
    }                        
}







/********************************* Usuario    ******************************************** */

public static function validarUsu($correo, $clave) {
    include("connection_db1.php");
    $query = "SELECT * from tb_usuario where correo = ? AND clave = ?";
try {    
      $link=conexion();    
      $comando = $link->prepare($query);
      $comando->execute(array($correo, $clave));
      $row = $comando->fetch(PDO::FETCH_ASSOC);
      return $row;

    } catch (PDOException $e) {
        // Aqui puedes clasificar el error dependiendo de la excepcion
        // para presentarlo en la respuesta Json
        return -1;
    }
}


  public static function getLogin($correo, $clave){
    include("connection_db.php");
    
    // Consulta de la tabla usuarios para verificar email existentes.
    $query = "SELECT * FROM tb_usuario WHERE correo = ? and clave = ?";
    try {    
          $link=conexion();    
          $comando = $link->prepare($query);
          $comando->execute(array($correo,MD5($clave)));
          $row = $comando->fetch(PDO::FETCH_ASSOC);
          return $row;

        } catch (PDOException $e) {
            // Aqui puedes clasificar el error dependiendo de la excepcion
            // para presentarlo en la respuesta Json
            return -1;
        }
        
    }
        


}