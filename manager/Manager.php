<?php

ini_set('display_errors',1); error_reporting(E_ALL | E_STRICT);

//on appelle la classe manager et toolsManager
require $_SERVER['DOCUMENT_ROOT'].'/e5_php/vendor/autoload.php';
require_once($_SERVER['DOCUMENT_ROOT']."/e5_php/manager/Manager.php");


use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
//On appelle la classe PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require $_SERVER['DOCUMENT_ROOT'].'/e5_php/vendor/phpmailer/phpmailer/src/Exception.php';
require $_SERVER['DOCUMENT_ROOT'].'/e5_php/vendor/phpmailer/phpmailer/src/PHPMailer.php';
require $_SERVER['DOCUMENT_ROOT'].'/e5_php/vendor/phpmailer/phpmailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.example.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'n.sedjai@lprs.fr';                     //SMTP username
    $mail->Password   = 'BTSNO=2020';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('from@example.com', 'Mailer');
    $mail->addAddress('joe@example.net', 'Joe User');     //Add a recipient
    $mail->addAddress('ellen@example.com');               //Name is optional
    $mail->addReplyTo('info@example.com', 'Information');
    $mail->addCC('cc@example.com');
    $mail->addBCC('bcc@example.com');

    //Attachments
    $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Here is the subject';
    $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

// utilisation du fichier BDD.php
require_once '../model/BDD.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// création de la classe manager
class Manager
{
    // Méthode de connexion
    public function connexion(Utilisateur $user)
    {
        // on appelle la base de données
        $bdd = (new BDD)->getBase();

        // gestion d'erreur : si l'utilisateur ne rentre rien pour le login ou le mot de passe alors le message "champ vide" apparaitra
        /*if ($user->getLogin() === '' && $user->getMdp() == '' || $user->getLogin() === null  && $user->getMdp() === null) {
            throw new Exception("Champs vide", 1);
        }
        if ($user->getLogin() === ''  || $user->getLogin() === null) {
            throw new Exception("Login vide", 1);
        }
        if ($user->getMdp() === '' || $user->getMdp() === null) {
            throw new Exception("Mot de passe vide", 1);
        }*/

        // préparation de la requête pour la connexion d'un utilisateur
        $req = $bdd->prepare("SELECT login, mdp FROM utilisateur WHERE login = :login AND mdp = :mdp");
        $req->execute([
            'login' => $user->getLogin(),
            'mdp' => $user->getMdp()
        ]);
        $res = $req->fetch();

        // vérification du mot de passe entré par l'utilisateur :
        // si le mot de passe est correct alors la connexion est réussi et on entre dans le compte
        if (password_verify($user->getMdp(), $res['mdp']) || $res['mdp']) {
            // Dirige vers la page 'table-util' (temporaire) - Alex
            header("Location: ../view/admin/table-util");
            return $_SESSION['user'] = $res;
        } else {
            // sinon affiche un message d'erreur
            //header('Location: ../template/themes/template/index.php');
            throw new Exception("Erreur pendant la connexion.", 1);
        }
    }

    // Méthode de déconnexion
    public function deconnexion()
    {
        session_destroy();
        // redirection vers la page index.php
        header("Location: ../index.php");
    }

