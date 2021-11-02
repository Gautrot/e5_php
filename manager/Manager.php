<?php
// utilisation du fichier BDD
require_once __DIR__ . '/../model/BDD.php';
// Créée une nouvelle session s'il n'existe aucune session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

ini_set('display_errors', 1);
error_reporting(E_ALL | E_STRICT);

//On appelle la classe PhpOffice
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

//On appelle la classe PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//on appelle la classe manager et toolsManager
//require_once '../manager/Manager.php';
require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../vendor/phpmailer/phpmailer/src/Exception.php';
require __DIR__ . '/../vendor/phpmailer/phpmailer/src/PHPMailer.php';
require __DIR__ . '/../vendor/phpmailer/phpmailer/src/SMTP.php';
//Load Composer's autoloader
require __DIR__ . '/../vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                               //Enable verbose debug output
    $mail->isSMTP();                                                     //Send using SMTP
    $mail->Host = 'smtp.example.com';                                    //Set the SMTP server to send through
    $mail->SMTPAuth = true;                                              //Enable SMTP authentication
    $mail->Username = 'n.sedjai@lprs.fr';                                //SMTP username
    $mail->Password = 'BTSNO=2020';                                      //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;                     //Enable implicit TLS encryption
    $mail->Port = 465;                                                   //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('from@example.com', 'Mailer');
    $mail->addAddress('joe@example.net', 'Joe User');       //Add a recipient
    $mail->addAddress('ellen@example.com');                       //Name is optional
    $mail->addReplyTo('info@example.com', 'Information');
    $mail->addCC('cc@example.com');
    $mail->addBCC('bcc@example.com');

    //Attachments
    $mail->addAttachment('/var/tmp/file.tar.gz');                   //Add attachments
    $mail->addAttachment('/tmp/image.jpg', 'new.jpg');        //Optional name

    //Content
    $mail->isHTML(true);                                           //Set email format to HTML
    $mail->Subject = 'Here is the subject';
    $mail->Body = 'This is the HTML message body <b>in bold!</b>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: $mail->ErrorInfo";
}

// création de la classe Manager
class Manager
{
    // Méthode de connexion

    /**
     * @throws Exception
     */
    public function connexion(Utilisateur $user)
    {
        // On appelle la base de données
        $bdd = (new BDD)->getBase();

        $req = $bdd->query('SELECT * FROM utilisateur');
        $res = $req->fetchAll();
        foreach ($res as $user) {
            // Vérifie les conditions lors de la connection.
            // S'il y a une erreur, la fonction s'arrête.
            switch ($user) {
                case ($user['mdp'] == '' || $user['mdp'] == null):
                    throw new Exception('Mot de passe vide.', 1);
                case ($user['login'] == '' || $user['login'] == null):
                    throw new Exception('Login vide.', 1);
                case ($user['login'] == '' && $user['mdp'] == '' || $user['login'] == null && $user['mdp'] == null):
                    throw new Exception('Champs vide.', 1);
            }
        }

        // Préparation de la requête pour la connexion d'un utilisateur
        $req = $bdd->prepare('SELECT idUtilisateur, login, mdp, statut, validUtilisateur FROM utilisateur WHERE login = :login AND mdp = :mdp');
        $req->execute([
            'login' => $user->getLogin(),
            'mdp' => $user->getMdp()
        ]);
        $res = $req->fetch();

        // Vérification du mot de passe entré par l'utilisateur.
        // Si le mot de passe est correct alors la connexion est réussi et on entre dans le compte
        if (password_verify($user->getMdp(), $res['mdp']) || $res['mdp']) {
            unset($_SESSION['erreur']);
            return $_SESSION['user'] = $res;
        }
        // sinon affiche un message d'erreur
        throw new Exception('Erreur pendant la connexion.', 1);
    }

    // Méthode de modification d'un utilisateur

