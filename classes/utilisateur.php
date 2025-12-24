 <?php


require_once "database.php";


class utilisateur {

private $id ;
private $nom ;
private $email ;
private $role;
private $motpasshash;
private $etat;
private $approuve ;
 
 public function  __construct($id = null,$nom = null,$email = null,$role = null,$motpasshash = null,
 $etat=1,$approuve=1)
{
$this->id = $id;
$this->nom=$nom;
$this->email = $email;
$this->role = $role ;
$this->motpasshash=$motpasshash;
$this->etat=$etat;
$this->approuve=$approuve;
}

/*getters*/

public function getId(){
    return $this-> id;
}
public function getNom(){
return $this-> nom ;
}
public function getEmail(){
    return $this-> email;
}
public function getRole(){
    return $this->role;
}
public function getMotpasshash(){
    return $this->motpasshash;
}
public function getEtat(){
    return $this->etat;
}
public function getApprouve(){
    return $this->approuve;
}

/*setters*/

public function setId($id){
    $this->id=$id;
}
public function setNom($nom){
    $this->nom=$nom;
}
public function setEmail($email){
    $this->email=$email;
}
public function setRole($role){
    $this->role=$role;
}
public function setMotpasshash($motpasshash){
$this->motpasshash=$motpasshash;
}
public  function setEtat($etat){
    $this->etat=$etat;
}
public function setApprouve($approuve){
    $this->approuve=$approuve;
}
public function cree(){

$db= new database();

$pdo = $db->getPdo();


$sql = "INSERT INTO utilisateurs(nom,email,role,
motpasse_hash,etat,approuve)
VALUES(:nom,:email,:role,:motpasshash,:etat,:approuve)";

 $stmt = $pdo->prepare($sql);

$resultat = $stmt->execute([
 ':nom' => $this->nom,':email' => $this->email,
 ':role' => $this->role,':motpasshash' => $this->motpasshash,
 ':etat' => $this->etat,':approuve' => $this->approuve
        ]);


if ($resultat) {
 
 return true;
 }
 return false;


}

 



public function trouverParEmail($email) {
    
$db= new database();

$pdo = $db->getPdo();
    
    
    $sql = "SELECT * FROM utilisateurs WHERE email = :email ";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':email' => $email]);
    
    
    
}









}
 
 


 

 ?>