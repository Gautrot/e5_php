<?php
require_once __DIR__ . '/../Manager.php';

// création de la classe ManaParent
class ManaParent extends Manager
{
// Méthode de connexion pour un parent

    /**
     * @throws Exception
     */
    public function connexionParent(Parents $parent)
    {
        // Vérifie les conditions lors de la connection.
        // S'il y a une erreur, la fonction s'arrête.
        switch ($_POST) {
            case ($_POST['mdp'] == '' || $_POST['mdp'] == null):
                throw new Exception('Mot de passe vide.', 1);
            case ($_POST['login'] == '' || $_POST['login'] == null):
                throw new Exception('Login vide.', 1);
            case ($_POST['login'] == '' && $_POST['mdp'] == '' || $_POST['login'] == null && $_POST['mdp'] == null):
                throw new Exception('Champs vide.', 1);
        }

        // On appelle la base de données
        $bdd = (new BDD)->getBase();
        // Préparation de la requête pour la connexion d'un utilisateur
        $req = $bdd->prepare('SELECT idUtilisateur, login, mdp, statut, validUtilisateur FROM utilisateur WHERE login = :login');
        $req->execute([
            'login' => $parent->getLogin()
        ]);
        $res = $req->fetch();
        // Vérification du mot de passe entré par l'utilisateur.
        // Si le mot de passe est correct, alors la connexion est réussi et on entre dans le compte
        if (password_verify($_POST['mdp'], $res['mdp'])) {
            unset($_SESSION['erreur']);
            return $_SESSION['user'] = $res;
        }
        // Sinon, on affiche un message d'erreur
        throw new Exception('Erreur pendant la connexion.', 1);
    }

// Méthode d'inscription pour un parent