    /**
     * @throws Exception
     */
//    public function modifUtil(Utilisateur $user)
//    {
//        #Instancie la classe BDD
//        $bdd = (new BDD)->getBase();
//        $req = $bdd->prepare('SELECT idUtilisateur, login, mdp, statut, validUtilisateur FROM utilisateur WHERE idUtilisateur = :idUtilisateur');
//        $req->execute([
//            'idUtilisateur' => $user->getIdUtilisateur()
//        ]);
//        $res = $req->fetch();
//        if (!$res) {
//            # Si le compte existe dans la BDD.
//            throw new Exception('Ce compte n\'existe pas.');
//        } else {
//            $req = $bdd->prepare('UPDATE utilisateur SET nom = :nom, prenom = :prenom, dateNaissance = :dateNaissance, adresse = :adresse, telephone = :telephone, mail = :mail, login = :login, mdp = :mdp WHERE idUtilisateur = :idUtilisateur');
//            $res2 = $req->execute([
//                'idUtilisateur' => $user->getIdUtilisateur(),
//                'nom' => $user->getNom(),
//                'prenom' => $user->getPrenom(),
//                'dateNaissance' => $user->getDateNaissance(),
//                'adresse' => $user->getAdresse(),
//                'telephone' => $user->getTelephone(),
//                'mail' => $user->getMail(),
//                'login' => $user->getLogin(),
//                'mdp' => $user->getMdp()
//            ]);
//            if ($res2) {
////                $req = $bdd->prepare('SELECT idUtilisateur, login, mdp, statut FROM utilisateur WHERE idUtilisateur = :idUtilisateur');
////                $req->execute([
////                    'idUtilisateur' => $user->getIdUtilisateur()
////                ]);
////                $res3 = $req->fetch();
////                unset($_SESSION['edit']);
//                unset($_SESSION['erreur']);
//                header('Location: /e5_php/template/themes/template/index');
//                return $_SESSION['user'] = $res;
//            }
//            # Si un ou plusieurs champs sont vides.
//            throw new Exception('Modification échouée !');
//        }
//        header('Location: /e5_php/template/themes/template/modif-util');
//    }

// Méthode d'affichage d'un utilisateur dans la session 'edit'

    /**
     * @throws Exception
     */
    public function chercheUtilModif(Utilisateur $user)
    {
        // on appelle la base de données
        $bdd = (new BDD)->getBase();
        $req = $bdd->prepare('SELECT * FROM utilisateur WHERE idUtilisateur = :idUtilisateur');
        $req->execute([
            'idUtilisateur' => $user->getIdUtilisateur()
        ]);
        $res = $req->fetch();
        if ($res) {
            switch ($res['statut']) {
                case '1':
                    $req = $bdd->prepare('SELECT * FROM utilisateur INNER JOIN eleve ON eleve.idEleve = utilisateur.idUtilisateur WHERE idUtilisateur = :idUtilisateur');
                    break;
                case '2':
                    $req = $bdd->prepare('SELECT * FROM utilisateur INNER JOIN parent ON parent.idParent = utilisateur.idUtilisateur WHERE idUtilisateur = :idUtilisateur');
                    break;
                case '3':
                    $req = $bdd->prepare('SELECT * FROM utilisateur INNER JOIN professeur ON professeur.idProf = utilisateur.idUtilisateur WHERE idUtilisateur = :idUtilisateur');
                    break;
                case '4':
                    $req = $bdd->prepare('SELECT * FROM utilisateur INNER JOIN administrateur ON administrateur.idAdmin = utilisateur.idUtilisateur WHERE idUtilisateur = :idUtilisateur');
                    break;
                default:
                    break;
            }
            $req->execute([
                'idUtilisateur' => $user->getIdUtilisateur()
            ]);
            $res2 = $req->fetch();
            header('Location: /e5_php/template/themes/template/modif-util?idUtilisateur=' . $res2['idUtilisateur']);
            unset($_SESSION['erreur']);
            return $_SESSION['edit'] = $res2;
        }
        // sinon affiche un message d'erreur
        header('Location: /e5_php/template/themes/template/index');
        throw new Exception('Erreur pendant la recherche de l\'utilisateur.', 1);
    }

// Méthode de suppression de la session 'edit'

//    public function retourUtilEdit()
//    {
//        unset($_SESSION['edit']);
//        header('Location: /e5_php/template/themes/template/index');
//    }

// Méthode pour envoyer un mail et changer son mdp

    function MDPoublie($mail_user)
    {
        $bdd = (new BDD)->getBase();

        // on récupère l'utilisateur ayant perdu son mot de passe
        $request = $bdd->prepare('SELECT * FROM utilisateur WHERE mail = :mail');
        $request->execute(array($mail_user));
        $profil = $request->fetch();
        var_dump($profil);
        //Si l'adresse email correspond à aucun mail et donc aucun utilisateur
        if (!$profil) {
            header('Location: /e5_php/template/themes/template/index.php');
        } else {
            $select_idUtilisateur = '';
            var_dump($select_idUtilisateur);


            $this->mail('Mot de passe oublié', $body, $select_idUser, $mail_user);
            header('Location: /e5_php/template/themes/template/index.php');
        }
    }
}