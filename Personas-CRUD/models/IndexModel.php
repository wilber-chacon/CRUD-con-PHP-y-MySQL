<?php 
require_once '../connection/conexionDB.php';

class RegistroController{
    
    public function SelectRegistros()
    {
        try {
            $conexion = new Conexion();
            $conn = $conexion->conectar();
  
            $stmt = $conn->prepare('SELECT * FROM personas as pe 
            JOIN paises as p 
            on pe.id_pais = p.id_pais 
            JOIN generos as g 
            on pe.id_genero = g.id_genero;');
  
            $stmt->execute();
  
            $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);


  
            $conn = $conexion->desconectar();
  
            return $resultados;
  
        } catch (PDOException $e) {
            echo "Error al conectar a la base de datos: " . $e->getMessage();
            return null;
        }
    }



    public function SelectPaises()
    {
        try {
            $conexion = new Conexion();
            $conn = $conexion->conectar();
  
            $stmt = $conn->prepare('SELECT * FROM paises ORDER BY nombre_pais ASC');
  
            $stmt->execute();
  
            $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
  
            $conn = $conexion->desconectar();
  
            return $resultados;
  
        } catch (PDOException $e) {
            echo "Error al conectar a la base de datos: " . $e->getMessage();
            return null;
        }
    }

   
}
?>