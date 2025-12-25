<?php
require_once "database.php";

class Habitat {
    private $id_habitat;
    private $nom;
    private $type_climate;
    private $description;
    private $zon_zoo;

    
    public function __construct($id = null, $nom = null, $climate = null, $description = null,$zone=null) {
        $this->id_habitat = $id;
        $this->nom = $nom;
        $this->type_climate = $climte;
        $this->description= $description;
        $this->zon_zoo=$zoo;
    }

    // getters
    public function getIdHabitat()
     { 
        return $this->id_habitat; 
    }
    public function getNom()
     { 
        
         return $this->nom; 
     }
    public function getTypeClimate() 
    { 
         return $this->type_climate; 
    }
    public function getDescription()
     { 
         return $this->description;
     }
    public function getZone()
      {
         return $this->zon_zoo;
      }
    // setters
    public function setIdHabitat($id_habitat)
     {
         $this->id_habitat = $id;
     }
    public function setNom($nom)
     {
         $this->nom = $nom; 
     }
    public function setTypeClimate()
    {
         $this->type_climate=$climate;
    }
    public function setDescription()
    {
         $this->description=$description;
    }

    }

?>
 