    /**
     * @throws Exception
     */
    public function inscrParent(Parents $parent)
    {
        // Encryptage du mot de passe
        $hash = password_hash($_POST['mdp'], PASSWORD_DEFAULT);
        // On appelle la base de données
        $bdd = (new BDD)->getBase();
        $req = $bdd->query('SELECT * FROM utilisateur');
        $res = $req->fetchAll();
        foreach ($res as $error) {
            // Vérifie les conditions lors de l'inscription d'un étudiant.
            // S'il y a une erreur, la fonction s'arrête.
            switch ($error) {
                case ($error['mail'] == $_POST['mail']):
                    throw new Exception('L\'adresse mél est déjà pris par un autre utilisateur.');
                case ($error['telephone'] == $_POST['telephone']):
                    throw new Exception('Le numéro de téléphone est déjà pris par un autre utilisateur.');
                case ($error['login'] == $_POST['login']):
                    throw new Exception('Le login est déjà pris par un autre utilisateur.');
                case ($error['nom'] == $_POST['nom'] && $error['prenom'] == $_POST['prenom']):
                    throw new Exception('Le nom et prénom sont déjà pris par un autre utilisateur.');
            }
        }
        // Préparation de l'ajout d'un étudiant dans la BDD
        $req = $bdd->prepare('
                INSERT INTO utilisateur (nom, prenom, dateNaissance, adresse, telephone, mail, login, mdp, statut) VALUES (:nom, :prenom, :dateNaissance, :adresse, :telephone, :mail, :login, :mdp, 2);
                INSERT INTO parent (metier, idUtil) VALUES (:metier, LAST_INSERT_ID());
            ');
        // Execution de la requête
        $req->execute([
            'nom' => $parent->getNom(),
            'prenom' => $parent->getPrenom(),
            'dateNaissance' => $parent->getDateNaissance(),
            'adresse' => $parent->getAdresse(),
            'telephone' => $parent->getTelephone(),
            'mail' => $parent->getMail(),
            'login' => $parent->getLogin(),
            'mdp' => $hash,
            'metier' => $parent->getMetier()
        ]);
        $req = $bdd->prepare('SELECT idUtilisateur, login, mdp, statut, validUtilisateur FROM utilisateur WHERE login = :login');
        $req->execute([
            'login' => $parent->getLogin()
        ]);
        $res2 = $req->fetch();
        // Si un parent a un enfant, il ajoutera son id en tant qu'id de l'étudiant dans "responsable"
        if (isset($_POST['idEleve']) && $_POST['idEleve'] !== '') {
            $req = $bdd->prepare('SELECT idParent FROM parent WHERE idUtil = :idUtil');
            $req->execute([
                'idUtil' => $res2['idUtilisateur']
            ]);
            $res3 = $req->fetch();
            $req = $bdd->prepare('INSERT INTO responsable (idParent, idEleve) VALUES (:idParent, :idEleve)');
            $req->execute([
                'idParent' => $res3['idParent'],
                'idEleve' => $parent->getIdEleve()
            ]);
        }
        // S'il créé avec succès le parent, alors il envoie la session.
        if ($res2 || $res3) {
            unset($_SESSION['erreur']);
            return $_SESSION['user'] = $res2;
        }
        // Sinon, on affiche un message d'erreur
        throw new Exception('Erreur.');
    }

// Méthode de modification d'un parent

    /**
     * @throws Exception
     */
    public function modifParent(Parents $parent)
    {
        // Encryptage du mot de passe
        $hash = password_hash($_POST['mdp'], PASSWORD_DEFAULT);
        // On appelle la base de données
        $bdd = (new BDD)->getBase();
        $req = $bdd->query('SELECT * FROM utilisateur');
        $res = $req->fetchAll();
        foreach ($res as $error) {
            // Vérifie les conditions lors de la modification d'un étudiant.
            // S'il y a une erreur, la fonction s'arrête.
            switch ($error) {
                case ($error['mail'] == $_POST['mail'] && $error['idUtilisateur'] != $_SESSION['user']['idUtilisateur']):
                    throw new Exception('L\'adresse mél est déjà pris par un autre utilisateur.');
                case ($error['telephone'] == $_POST['telephone'] && $error['idUtilisateur'] != $_SESSION['user']['idUtilisateur']):
                    throw new Exception('Le numéro de téléphone est déjà pris par un autre utilisateur.');
                case ($error['login'] == $_POST['login'] && $error['idUtilisateur'] != $_SESSION['user']['idUtilisateur']):
                    throw new Exception('Le login est déjà pris par un autre utilisateur.');
                case ($error['nom'] == $_POST['nom'] && $error['prenom'] == $_POST['prenom'] && $error['idUtilisateur'] != $_SESSION['user']['idUtilisateur']):
                    throw new Exception('Le nom et prénom sont déjà pris par un autre utilisateur.');
            }
        }
        $req = $bdd->prepare('UPDATE utilisateur SET nom = :nom, prenom = :prenom, dateNaissance = :dateNaissance, adresse = :adresse, telephone = :telephone, mail = :mail, login = :login, mdp = :mdp WHERE idUtilisateur = :idUtilisateur');
        $req->execute([
            'idUtilisateur' => $parent->getIdUtilisateur(),
            'nom' => $parent->getNom(),
            'prenom' => $parent->getPrenom(),
            'dateNaissance' => $parent->getDateNaissance(),
            'adresse' => $parent->getAdresse(),
            'telephone' => $parent->getTelephone(),
            'mail' => $parent->getMail(),
            'login' => $parent->getLogin(),
            'mdp' => $hash
        ]);
        $req = $bdd->prepare('SELECT idUtilisateur, login, mdp, statut, validUtilisateur FROM utilisateur WHERE idUtilisateur = :idUtilisateur');
        $req->execute([
            'idUtilisateur' => $parent->getIdUtilisateur()
        ]);
        $res2 = $req->fetch();
        // S'il modifie avec succès l'étudiant, alors il envoie la session.
        if ($res2) {
            unset($_SESSION['erreur']);
            return $_SESSION['user'] = $res2;
        }
        // Sinon, on affiche un message d'erreur
        throw new Exception('Modification échouée !');
    }
}
