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

// création de la classe manager
class Manager
{
    // Méthode de connexion

    /**
     * @throws Exception
     */
    public function connexion(Utilisateur $user)
    {
        // on appelle la base de données
        $bdd = (new BDD)->getBase();
        // gestion d'erreur : si l'utilisateur ne rentre rien pour le login ou le mot de passe alors le message "champ vide" apparaitra
        if ($user->getLogin() === '' && $user->getMdp() == '' || $user->getLogin() === null && $user->getMdp() === null) {
            header('Location: /e5_php/template/themes/template/index');
            throw new Exception('Champs vide', 1);
        }
        if ($user->getLogin() === '' || $user->getLogin() === null) {
            header('Location: /e5_php/template/themes/template/index');
            throw new Exception('Login vide', 1);
        }
        if ($user->getMdp() === '' || $user->getMdp() === null) {
            header('Location: /e5_php/template/themes/template/index');
            throw new Exception('Mot de passe vide', 1);
        }
        // préparation de la requête pour la connexion d'un utilisateur
        $req = $bdd->prepare('SELECT idUtilisateur, login, mdp, statut FROM utilisateur WHERE login = :login AND mdp = :mdp');
        $req->execute([
            'login' => $user->getLogin(),
            'mdp' => $user->getMdp()
        ]);
        $res = $req->fetch();
        // vérification du mot de passe entré par l'utilisateur :
        // si le mot de passe est correct alors la connexion est réussi et on entre dans le compte
        header('Location: /e5_php/template/themes/template/index');
        if (password_verify($user->getMdp(), $res['mdp']) || $res['mdp']) {
            unset($_SESSION['erreur']);
            return $_SESSION['user'] = $res;
        } else {
            // sinon affiche un message d'erreur
            throw new Exception('Erreur pendant la connexion.', 1);
        }
    }

    // Méthode de déconnexion

    public function deconnexion()
    {
        session_destroy();
        // redirection vers la page index
        header('Location: /e5_php/template/themes/template/index');
    }

    // Méthode d'inscription pour un utilisateur

