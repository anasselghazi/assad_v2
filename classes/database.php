 <?php
class database
{
   private $host;
   private $dbname;
   private $user;
   private $password;
   private $pdo ; 


public function __construct()
{

$this->host="localhost";
$this->dbname="assadV2_db";
$this->user="root";
$this->password="";

try {
   $this->pdo=new PDO ("mysql:host={$this->host};dbname={$this->dbname}; charset=utf8mb4"
   ,$this->user,$this->password);


$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


}catch (PDOException $e){

    echo"erreur de connexion: ". $e->getMessage();
}

}
public function getPdo()
{
    return $this->pdo;
}

}


 ?>