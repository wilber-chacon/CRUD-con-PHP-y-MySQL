<?php
require_once '../connection/conexionDB.php';

include_once 'beans/personas.php';

class PersonaModel
{

    public function AgregarPersona($persona_){

        $persona = new Persona();
        $persona = $persona_;
        $first_name = $persona->getFirstName();
        $last_name = $persona->getLastName();
        $email = $persona->getEmail();
        $phone = $persona->getPhone();
        $birthdate = $persona->getBirthDate();
        $gender = $persona->getGender()->get_id_genero();
        $pais = $persona->getPais()->getIdPais();      
        $registrado = false;
        
        
        try {
            $conexion = new Conexion();

            $sql = "INSERT INTO personas VALUES (NULL,:n1,:n2,:n3,:n4,:n5,:n6,:n7)";

            $stmt = $conexion->conectar()->prepare($sql);
            $stmt->bindParam(':n1', $first_name, PDO::PARAM_STR);
            $stmt->bindParam(':n2', $last_name, PDO::PARAM_STR);
            $stmt->bindParam(':n3', $email, PDO::PARAM_STR);
            $stmt->bindParam(':n4', $phone, PDO::PARAM_STR);
            $stmt->bindParam(':n5', $birthdate, PDO::PARAM_STR);
            $stmt->bindParam(':n6', $pais, PDO::PARAM_STR);
            $stmt->bindParam(':n7', $gender, PDO::PARAM_STR);
            $registrado = $stmt->execute();
            $conexion->desconectar();

            return $registrado;
        } catch (PDOException $e) {
            $conexion->desconectar();
            return $e->getMessage();

        }

    }


    public function consultarRegistro($id)
    {  
        
        $result = null;
        $query = "SELECT * FROM personas as pe 
        JOIN paises as p 
        on pe.id_pais = p.id_pais 
        JOIN generos as g 
        on pe.id_genero = g.id_genero 
        WHERE pe.id = :n1";

        try {
            $con = new Conexion();
            $stmt = $con->conectar()->prepare($query);
            $stmt->bindParam(':n1', $id, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $con->desconectar();
            return $result;
        } catch (PDOException $e) {
            $con->desconectar();
            die("Error: " . $e->getMessage());
        }
        
    }



    public function ModificarPersona($persona_){

        $persona = new Persona();
        $persona = $persona_;
        $id = $persona->getIdPersona();
        $first_name = $persona->getFirstName();
        $last_name = $persona->getLastName();
        $email = $persona->getEmail();
        $phone = $persona->getPhone();
        $birthdate = $persona->getBirthDate();
        $gender = $persona->getGender()->get_id_genero();
        $pais = $persona->getPais()->getIdPais();      
        $result = false;
        
        
        try {
            $conexion = new Conexion();

            $sql = "UPDATE personas SET first_name = :n1, last_name = :n2, email = :n3, phone = :n4, birthdate = :n5, id_pais = :n6, id_genero = :n7 WHERE id = :n8";

            $stmt = $conexion->conectar()->prepare($sql);
            $stmt->bindParam(':n1', $first_name, PDO::PARAM_STR);
            $stmt->bindParam(':n2', $last_name, PDO::PARAM_STR);
            $stmt->bindParam(':n3', $email, PDO::PARAM_STR);
            $stmt->bindParam(':n4', $phone, PDO::PARAM_STR);
            $stmt->bindParam(':n5', $birthdate, PDO::PARAM_STR);
            $stmt->bindParam(':n6', $pais, PDO::PARAM_STR);
            $stmt->bindParam(':n7', $gender, PDO::PARAM_STR);
            $stmt->bindParam(':n8', $id, PDO::PARAM_STR);
            $result = $stmt->execute();
            $conexion->desconectar();

            return $result;
        } catch (PDOException $e) {
            $conexion->desconectar();
            return $e->getMessage();

        }

    }


    public function EliminarPersona($id)
    {  
        
        $result = null;
        $query = "DELETE FROM personas
        WHERE id = :n1";

        try {
            $con = new Conexion();
            $stmt = $con->conectar()->prepare($query);
            $stmt->bindParam(':n1', $id, PDO::PARAM_STR);
            $result = $stmt->execute();
            $con->desconectar();
            return $result;

        } catch (PDOException $e) {
            $con->desconectar();
            die("Error: " . $e->getMessage());
        }
        
    }

}
?>