 <?php
session_start();
require_once "../classes/utilisateur.php";
require_once "../classes/database.php";

$logerrur = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {

    
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    
    if (empty($email) || empty($password)) {
        $logerrur[] = "Veuillez remplir tous les champs.";
    } else {
        $userlg = new utilisateur();
        $user = $userlg->trouverParEmail($email);

        if ($user) {
            
            if (password_verify($password, $user->getMotPasshash())) {
                
                
                if ($user->getRole() === 'guide' && $user->getApprouve() == 0) {
                    $logerrur[] = "Votre compte est en attente d'approbation.";
                } else {
                    
                    $_SESSION['user_id'] = $user->getId();
                    $_SESSION['nom'] = $user->getNom();
                    $_SESSION['role'] = $user->getRole();

                    
                    if ($user->getRole() === 'admin') {
                        header("Location: ../dashboard_admin.php");
                    } elseif ($user->getRole() === 'guide') {
                        header("Location: ../dashboard_guide.php");
                    } else {
                        header("Location: ../dashboard_visiteur.php");
                    }
                    exit();
                }
            } else {
                $logerrur[] = "Email ou mot de passe incorrect.";
            }
        } else {
            $logerrur[] = "Email ou mot de passe incorrect.";
        }
    }
}
?>