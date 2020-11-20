<?php

    class manto_Users{
        
        
    public static function getLogin($email, $clave){
    include("connection_db.php");
    
    // Consulta de la tabla usuarios para verificar email existentes.
    $query = "SELECT * FROM tb_usuario WHERE correo = ? and clave = ?";
    try {    
          $link=conexion();    
          $comando = $link->prepare($query);
          $comando->execute(array($email,MD5($clave)));
          $row = $comando->fetch(PDO::FETCH_ASSOC);
          return $row;

        } catch (PDOException $e) {
            // Aqui puedes clasificar el error dependiendo de la excepcion
            // para presentarlo en la respuesta Json
            return -1;
        }
        
    }
        
        
        
    }


?>