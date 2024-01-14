<?php 
require_once '../connection/conexionDB.php';
class ModificacionModel{
    public function GetData()
    {
        try {
            $conexion = new Conexion();
            $conn = $conexion->conectar();

            $sql = 'SELECT * FROM datoscirugias d JOIN estado e ON d.IdEstado = e.IdEstado WHERE d.codigo ='.$_GET['id'];
            $stmt = $conn->prepare($sql);
  
            $stmt->execute();
  
            $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
  
            $conn = $conexion->desconectar();
  
            return $resultados;
  
        } catch (PDOException $e) {
            echo "Error al conectar a la base de datos: " . $e->getMessage();
            return null;
        }
    }
    public function Modificar($FechaRegistro,$Afiliacion,$Nombre, $Telefono, $Telefono2, $ProgramacionCX, $FechaCX, $Cirujano, $CirugiaProgramada, $Examenes, $EVMI, $EVAnestecia, $DatosEspec, $covid, $EnviadoGeneral, $estado, $Detalles,$codigo)
    {
        $registrado = false;
        try {
            $conexion = new Conexion();

    
            $sql = 'UPDATE datoscirugias SET FechaRegistro = :FechaRegistro, Afiliacion = :Afiliacion, Nombre = :Nombre, Telefono = :Telefono, Telefono2 = :Telefono2, ProgramacionCX = :ProgramacionCX,
            FechaCX = :FechaCX, Cirujano = :Cirujano, CirugiaProgramada = :CirugiaProgramada, Examenes = :Examenes, EVMI = :EVMI, EVAnestecia = :EVAnestecia,
            DatosEspecialidad = :DatosEspecialidad, PruebaCovid = :PruebaCovid, EnviadoGeneral = :EnviadoGeneral, IdEstado = :IdEstado,
            Detalles = :Detalles WHERE codigo = :codigo';
    
            $stmt = $conexion->conectar()->prepare($sql);
            $stmt->bindParam(':FechaRegistro', $FechaRegistro, PDO::PARAM_STR);
            $stmt->bindParam(':Afiliacion', $Afiliacion, PDO::PARAM_INT);
            $stmt->bindParam(':Nombre', $Nombre, PDO::PARAM_STR);
            $stmt->bindParam(':Telefono', $Telefono, PDO::PARAM_STR);
            $stmt->bindParam(':Telefono2', $Telefono2, PDO::PARAM_STR);
            $stmt->bindParam(':ProgramacionCX', $ProgramacionCX, PDO::PARAM_STR);
            $stmt->bindParam(':FechaCX', $FechaCX, PDO::PARAM_STR);
            $stmt->bindParam(':Cirujano', $Cirujano, PDO::PARAM_STR);
            $stmt->bindParam(':CirugiaProgramada', $CirugiaProgramada, PDO::PARAM_STR);
            $stmt->bindParam(':Examenes', $Examenes, PDO::PARAM_STR);
            $stmt->bindParam(':EVMI', $EVMI, PDO::PARAM_STR);
            $stmt->bindParam(':EVAnestecia', $EVAnestecia, PDO::PARAM_STR);
            $stmt->bindParam(':DatosEspecialidad', $DatosEspec, PDO::PARAM_STR);
            $stmt->bindParam(':PruebaCovid', $covid, PDO::PARAM_STR);
            $stmt->bindParam(':EnviadoGeneral', $EnviadoGeneral, PDO::PARAM_STR);
            $stmt->bindParam(':IdEstado', $estado, PDO::PARAM_INT);
            $stmt->bindParam(':Detalles', $Detalles, PDO::PARAM_STR);
            $stmt->bindParam(':codigo', $codigo, PDO::PARAM_INT);
            $registrado = $stmt->execute();
            $conexion->desconectar();
           
            return $registrado;
        } catch (PDOException $e) {
            $conexion->desconectar();
            return $e->getMessage();
        }
    }
}
