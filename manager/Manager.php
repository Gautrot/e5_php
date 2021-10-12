<?php

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
            //header("Location: ../view/admin/table-util");
            return $_SESSION['user'] = $res;
        } else {
            // sinon affiche un message d'erreur
            header('Location: ../template/themes/template/index.php');
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

    // Méthode de recherche d'un utilisateur
    public function retourUtil(Utilisateur $user)
    {
        unset($_SESSION['show']);
        return header('Location: ../view/admin/table-util');
    }
}
