<?php
//session_start();

require '../vendor/vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//fonction pour généré un mot de passe aléatoire
function Genere_Password($size)
{
    $mdp ='';
    // Initialisation des caractères utilisables
    $characters = array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z");
    for($i=0;$i<$size;$i++)
    {
        $mdp .= ($i%2) ? strtoupper($characters[array_rand($characters)]) : $characters[array_rand($characters)];
    }
    return $mdp;
}

//cette page sert au traitement php de la page d'oublie de mdp
$email=$_POST['mail'];

$bdd= new PDO('mysql:host=localhost;dbname=projet_lprs_sgs;charset=utf8','root',''); // on se connecte à la base de donnée "snack", avec l'uttilisateur "root" avec l'encodage utf-8

$reponse = $bdd->prepare('SELECT * FROM utilisateur WHERE mail = :mail') ;  //on prepare la requete de php pour accéder aux identifiants dans la base de données en sql
$reponse->execute(array('mail'=>$mail)); //on insère sous forme de tableau les données que l'on veut récupérer de la base
$donne = $reponse->fetch(); //on execute finalement la requete
if($donne) // si la perssone existe bel et bien, on applique la condition qui suit
{
    $mdp = Genere_Password(10);

    $mail = new PHPMailer(); // fondation d'un nouvel objet
    $mail->CharSet = 'UTF-8';
    $mail->IsSMTP(); // activer SMTP
    $mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
    $mail->SMTPAuth = true; // authentication activée
    $mail->SMTPSecure = 'ssl'; // transfer sécurisé activé et néscéssaire notement pour gmail
    $mail->Host = "smtp.gmail.com";
    $mail->Port = 465; // or 587
    $mail->IsHTML(true);
    $mail->Username = "lprs.sgs@gmail.com";
    $mail->Password = "sgs500?!";
    $mail->SetFrom($email);
    $mail->Subject = "[HSP] : Mot de passe oublié";
    $mail->Body = "<center><b></b><br><p>Bonjour ! Voilà votre mot de passe de provisoire : ".$mdp.". Il sera demandé de le modifier à la prochaine Connexion.</p></center></html>";
    $mail->AddAddress($mail);
    if(!$mail->Send())
    {
        echo "Mailer Error: " . $mail->ErrorInfo;
    }
    else
    {
        echo "Le message a été envoyé";

        //hashé le mdp pour le rajouté dans la bdd
        $smdp= SHA1($mdp);

        $req = $bdd->prepare('UPDATE utilisateur SET mdp = ? WHERE mail = ?');
        $req->execute(array($smdp, $mail));

        header('location:../view/reinit_mdp.php');
    }


}
else //Gestion d'erreur, si le mail n'as pas été envoyé
{
    $_SESSION['erreur_mail'] = 1;
    header('location:e5_php/template/themes/template/index.php');
}
?>
