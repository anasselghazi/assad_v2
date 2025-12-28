 <?php
require_once "database.php";

class Habitat {
    private $id_habitat;
    private $nom;
    private $type_climate;
    private $description;
    private $zon_zoo;

    // Constructeur
    public function __construct($id = null, $nom = null, $climate = null, $description = null, $zone = null) {
        $this->id_habitat  = $id;
        $this->nom         = $nom;
        $this->type_climate = $climate;
        $this->description = $description;
        $this->zon_zoo     = $zone;   
    }

    // Getters
    public function getIdHabitat() {
        return $this->id_habitat;
    }

    public function getNom() {
        return $this->nom;
    }

    public function getTypeClimate() {
        return $this->type_climate;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getZone() {
        return $this->zon_zoo;
    }

    // Setters
    public function setIdHabitat($id_habitat) {
        $this->id_habitat = $id_habitat;   
    }

    public function setNom($nom) {
        $this->nom = $nom;
    }

    public function setTypeClimate($climate) {
        $this->type_climate = $climate;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function setZone($zone) {
        $this->zon_zoo = $zone;
    }

    
    public function listerTous() {
        $db  = new Database();
        $pdo = $db->getPdo();

        $sql  = "SELECT * FROM habitats";
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
 }
?>
