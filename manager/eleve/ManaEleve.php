<?php
require_once __DIR__ . '/../Manager.php';

// création de la classe ManaEleve
class ManaEleve extends Manager
{
    // Méthode d'inscription pour un étudiant

    /**
     * @throws Exception
     */
    public function inscriptionEleve(Eleve $eleve)
    {
        $bdd = (new BDD)->getBase();
        $req = $bdd->query('SELECT * FROM utilisateur');
        $res = $req->fetchAll();
        foreach ($res as $user) {
            // Vérifie les conditions lors de l'inscription d'un étudiant.
            // S'il y a une erreur, la fonction s'arrête.
            switch ($user) {
                case ($user['mail'] == $_POST['mail']):
                    throw new Exception('L\'adresse mél existe déjà.');
                case ($user['telephone'] == $_POST['telephone']):
                    throw new Exception('Le numéro de téléphone existe déjà.');
                case ($user['login'] == $_POST['login']):
                    throw new Exception('Le login existe déjà.');
                case ($user['nom'] == $_POST['nom'] && $user['prenom'] == $_POST['prenom']):
                    throw new Exception('L\'utilisateur existe déjà.');
            }
        }
        // Préparation de l'ajout d'un utilisateur dans la BDD
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
        $req = $bdd->prepare('SELECT idUtilisateur, login, mdp, statut, validUtilisateur FROM utilisateur WHERE login = :login');
        $req->execute([
            'login' => $eleve->getLogin()
        ]);
        $res2 = $req->fetch();
        // S'il créé avec succès l'utilisateur, alors il envoie la session.
        if ($res2) {
            unset($_SESSION['erreur']);
            return $_SESSION['user'] = $res2;
        }
        throw new Exception('Erreur.');
    }
}