    /**
     * @throws Exception
     */
    public function inscription(Utilisateur $user)
    {
        $bdd = (new BDD)->getBase();
        $req = $bdd->prepare('SELECT * FROM utilisateur WHERE login = :login ');
        $req->execute([
            'login' => $user->getLogin()
        ]);
        $res = $req->fetch();
        // si $res est égale à quelque chose alors un message d'erreur s'affiche
        if ($res) {
            throw new Exception('L\'utilisateur existe déjà.');
        }
        // si les getters sont différents de rien alors :
        if ($user->getNom() !== '' && $user->getPrenom() !== '' && $user->getMail() !== '' && $user->getLogin() !== '' && $user->getMdp() !== ''
            || $user->getNom() !== null && $user->getPrenom() !== null && $user->getMail() !== null && $user->getLogin() !== null && $user->getMdp() !== null) {
            // création de l'objet bdd pour s'y connecter
            $bdd = (new BDD)->getBase();
            // preparation de la requête
            $req = $bdd->prepare('INSERT INTO
            utilisateur (nom, prenom, dateNaissance, adresse, telephone, mail, login, mdp)
            VALUES (:nom, :prenom, :dateNaissance, :adresse, :telephone, :mail, :login, :mdp)
            ');
            // execution de la requête
            $res2 = $req->execute([
                'nom' => $user->getNom(),
                'prenom' => $user->getPrenom(),
                'dateNaissance' => $user->getDateNaissance(),
                'adresse' => $user->getAdresse(),
                'telephone' => $user->getTelephone(),
                'mail' => $user->getMail(),
                'login' => $user->getLogin(),
                'mdp' => $user->getMdp()
            ]);
            if ($res2) {
                $req = $bdd->prepare('SELECT idUtilisateur, login, mdp, statut FROM utilisateur WHERE login = :login AND mdp = :mdp');
                $req->execute([
                    'login' => $user->getLogin(),
                    'mdp' => $user->getMdp()
                ]);
                $res3 = $req->fetch();
                unset($_SESSION['erreur']);
                header('Location: /e5_php/template/themes/template/index');
                return $_SESSION['user'] = $res3;
            } else {
                // sinon redirection vers la page inscription
                throw new Exception('Inscription échouée.');
            }
        }
        throw new Exception('Erreur.');
    }

    // Méthode d'inscription pour un étudiant

    /**
     * @throws Exception
     */
    public function inscriptionEleve(Eleve $eleve)
    {
        $bdd = (new BDD)->getBase();
        $req = $bdd->prepare('SELECT * FROM utilisateur WHERE mail = :mail ');
        $req->execute([
            'login' => $eleve->getMail()
        ]);
        $res = $req->fetch();
        // si $res est égale à quelque chose alors un message d'erreur s'affiche
        if ($res) {
            throw new Exception('L\'étudiant existe déjà.');
        }
        // si les getters sont différents de rien alors :
        if ($eleve->getNom() !== '' && $eleve->getPrenom() !== '' && $eleve->getMail() !== '' && $eleve->getLogin() !== '' && $eleve->getMdp() !== ''
            || $eleve->getNom() !== null && $eleve->getPrenom() !== null && $eleve->getMail() !== null && $eleve->getLogin() !== null && $eleve->getMdp() !== null) {
            // création de l'objet bdd pour s'y connecter
            $bdd = (new BDD)->getBase();
            // preparation de la requête
            $req = $bdd->prepare('
                INSERT INTO utilisateur (nom, prenom, dateNaissance, adresse, telephone, mail, login, mdp, statut) VALUES (:nom, :prenom, :dateNaissance, :adresse, :telephone, :mail, :login, :mdp, :statut);
                INSERT INTO eleve (idEleve, classe) VALUES (LAST_INSERT_ID(), :classe);
            ');
            // execution de la requête
            $res2 = $req->execute([
                'nom' => $eleve->getNom(),
                'prenom' => $eleve->getPrenom(),
                'dateNaissance' => $eleve->getDateNaissance(),
                'adresse' => $eleve->getAdresse(),
                'telephone' => $eleve->getTelephone(),
                'mail' => $eleve->getMail(),
                'login' => $eleve->getLogin(),
                'mdp' => $eleve->getMdp(),
                'statut' => $eleve->getStatut(),
                'classe' => $eleve->getClasse()
            ]);
            if ($res2) {
                $req = $bdd->prepare('SELECT idUtilisateur, login, mdp, statut FROM utilisateur WHERE login = :login AND mdp = :mdp');
                $req->execute([
                    'login' => $eleve->getLogin(),
                    'mdp' => $eleve->getMdp()
                ]);
                $res3 = $req->fetch();
                unset($_SESSION['erreur']);
                header('Location: /e5_php/template/themes/template/index');
                return $_SESSION['user'] = $res3;
            } else {
                // sinon redirection vers la page inscription
                throw new Exception('Inscription échouée.');
            }
        }
        throw new Exception('Erreur.');
    }


    // Méthode de modification d'un utilisateur

    /**
     * @throws Exception
     */
    public function modifUtil(Utilisateur $user)
    {
        #Instancie la classe BDD
        $bdd = (new BDD)->getBase();
        $req = $bdd->prepare('SELECT idUtilisateur FROM utilisateur WHERE idUtilisateur = :idUtilisateur');
        $req->execute([
            'idUtilisateur' => $user->getIdUtilisateur()
        ]);
        $res = $req->fetch();
        if (!$res) {
            # Si le compte existe dans la BDD.
            header('Location: /e5_php/template/themes/template/modif-util');
            throw new Exception('Ce compte n\'existe pas.');
        } else {
            $req = $bdd->prepare('UPDATE utilisateur SET nom = :nom, prenom = :prenom, dateNaissance = :dateNaissance, adresse = :adresse, telephone = :telephone, mail = :mail, login = :login, mdp = :mdp WHERE idUtilisateur = :idUtilisateur');
            $res2 = $req->execute([
                'idUtilisateur' => $user->getIdUtilisateur(),
                'nom' => $user->getNom(),
                'prenom' => $user->getPrenom(),
                'dateNaissance' => $user->getDateNaissance(),
                'adresse' => $user->getAdresse(),
                'telephone' => $user->getTelephone(),
                'mail' => $user->getMail(),
                'login' => $user->getLogin(),
                'mdp' => $user->getMdp()
            ]);
            if ($res2) {
                $req = $bdd->prepare('SELECT idUtilisateur, login, mdp, statut FROM utilisateur WHERE idUtilisateur = :idUtilisateur');
                $req->execute([
                    'idUtilisateur' => $user->getIdUtilisateur()
                ]);
                $res3 = $req->fetch();
                unset($_SESSION['edit']);
                unset($_SESSION['erreur']);
                header('Location: /e5_php/template/themes/template/index');
                return $_SESSION['user'] = $res3;
            } else {
                # Si un ou plusieurs champs sont vides.
                throw new Exception('Modification échouée !');
            }
        }
    }

    // Méthode de création d'un utilisateur

    /**
     * @throws Exception
     */
    public function creerUtil(Utilisateur $user)
    {
        #Instancie la classe BDD
        $bdd = (new BDD)->getBase();
        $req = $bdd->prepare('SELECT mail FROM utilisateur WHERE mail = :mail');
        $req->execute([
            'mail' => $user->getMail()
        ]);
        $res = $req->fetch();
        if ($res) {
            # Si le compte existe dans la BDD.
            header('Location: /e5_php/template/themes/template/table-util');
            throw new Exception('Ce compte existe.');
        } else {
            $req = $bdd->prepare('INSERT INTO utilisateur (nom, prenom, dateNaissance, adresse, telephone, mail, login, mdp, statut) VALUES (:nom, :prenom, :dateNaissance, :adresse, :telephone, :mail, :login, :mdp, :statut)');
            $res2 = $req->execute([
                'nom' => $user->getNom(),
                'prenom' => $user->getPrenom(),
                'dateNaissance' => $user->getDateNaissance(),
                'adresse' => $user->getAdresse(),
                'telephone' => $user->getTelephone(),
                'mail' => $user->getMail(),
                'login' => $user->getLogin(),
                'mdp' => $user->getMdp(),
                'statut' => $user->getStatut()
            ]);
            unset($_SESSION['erreur']);
            header('Location: /e5_php/template/themes/template/table-util');
            if (!$res2) {
                # Si un ou plusieurs champs sont vides.
                throw new Exception('Ajout échouée !');
            }
            return;
        }
        throw new Exception('Ajout échouée !');
    }

    // Méthode de création d'un compte élève

    /**
     * @throws Exception
     */
    public function creerEleve(Eleve $eleve)
    {
        #Instancie la classe BDD
        $bdd = (new BDD)->getBase();
        $req = $bdd->prepare('SELECT mail FROM utilisateur WHERE mail = :mail');
        $req->execute([
            'mail' => $eleve->getMail()
        ]);
        $res = $req->fetchall();
        if ($res) {
            # Si le compte existe dans la BDD.
            header('Location: /e5_php/template/themes/template/table-util');
            throw new Exception('Ce compte existe.');
        } else {
            $req = $bdd->prepare('
                INSERT INTO utilisateur (nom, prenom, dateNaissance, adresse, telephone, mail, login, mdp, statut) VALUES (:nom, :prenom, :dateNaissance, :adresse, :telephone, :mail, :login, :mdp, :statut);
                INSERT INTO eleve (idEleve, classe) VALUES (LAST_INSERT_ID(), :classe);
            ');
            $res2 = $req->execute([
                'nom' => $eleve->getNom(),
                'prenom' => $eleve->getPrenom(),
                'dateNaissance' => $eleve->getDateNaissance(),
                'adresse' => $eleve->getAdresse(),
                'telephone' => $eleve->getTelephone(),
                'mail' => $eleve->getMail(),
                'login' => $eleve->getLogin(),
                'mdp' => $eleve->getMdp(),
                'statut' => $eleve->getStatut(),
                'classe' => $eleve->getClasse()
            ]);
            unset($_SESSION['erreur']);
            header('Location: /e5_php/template/themes/template/table-util');
            if (!$res2) {
                # Si un ou plusieurs champs sont vides.
                throw new Exception('Ajout échouée !');
            }
            return;
        }

        throw new Exception('Ajout échouée !');
    }

    // Méthode de création d'un compte parent

    /**
     * @throws Exception
     */
    public function creerParent(Parents $parent)
    {
        #Instancie la classe BDD
        $bdd = (new BDD)->getBase();
        $req = $bdd->prepare('
            SELECT mail FROM utilisateur WHERE mail = :mail;
            SELECT nom, prenom FROM utilisateur INNER JOIN eleve ON idEleve = idUtilisateur WHERE idEleve = :idEleve;
        ');
        $req->execute([
            'mail' => $parent->getMail(),
            'idEleve' => $parent->getIdEleve()
        ]);
        $res = $req->fetchall();
        if ($res) {
            # Si le compte existe dans la BDD.
            header('Location: /e5_php/template/themes/template/table-util');
            throw new Exception('Ce compte existe.');
        } else {
            $req = $bdd->prepare('
                INSERT INTO utilisateur (nom, prenom, dateNaissance, adresse, telephone, mail, login, mdp, statut) VALUES (:nom, :prenom, :dateNaissance, :adresse, :telephone, :mail, :login, :mdp, :statut);
                INSERT INTO parent (idParent, metier, idEleve) VALUES (LAST_INSERT_ID(), :metier, :idEleve);
            ');
            $res2 = $req->execute([
                'nom' => $parent->getNom(),
                'prenom' => $parent->getPrenom(),
                'dateNaissance' => $parent->getDateNaissance(),
                'adresse' => $parent->getAdresse(),
                'telephone' => $parent->getTelephone(),
                'mail' => $parent->getMail(),
                'login' => $parent->getLogin(),
                'mdp' => $parent->getMdp(),
                'statut' => $parent->getStatut(),
                'metier' => $parent->getMetier(),
                'idEleve' => $parent->getIdEleve()
            ]);
            unset($_SESSION['erreur']);
            header('Location: /e5_php/template/themes/template/table-util');
            if (!$res2) {
                # Si un ou plusieurs champs sont vides.
                throw new Exception('Ajout échouée !');
            }
            return;
        }

        throw new Exception('Ajout échouée !');
    }

    // Méthode de création d'un compte professeur

    /**
     * @throws Exception
     */
    public function creerProf(Professeur $prof)
    {
        #Instancie la classe BDD
        $bdd = (new BDD)->getBase();
        $req = $bdd->prepare('SELECT mail FROM utilisateur WHERE mail = :mail');
        $req->execute([
            'mail' => $prof->getMail()
        ]);
        $res = $req->fetchall();
        if ($res) {
            # Si le compte existe dans la BDD.
            header('Location: /e5_php/template/themes/template/table-util');
            throw new Exception('Ce compte existe.');
        } else {
            $req = $bdd->prepare('
                INSERT INTO utilisateur (nom, prenom, dateNaissance, adresse, telephone, mail, login, mdp, statut) VALUES (:nom, :prenom, :dateNaissance, :adresse, :telephone, :mail, :login, :mdp, :statut);
                INSERT INTO professeur (idProf, matiere) VALUES (LAST_INSERT_ID(), :matiere);
            ');
            $res2 = $req->execute([
                'nom' => $prof->getNom(),
                'prenom' => $prof->getPrenom(),
                'dateNaissance' => $prof->getDateNaissance(),
                'adresse' => $prof->getAdresse(),
                'telephone' => $prof->getTelephone(),
                'mail' => $prof->getMail(),
                'login' => $prof->getLogin(),
                'mdp' => $prof->getMdp(),
                'statut' => $prof->getStatut(),
                'matiere' => $prof->getMatiere()
            ]);
            unset($_SESSION['erreur']);
            header('Location: /e5_php/template/themes/template/table-util');
            if (!$res2) {
                # Si un ou plusieurs champs sont vides.
                throw new Exception('Ajout échouée !');
            }
            return;
        }

        throw new Exception('Ajout échouée !');
    }

    // Méthode de création d'un compte administrateur

    /**
     * @throws Exception
     */
    public function creerAdmin(Administrateur $admin)
    {
        #Instancie la classe BDD
        $bdd = (new BDD)->getBase();
        $req = $bdd->prepare('SELECT mail FROM utilisateur WHERE mail = :mail');
        $req->execute([
            'mail' => $admin->getMail()
        ]);
        $res = $req->fetchall();
        if ($res) {
            # Si le compte existe dans la BDD.
            header('Location: /e5_php/template/themes/template/table-util');
            throw new Exception('Ce compte existe.');
        } else {
            $req = $bdd->prepare('
                INSERT INTO utilisateur (nom, prenom, dateNaissance, adresse, telephone, mail, login, mdp, statut, validUtilisateur) VALUES (:nom, :prenom, :dateNaissance, :adresse, :telephone, :mail, :login, :mdp, :statut, :validUtilisateur);
                INSERT INTO administrateur (idAdmin) VALUES (LAST_INSERT_ID());
            ');
            $res2 = $req->execute([
                'nom' => $admin->getNom(),
                'prenom' => $admin->getPrenom(),
                'dateNaissance' => $admin->getDateNaissance(),
                'adresse' => $admin->getAdresse(),
                'telephone' => $admin->getTelephone(),
                'mail' => $admin->getMail(),
                'login' => $admin->getLogin(),
                'mdp' => $admin->getMdp(),
                'statut' => $admin->getStatut(),
                'validUtilisateur' => $admin->getValidUtilisateur()
            ]);
            unset($_SESSION['erreur']);
            header('Location: /e5_php/template/themes/template/table-util');
            if (!$res2) {
                # Si un ou plusieurs champs sont vides.
                throw new Exception('Ajout échouée !');
            }
            return;
        }

        throw new Exception('Ajout échouée !');
    }

    // Méthode d'activation d'un utilisateur

    /**
     * @throws Exception
     */
    public function activerUtil(Utilisateur $user)
    {
        #Instancie la classe BDD
        $bdd = (new BDD)->getBase();
        $req = $bdd->prepare('SELECT idUtilisateur FROM utilisateur WHERE idUtilisateur = :idUtilisateur');
        $req->execute([
            'idUtilisateur' => $user->getIdUtilisateur()
        ]);
        $res = $req->fetch();
        if ($res) {
            $req = $bdd->prepare('UPDATE utilisateur SET validUtilisateur = 1 WHERE idUtilisateur = :idUtilisateur');
            $req->execute([
                'idUtilisateur' => $user->getIdUtilisateur()
            ]);
            unset($_SESSION['erreur']);
            header('Location: /e5_php/template/themes/template/table-util');
        } else {
            # Si le compte existe dans la BDD.
            header('Location: /e5_php/template/themes/template/table-util');
            throw new Exception('Ce compte n\'existe pas.');
        }
    }

    // Méthode de désactivation d'un utilisateur

    /**
     * @throws Exception
     */
    public function desactiverUtil(Utilisateur $user)
    {
        #Instancie la classe BDD
        $bdd = (new BDD)->getBase();
        $req = $bdd->prepare('SELECT idUtilisateur FROM utilisateur WHERE idUtilisateur = :idUtilisateur');
        $req->execute([
            'idUtilisateur' => $user->getIdUtilisateur()
        ]);
        $res = $req->fetch();
        if ($res) {
            $req = $bdd->prepare('UPDATE utilisateur SET validUtilisateur = 0 WHERE idUtilisateur = :idUtilisateur');
            $res2 = $req->execute([
                'idUtilisateur' => $user->getIdUtilisateur()
            ]);
            unset($_SESSION['erreur']);
            header('Location: /e5_php/template/themes/template/table-util');
            if (!$res2) {
                throw new Exception('Désactivation échouée !');
            }
        } else {
            # Si le compte existe dans la BDD.
            header('Location: /e5_php/template/themes/template/table-util');
            throw new Exception('Ce compte n\'existe pas.');
        }
    }

    // Méthode d'affichage d'un utilisateur dans la session 'show'

    /**
     * @throws Exception
     */
    public function chercheUtilAdmin(Utilisateur $user)
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
            header('Location: /e5_php/template/themes/template/utilisateur?idUtilisateur=' . $res2['idUtilisateur']);
            unset($_SESSION['erreur']);
            return $_SESSION['show'] = $res2;
        } else {
            // sinon affiche un message d'erreur
            header('Location: /e5_php/template/themes/template/table-util');
            throw new Exception('Erreur pendant la recherche de l\'utilisateur.', 1);
        }
    }

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
        var_dump($res);
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
        } else {
            // sinon affiche un message d'erreur
            header('Location: /e5_php/template/themes/template/index');
            throw new Exception('Erreur pendant la recherche de l\'utilisateur.', 1);
        }
    }

    // Méthode de suppression de la session 'show'

    public function retourUtilAdmin()
    {
        unset($_SESSION['show']);
        header('Location: /e5_php/template/themes/template/table-util');
    }

    // Méthode de suppression de la session 'edit'

    public function retourUtilEdit()
    {
        unset($_SESSION['edit']);
        header('Location: /e5_php/template/themes/template/index');
    }

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
            header('Location: /e5_php/template/themes/template/index?err=mail&mail=' . $mail_user);
        } else {
            $select_idUtilisateur = '';
            var_dump($select_idUtilisateur);

            $body = '<!doctype html>
<html lang="fr">
  <head>
    <meta name="viewport" content="width=device-width">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Mot de passe oublié</title>
  <style>
@media only screen and (max-width: 620px) {
  table[class=body] h1 {
    font-size: 28px !important;
    margin-bottom: 10px !important;
  }

  table[class=body] p,
table[class=body] ul,
table[class=body] ol,
table[class=body] td,
table[class=body] span,
table[class=body] a {
    font-size: 16px !important;
  }

  table[class=body] .wrapper,
table[class=body] .article {
    padding: 10px !important;
  }

  table[class=body] .content {
    padding: 0 !important;
  }

  table[class=body] .container {
    padding: 0 !important;
    width: 100% !important;
  }

  table[class=body] .main {
    border-left-width: 0 !important;
    border-radius: 0 !important;
    border-right-width: 0 !important;
  }

  table[class=body] .btn table {
    width: 100% !important;
  }

  table[class=body] .btn a {
    width: 100% !important;
  }

  table[class=body] .img-responsive {
    height: auto !important;
    max-width: 100% !important;
    width: auto !important;
  }
}
@media all {
  .ExternalClass {
    width: 100%;
  }

  .ExternalClass,
.ExternalClass p,
.ExternalClass span,
.ExternalClass font,
.ExternalClass td,
.ExternalClass div {
    line-height: 100%;
  }

  .apple-link a {
    color: inherit !important;
    font-family: inherit !important;
    font-size: inherit !important;
    font-weight: inherit !important;
    line-height: inherit !important;
    text-decoration: none !important;
  }

  .btn-primary table td:hover {
    background-color: #d5075d !important;
  }

  .btn-primary a:hover {
    background-color: #d5075d !important;
    border-color: #d5075d !important;
  }
}
</style></head>
  <body class style="background-color: #eaebed; font-family: sans-serif; -webkit-font-smoothing: antialiased; font-size: 14px; line-height: 1.4; margin: 0; padding: 0; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;">
    <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="body" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; background-color: #eaebed; width: 100%;" width="100%" bgcolor="#eaebed">
      <tr>
        <td style="font-family: sans-serif; font-size: 14px; vertical-align: top;" valign="top">&nbsp;</td>
        <td class="container" style="font-family: sans-serif; font-size: 14px; vertical-align: top; display: block; max-width: 580px; padding: 10px; width: 580px; Margin: 0 auto;" width="580" valign="top">
          <div class="header" style="padding: 20px 0;">
            <table role="presentation" border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; width: 100%;" width="100%">
              <tr>
                <td class="align-center" style="font-family: sans-serif; font-size: 14px; vertical-align: top; text-align: center;" valign="top" align="center">
                  <a href="https://snacklprs.fr" style="color: #ec0867; text-decoration: underline;"><img src="https://i.ibb.co/n6h0RDr/image-2.png" height="100" alt="Snacklprs" style="border: none; -ms-interpolation-mode: bicubic; max-width: 100%;"></a>
                </td>
              </tr>
            </table>
          </div>
          <div class="content" style="box-sizing: border-box; display: block; Margin: 0 auto; max-width: 580px; padding: 10px;">

            <!-- START CENTERED WHITE CONTAINER -->
            <span class="preheader" style="color: transparent; display: none; height: 0; max-height: 0; max-width: 0; opacity: 0; overflow: hidden; mso-hide: all; visibility: hidden; width: 0;">Bienvenue sur le Snack LPRS, voici votre mot de passe provisoire.</span>
            <table role="presentation" class="main" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; background: #ffffff; border-radius: 3px; width: 100%;" width="100%">

              <!-- START MAIN CONTENT AREA -->
              <tr>
                <td class="wrapper" style="font-family: sans-serif; font-size: 14px; vertical-align: top; box-sizing: border-box; padding: 20px;" valign="top">
                  <table role="presentation" border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; width: 100%;" width="100%">
                    <tr>
                      <td style="font-family: sans-serif; font-size: 14px; vertical-align: top;" valign="top">
                        <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0 0 15px;">Bienvenue sur le Snack LPRS !</p>
                        <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0 0 15px;">Vous avez oubli&#233; votre mot de passe ? </p>
                        <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0 0 15px;">

Pas de probl&#232;me, cliquez sur le bouton pour acceder &#224; un changement de mot de passe.
</p>
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0 0 15px;"> Si vous n avez pas fait cette demande ignorez ce mail et changez votre mot de passe via votre interface.  </p>
                        <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="btn btn-primary" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; box-sizing: border-box; min-width: 100%; width: 100%;" width="100%">
                          <tbody>
                            <tr>
                              <td align="left" style="font-family: sans-serif; font-size: 14px; vertical-align: top; padding-bottom: 15px;" valign="top">
                                <table role="presentation" border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: auto; width: auto;">
                                  <tbody>
                                    <tr>
                                      <td style="font-family: sans-serif; font-size: 14px; vertical-align: top; border-radius: 5px; text-align: center; background-color: #ec0867;" valign="top" align="center" bgcolor="#ec0867"> <a href="https://snacklprs.fr/Projet_snack/view/Mdp&MessageEtudiant/formulaire_update_password.php?mail=' . $mail_user . '" target="_blank" style="border: solid 1px #ec0867; border-radius: 5px; box-sizing: border-box; cursor: pointer; display: inline-block; font-size: 14px; font-weight: bold; margin: 0; padding: 12px 25px; text-decoration: none; text-transform: capitalize; background-color: #ec0867; color: #ffffff;">Changer son mot de passe</a> </td>
                                    </tr>
                                  </tbody>
                                </table>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>

            <!-- END MAIN CONTENT AREA -->
            </table>

            <!-- START FOOTER -->
            <div class="footer" style="clear: both; Margin-top: 10px; text-align: center; width: 100%;">
              <table role="presentation" border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; width: 100%;" width="100%">
                <tr>
                  <td class="content-block" style="font-family: sans-serif; vertical-align: top; padding-bottom: 10px; padding-top: 10px; color: #9a9ea6; font-size: 12px; text-align: center;" valign="top" align="center">
                    <span class="apple-link" style="color: #9a9ea6; font-size: 12px; text-align: center;">Snack LPRS, Lyc&#233;e et UFA Robert Schuman</span>

                  </td>
                </tr>
                <tr>
                  <td class="content-block powered-by" style="font-family: sans-serif; vertical-align: top; padding-bottom: 10px; padding-top: 10px; color: #9a9ea6; font-size: 12px; text-align: center;" valign="top" align="center">
                    by <a href="https://snacklprs.fr" style="color: #9a9ea6; font-size: 12px; text-align: center; text-decoration: none;">Snack LPRS Admins</a>.
                  </td>
                </tr>
              </table>
            </div>
            <!-- END FOOTER -->

          <!-- END CENTERED WHITE CONTAINER -->
          </div>
        </td>
        <td style="font-family: sans-serif; font-size: 14px; vertical-align: top;" valign="top">&nbsp;</td>
      </tr>
    </table>
  </body>
</html>
';
            $this->mail('Mot de passe oublié', $body, $select_idUser, $mail_user);
            header('Location: /e5_php/template/themes/template/index?key=4xfq26NPP');
        }
    }

    // Méthode de création d'un évènement

    /**
     * @throws Exception
     */
    public function creerEvenement(Evenement $event)
    {
        #Instancie la classe BDD
        $bdd = (new BDD)->getBase();
        $req = $bdd->prepare('SELECT nom FROM evenement WHERE nom = :nom');
        $req->execute([
            'nom' => $event->getNom()
        ]);
        $res = $req->fetch();

        if ($res) {
            # Si l'évènement existe dans la BDD.
            header('Location: /e5_php/template/themes/template/creer-evenement');
            throw new Exception('Cet évènement existe.');
        } else {
            $req = $bdd->prepare('INSERT INTO evenement (idCreateur, nom, description, organisateur, type, date, horaire, dateCreation, validEvent) VALUES (:idCreateur, :nom, :description, :organisateur, :type, :date, :horaire, NOW(), :validEvent)');
            $res2 = $req->execute([
                'idCreateur' => $event->getIdCreateur(),
                'nom' => $event->getNom(),
                'description' => $event->getDescription(),
                'organisateur' => $event->getOrganisateur(),
                'type' => $event->getType(),
                'date' => $event->getDate(),
                'horaire' => $event->getHoraire(),
                'validEvent' => $event->getValidEvent()
            ]);
            unset($_SESSION['erreur']);
            header('Location: /e5_php/template/themes/template/evenements');
            if (!$res2) {
                # Si un ou plusieurs champs sont vides.
                throw new Exception('Ajout échouée !');
            }
            return;
        }
        throw new Exception('Ajout échouée !');
    }

    // Méthode de liste d'évènements

    /**
     * @throws Exception
     */
    public function listeEvenement()
    {
        #Instancie la classe BDD
        $bdd = (new BDD)->getBase();
        $req = $bdd->prepare('SELECT * FROM evenement');
        $req->execute();
        return $req->fetchall();
    }

    // Méthode d'affichage d'un utilisateur dans la session 'show'

    /**
     * @throws Exception
     */
    public function chercheEvenement(Evenement $event)
    {
        // on appelle la base de données
        $bdd = (new BDD)->getBase();
        $req = $bdd->prepare('SELECT * FROM evenement WHERE idEvent = :idEvent');
        $req->execute([
            'idEvent' => $event->getIdEvent()
        ]);
        $res = $req->fetch();
        if ($res) {
            unset($_SESSION['erreur']);
            header('Location: /e5_php/template/themes/template/evenement-no?idEvent=' . $res['idEvent']);
            return $_SESSION['event'] = $res;
        } else {
            // sinon affiche un message d'erreur
            header('Location: /e5_php/template/themes/template/evenements');
            throw new Exception('Erreur pendant la recherche de l\'évènement.', 1);
        }
    }
}