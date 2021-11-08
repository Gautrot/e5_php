<?php
require_once __DIR__ . '/../Manager.php';

// création de la classe ManaEleve
class ManaEleve extends Manager
{
// Méthode d'inscription pour un étudiant

    /**
     * @throws Exception
     */
    public function inscrEleve(Eleve $eleve)
    {
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
                INSERT INTO utilisateur (nom, prenom, dateNaissance, adresse, telephone, mail, login, mdp, statut) VALUES (:nom, :prenom, :dateNaissance, :adresse, :telephone, :mail, :login, :mdp, :statut);
                INSERT INTO eleve (idEleve, classe) VALUES (LAST_INSERT_ID(), :classe);
            ');
        // Execution de la requête
        $req->execute([
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
        $req = $bdd->query('SELECT idUtilisateur, login, mdp, statut, validUtilisateur FROM utilisateur WHERE login = :login');
        $req->execute([
            'login' => $eleve->getLogin()
        ]);
        $res2 = $req->fetch();
        // S'il créé avec succès l'étudiant, alors il envoie la session.
        if ($res2) {
            unset($_SESSION['erreur']);
            return $_SESSION['user'] = $res2;
        }
        // Sinon, on affiche un message d'erreur
        throw new Exception('Erreur.');
    }

// Méthode de modification d'un étudiant

    /**
     * @throws Exception
     */
    public function modifEleve(Eleve $eleve)
    {
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
            'idUtilisateur' => $eleve->getIdUtilisateur(),
            'nom' => $eleve->getNom(),
            'prenom' => $eleve->getPrenom(),
            'dateNaissance' => $eleve->getDateNaissance(),
            'adresse' => $eleve->getAdresse(),
            'telephone' => $eleve->getTelephone(),
            'mail' => $eleve->getMail(),
            'login' => $eleve->getLogin(),
            'mdp' => $eleve->getMdp()
        ]);
        $req = $bdd->prepare('SELECT idUtilisateur, login, mdp, statut, validUtilisateur FROM utilisateur WHERE idUtilisateur = :idUtilisateur');
        $req->execute([
            'idUtilisateur' => $eleve->getIdUtilisateur()
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