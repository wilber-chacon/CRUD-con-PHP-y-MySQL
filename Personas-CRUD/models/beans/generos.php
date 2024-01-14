<?php 
class Genero{
    
    private $id_genero;
    private $nombre_genero;
        
    
    public function __construct() {
        $this->id_genero = "";
        $this->nombre_genero = "";
    }

    public function get_id_genero(){
        return $this->id_genero;
    }
    public function set_id_genero($id_genero){
        $this->id_genero = $id_genero;
    }
    public function get_nombre_genero(){
        return $this->nombre_genero;
    }
    public function set_nombre_genero($nombre_genero){
        $this->nombre_genero = $nombre_genero;
    }  

}
?>