 <?php
require_once "database.php";

class Animal {
    private $id_animal;
    private $nom;
    private $espece;
    private $alimentation;
    private $image;
    private $pays_origine;
    private $description;
    private $id_habitat;  

public function __construct($id = null, $nom = null, $espece = null, $alimentation = null, 
                          $image = null, $pays_origine = null, $description = null, $id_habitat = null) {
    $this->id_animal = $id;
    $this->nom = $nom;
    $this->espece = $espece;
    $this->alimentation = $alimentation;
    $this->image = $image;
    $this->pays_origine = $pays_origine;
    $this->description = $description;
    $this->id_habitat = $id_habitat;
}

// getters
public function getId()
 { 
    return $this->id_animal;
 }
public function getNom()
 { 
    return $this->nom;
 }
public function getEspece()
 { 
    return $this->espece;
 }
public function getAlimentation()
 { 
    return $this->alimentation; 
}
public function getImage()
 { return $this->image; 
}
public function getPaysOrigine()
 { 
    return $this->pays_origine; 
}
public function getDescription()
 { 
    return $this->description;
 }
public function getIdHabitat()
 {
     return $this->id_habitat;
 }

// setters
public function setId($id) 
{ 
    $this->id_animal = $id;
 }
public function setNom($nom)
 { 
    $this->nom = $nom; 
}
public function setEspece($espece)
 { 
    $this->espece = $espece; 
}
public function setAlimentation($alimentation)
 {
     $this->alimentation = $alimentation; 
    }
public function setImage($image)
 { 
    $this->image = $image; 
}
public function setPaysOrigine($pays_origine)
 { 
    $this->pays_origine = $pays_origine;
 }
public function setDescription($description)
 { 
    $this->description = $description; 
}
public function setIdHabitat($id_habitat)
 {
     $this->id_habitat = $id_habitat; 
    }
}
 
$lio=new animal(null,"lion",null,null,null,null,null,null);

echo $lio->getNom();



?>
