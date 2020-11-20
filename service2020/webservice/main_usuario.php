<?php
  //require_once("connection_db.php");
class Mantenimiento{
    
    public static function guardar_Usuario($id, $nombre, $apellido, $correo, $usuario, $clave, $tipo, $estado, $pregunta, $respuesta){
        include("connection_db.php");
        $query = "INSERT INTO  tb_usuario (id, nombre, apellido, correo, usuario, clave, tipo, estado, pregunta, respuesta)
                                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        try{    
          $link=conexion();    
          $comando = $link->prepare($query);
          $comando->execute(array($id, $nombre, $apellido, $correo, $usuario, $clave, $tipo, $estado, $pregunta, $respuesta));
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
    
    
    
    
    public static function eliminar_Articulos($id){
      include("connection_db.php");
      $query = "delete from tb_usuario where id=?";
      try{
          $link=conexion();
          $comando=$link->prepare($query);
          $comando->execute(array($id));
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
  
  
  
  public static function actualizar_Articulos($id, $nombre, $apellido, $correo, $usuario, $clave, $tipo, $estado, $pregunta, $respuesta){
        include("connection_db_inventario.php");
        $query = "UPDATE tb_usuario" .
            " SET nombre=?, apellido=?, correo=?, usuario=?, clave=?, tipo=?, estado=?, pregunta=?, respuesta=?" .
            "WHERE id=?";

        try {    
          $link=conexion();    
          $comando = $link->prepare($query);
          $comando->execute(array($id, $nombre, $apellido, $correo, $usuario, $clave, $tipo, $estado, $pregunta, $respuesta));
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
    
    
    
    
    public static function getUsuarioId($id) {
        include("connection_db_inventario.php");
        $query = "SELECT nombre,apellido,correo,usuario,clave,tipo,estado,pregunta,respuesta, fecha_registro from tb_usuario where id = ?";
    try {    
          $link=conexion();    
          $comando = $link->prepare($query);
          $comando->execute(array($id));
          $row = $comando->fetch(PDO::FETCH_ASSOC);
          return $row;

        } catch (PDOException $e) {
            // Aqui puedes clasificar el error dependiendo de la excepcion
            // para presentarlo en la respuesta Json
            return -1;
        }
  }
  
  
  public static function getUsuarioDescripcion($desc) {
        include("connection_db1.php");
        $query = "SELECT nombre,apellido,correo,usuario,clave,tipo,estado,pregunta,respuesta,fecha_registro from tb_usuario where usuario = ?";
    try {    
          $link=conexion();    
          $comando = $link->prepare($query);
          $comando->execute(array($desc));
          $row = $comando->fetch(PDO::FETCH_ASSOC);
          return $row;

        } catch (PDOException $e) {
            // Aqui puedes clasificar el error dependiendo de la excepcion
            // para presentarlo en la respuesta Json
            return -1;
        }
  }
  
  
  
   public static function getAllUsuario() {
        include("connection_db_inventario.php");
        
        $query = "SELECT id,nombre,apellido,correo,usuario,clave,tipo,estado,pregunta,respuesta,fecha_registro FROM tb_usuario";

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
                                            
                     $array [] = array('id' => $result['id'], 'nombre' => $result['nombre'], 'apellido' => $result['apellido'], 'correo' => $result['correo'],
                                        'usuario' => $result['usuario'], 'clave' => $result['clave'], 'tipo' => $result['tipo'], 'estado' => $result['estado'],
                                        'pregunta' => $result['pregunta'], 'respuesta' => $result['respuesta'], 'fecha_registro' => $result['fecha_registro']);
                    
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
  
  
  
      //by Prof. Gamez.
}
?>