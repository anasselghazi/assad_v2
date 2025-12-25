 <?php


require_once "database.php";


class utilisateur {

private $id_utilisateur ;
private $nom ;
private $email ;
private $role;
private $motpasse_hash;
private $etat;
private $approuve ;
 
 public function  __construct($id = null,$nom = null,$email = null,$role = null,$motpasshash = null,
 $etat=1,$approuve=1)
{
$this->id_utilisateur = $id;
$this->nom=$nom;
$this->email = $email;
$this->role = $role ;
$this->motpasse_hash=$motpasshash;
$this->etat=$etat;
$this->approuve=$approuve;
}

/*getters*/

public function getId(){
    return $this-> id_utilisateur;
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
    return $this->motpasse_hash;
}
public function getEtat(){
    return $this->etat;
}
public function getApprouve(){
    return $this->approuve;
}

/*setters*/

public function setId($id){
    $this->id_utilisateur=$id;
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
$this->motpasse_hash=$motpassehash;
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
VALUES(:nom,:email,:role,:motpasse_hash,:etat,:approuve)";
 
$stmt = $pdo->prepare($sql);

$stmt->bindParam(':nom',$this->nom);
$stmt->bindParam(':email',$this->email);
$stmt->bindParam(':role',$this->role);
$stmt->bindParam(':approuve',$this->approuve);
$stmt->bindParam(':motpasse_hash',$this->motpasse_hash);
$stmt->bindParam(':etat',$this->etat);

$resultat=$stmt->execute();

if ($resultat) {
 
 return true;
 }
 return false;


}

 
public function trouverParEmail($email) {
    
$db= new database();

$pdo = $db->getPdo();
    
    
$sql = "SELECT * FROM utilisateurs WHERE email = :email  limit 1";
$stmt = $pdo->prepare($sql);

$stmt->bindParam(':email',$this->email);

$stmt->execute();

$result=$stmt->fetch(PDO::FETCH_ASSOC);
if($result){
return new utilisateur($result['id_utilisateur'],$result['nom'],
  $result['email'], $result['role'], $result['motpasse_hash'],
  $result['etat'],$result['approuve']);

}
   
}

public function verifierMotDePasse($motpasse) {
    
    return password_verify($motpasse, $this->motpasshash);

}


}

 
 $u = new utilisateur();
$data = $u->trouverParEmail("admin");
 



 ?>