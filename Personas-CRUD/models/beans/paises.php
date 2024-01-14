<?php 
class Pais{
    
    private $id_pais;
    private $nombre_pais;
        
    
    public function __construct() {
        $this->id_pais = "";
        $this->nombre_pais = "";
    }
    
    public function getIdPais() {
        return $this->id_pais;
    }
    public function setIdPais($id_pais) {
        $this->id_pais = $id_pais;
    }
    public function getNomPais() {
        return $this->nombre_pais;
    }
     
    public function setNombrePais($nombre_pais) {
        $this->nombre_pais = $nombre_pais;
    }
}
?>