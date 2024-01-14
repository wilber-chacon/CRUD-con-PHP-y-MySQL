<?php 
require_once 'generos.php'; 
require_once 'paises.php'; 
class Persona{
    
    private $id;
    private $first_name;
    private $last_name;
    private $email;
    private $phone;
    private $birthdate;
    private Genero $gender;
    private Pais $pais;
        
    
    public function __construct() {
        $this->id = "";
        $this->first_name = "";
        $this->last_name = "";
        $this->email = "";
        $this->phone = "";
        $this->birthdate = "";
        $this->gender = new Genero();
        $this->pais = new Pais();
    }
    
   
	
    public function getIdPersona() {
            return $this->id;
    }
    public function setIdPersona($id_) {
            $this->id = $id_;
    }
    public function getFirstName() {
        return $this->first_name;
    }
    public function setFirstName($first_name) {
        $this->first_name = $first_name;
    }
    public function getLastName() {
        return $this->last_name;
    }
    public function setLastName($last_name) {
        $this->last_name = $last_name;
    }

    public function getEmail() {
        return $this->email;
    }
    public function setEmail($email) {
        $this->email = $email;
    }
    public function getPhone() {
        return $this->phone;
    }
    public function setPhone($phone) {
        $this->phone = $phone;
    }
    public function getBirthDate() {
        return $this->birthdate;
    }
    public function setBirthDate($birthdate) {
        $this->birthdate = $birthdate;
    }
    public function getGender() {
        return $this->gender;

    }
    public function setGender($gender) {
        $this->gender = $gender;
    }
    public function getPais() {
        return $this->pais;
    }
    public function setPais($pais) {
        $this->pais = $pais;
    }

    
}
?>