    // Méthode d'inscription pour un utilisateur
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
            throw new Exception("L'utilisateur deja existant.");
        }

        //si les getters sont différents de rien alors :
        if ($user->getNom() != '' and $user->getPrenom() != '' and $user->getMail() != '' and $user->getLogin() != '' and $user->getMdp() != '') {
            // création de l'objet bdd pour s'y connecter
            $bdd = (new BDD)->getBase();
            // preparation de la requête
            $req = $bdd->prepare('INSERT INTO
            utilisateur (nom, prenom, dateNaissance, adresse, telephone, mail, login, mdp, statut, validUtilisateur)
            VALUES (:nom, :prenom, :dateNaissance, :adresse, :telephone, :mail, :login, :mdp, :statut, :validUtilisateur)
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
                'mdp' => $user->getMdp(),
                'statut' => $user->getStatut(),
                'validUtilisateur' => $user->setValidUtilisateur(0)
            ]);

            $res = $req->fetch();

            if ($res) {
                $_SESSION['mdp'] = $res['mdp'];
                header('Location: ../index');
            } // sinon redirection vers la page inscription.php
            else {
                header('Location: ../index');
            }
        }
    }

    // Méthode de création d'un utilisateur
    public function creerUtil(Utilisateur $user)
    {
        #Instancie la classe BDD
        $bdd = (new BDD)->getBase();
        $req = $bdd->prepare('SELECT mail FROM utilisateur WHERE mail = :mail');
        $req->execute([
            'mail' => $user->getMail()
        ]);
        $res = $req->fetchall();

        if ($res) {
            # Si le compte existe dans la BDD.
            header("Location: ../view/admin/table-util");
            throw new Exception("Ce compte existe.");
        } else {
            $req = $bdd->prepare('INSERT INTO utilisateur (nom, prenom, dateNaissance, adresse, telephone, mail, statut, validUtilisateur) VALUES (:nom, :prenom, :dateNaissance, :adresse, :telephone, :mail, :statut, :validUtilisateur)');
            $res2 = $req->execute([
                'nom' => $user->getNom(),
                'prenom' => $user->getPrenom(),
                'dateNaissance' => $user->getDateNaissance(),
                'adresse' => $user->getAdresse(),
                'telephone' => $user->getTelephone(),
                'mail' => $user->getMail(),
                'login' => $user->getLogin(),
                'mdp' => $user->getMdp(),
                'statut' => $user->getStatut(),
                'validUtilisateur' => $user->getValidUtilisateur()
            ]);

            if ($res2) {
                header("Location: ../view/admin/table-util");
            } else {
                # Si un ou plusieurs champs sont vides.
                header("Location: ../view/admin/table-util");
                throw new Exception("Ajout échouée !");
            }
        }
    }

    // Méthode d'activation d'un utilisateur
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

            if ($req) {
                header("Location: ../../view/admin/table-util");
            } else {
                header("Location: ../../view/admin/table-util");
                throw new Exception("Activation échouée !");
            }
        } else {
            # Si le compte existe dans la BDD.
            header("Location: ../../view/admin/table-util");
            throw new Exception("Ce compte n'existe pas.");
        }
    }

    // Méthode de désactivation d'un utilisateur
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

            if ($res2) {
                header("Location: ../../view/admin/table-util");
            } else {
                header("Location: ../../view/admin/table-util");
                throw new Exception("Désactivation échouée !");
            }
        } else {
            # Si le compte existe dans la BDD.
            header("Location: ../../view/admin/table-util");
            throw new Exception("Ce compte n'existe pas.");
        }
    }

    // Méthode de recherche d'un utilisateur
    public function chercheUtil(Utilisateur $user)
    {
        // on appelle la base de données
        $bdd = (new BDD)->getBase();
        $req = $bdd->prepare("SELECT * FROM utilisateur WHERE idUtilisateur = :idUtilisateur");
        $req->execute([
            'idUtilisateur' => $user->getIdUtilisateur()
        ]);
        $res = $req->fetch();
        if ($res) {
            switch ($res['statut']) {
                case '1':
                    $req = $bdd->prepare("SELECT * FROM utilisateur INNER JOIN eleve ON eleve.statut = utilisateur.statut WHERE idUtilisateur = :idUtilisateur ");
                    break;
                case '2':
                    $req = $bdd->prepare("SELECT * FROM utilisateur INNER JOIN parent ON parent.statut = utilisateur.statut WHERE idUtilisateur = :idUtilisateur ");
                    break;
                case '3':
                    $req = $bdd->prepare("SELECT * FROM utilisateur INNER JOIN professeur ON professeur.statut = utilisateur.statut WHERE idUtilisateur = :idUtilisateur ");
                    break;
                case '4':
                    $req = $bdd->prepare("SELECT * FROM utilisateur INNER JOIN administrateur ON administrateur.statut = utilisateur.statut WHERE idUtilisateur = :idUtilisateur ");
                    break;
                default:
                    $req = $bdd->prepare("SELECT * FROM utilisateur WHERE idUtilisateur = :idUtilisateur ");
                    break;
            }
            $req->execute([
                'idUtilisateur' => $user->getIdUtilisateur(),
            ]);
            $res2 = $req->fetch();
            header("Location: ../view/utilisateur?idUtilisateur=" . $res2['idUtilisateur']);
            return $_SESSION['show'] = $res2;
        } else {
            // sinon affiche un message d'erreur
            header('Location: ../view/admin/table-util');
            throw new Exception("Erreur pendant la recherche de l'utilisateur.", 1);
        }
    }
    //Methode pour envoyer un mail et changer son mdp
    function MDPoublie($mail_user){
        $bdd = (new BDD)->getBase();

        // on récupère l'utilisateur ayant perdu son mot de passe
        $request = $bdd->prepare("SELECT * FROM utilisateur WHERE mail = :mail");
        $request->execute(array($mail_user));
        $profil = $request->fetch();

        var_dump($profil);

        //Si l'adresse email correspont à aucun mail et donc aucun utilisateur
        if(!$profil){
            header("Location:../../e5_php/template/themes/template/index.html?err=mail&mail=".$mail_user);

        }
        else{


            $select_idUtilisateur = '';
            var_dump($select_idUtilisateur);

            $body = '<!doctype html>
<html>
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
                        <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;">Bienvenue sur le Snack LPRS !</p>
                        <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;">Vous avez oubli&#233; votre mot de passe ? </p>
                        <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;">

Pas de probl&#232;me, cliquez sur le bouton pour acceder &#224; un changement de mot de passe.
</p>
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;"> Si vous n avez pas fait cette demande ignorez ce mail et changez votre mot de passe via votre interface.  </p>
                        <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="btn btn-primary" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; box-sizing: border-box; min-width: 100%; width: 100%;" width="100%">
                          <tbody>
                            <tr>
                              <td align="left" style="font-family: sans-serif; font-size: 14px; vertical-align: top; padding-bottom: 15px;" valign="top">
                                <table role="presentation" border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: auto; width: auto;">
                                  <tbody>
                                    <tr>
                                      <td style="font-family: sans-serif; font-size: 14px; vertical-align: top; border-radius: 5px; text-align: center; background-color: #ec0867;" valign="top" align="center" bgcolor="#ec0867"> <a href="https://snacklprs.fr/Projet_snack/view/Mdp&MessageEtudiant/formulaire_update_password.php?mail='.$mail_user.'" target="_blank" style="border: solid 1px #ec0867; border-radius: 5px; box-sizing: border-box; cursor: pointer; display: inline-block; font-size: 14px; font-weight: bold; margin: 0; padding: 12px 25px; text-decoration: none; text-transform: capitalize; background-color: #ec0867; border-color: #ec0867; color: #ffffff;">Changer son mot de passe</a> </td>
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

            $this->mail("Mot de passe oublie",$body,$select_idUser,$mail_user);
            header("Location:../../index.html?key=4xfq26NPP");

        }
    }

    // Méthode de recherche d'un utilisateur
    public function retourUtil(Utilisateur $user)
    {
        unset($_SESSION['show']);
        return header('Location: ../view/admin/table-util');
    }
}
