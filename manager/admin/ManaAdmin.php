<?php
require_once __DIR__ . '/../Manager.php';

// création de la classe ManaAdmin
class ManaAdmin extends Manager
{
// Méthode de modification d'un étudiant

    /**
     * @throws Exception
     */
    public function modifAdmin(Administrateur $admin)
    {
        // On appelle la base de données
        $bdd = (new BDD)->getBase();
        $req = $bdd->query('SELECT * FROM utilisateur');
        $res = $req->fetchAll();
        foreach ($res as $error) {
            // Vérifie les conditions lors de la modification d'un administrateur.
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
            'idUtilisateur' => $admin->getIdUtilisateur(),
            'nom' => $admin->getNom(),
            'prenom' => $admin->getPrenom(),
            'dateNaissance' => $admin->getDateNaissance(),
            'adresse' => $admin->getAdresse(),
            'telephone' => $admin->getTelephone(),
            'mail' => $admin->getMail(),
            'login' => $admin->getLogin(),
            'mdp' => $admin->getMdp()
        ]);
        $req = $bdd->prepare('SELECT idUtilisateur, login, mdp, statut, validUtilisateur FROM utilisateur WHERE idUtilisateur = :idUtilisateur');
        $req->execute([
            'idUtilisateur' => $admin->getIdUtilisateur()
        ]);
        $res2 = $req->fetch();
        // S'il modifie avec succès l'administrateur, alors il envoie la session.
        if ($res2) {
            unset($_SESSION['erreur']);
            return $_SESSION['user'] = $res2;
        }
        // Sinon, on affiche un message d'erreur
        throw new Exception('Modification échouée !');
    }

// Méthode de création d'un utilisateur

    /**
     * @throws Exception
     */
    public function creerUtil(Utilisateur $user)
    {
        // On appelle la base de données
        $bdd = (new BDD)->getBase();
        $req = $bdd->query('SELECT * FROM utilisateur');
        $res = $req->fetchAll();
        foreach ($res as $error) {
            // Vérifie les conditions lors de l'ajout d'un utilisateur.
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
        // S'il créé avec succès l'utilisateur, alors il retourne un succès.
        if ($res2) {
            unset($_SESSION['erreur']);
            return;
        }
        // Sinon, on affiche un message d'erreur
        throw new Exception('Ajout échouée !');
    }

// Méthode de création d'un compte élève

    /**
     * @throws Exception
     */
    public function creerEleve(Eleve $eleve)
    {
        // On appelle la base de données
        $bdd = (new BDD)->getBase();
        $req = $bdd->query('SELECT * FROM utilisateur');
        $res = $req->fetchAll();
        foreach ($res as $error) {
            // Vérifie les conditions lors de l'ajout d'un étudiant.
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
        // S'il créé avec succès l'étudiant, alors il retourne un succès.
        if ($res2) {
            unset($_SESSION['erreur']);
            return;
        }
        // Sinon, on affiche un message d'erreur
        throw new Exception('Ajout échouée !');
    }

// Méthode de création d'un compte parent

    /**
     * @throws Exception
     */
    public function creerParent(Parents $parent)
    {
        // On appelle la base de données
        $bdd = (new BDD)->getBase();
        $req = $bdd->query('SELECT * FROM utilisateur');
        $res = $req->fetchAll();
        foreach ($res as $error) {
            // Vérifie les conditions lors de l'ajout d'un parent.
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
        // S'il créé avec succès le parent, alors il retourne un succès.
        if ($res2) {
            unset($_SESSION['erreur']);
            return;
        }
        // Sinon, on affiche un message d'erreur
        throw new Exception('Ajout échouée !');
    }

// Méthode de création d'un compte professeur

    /**
     * @throws Exception
     */
    public function creerProf(Professeur $prof)
    {
        // On appelle la base de données
        $bdd = (new BDD)->getBase();
        $req = $bdd->query('SELECT * FROM utilisateur');
        $res = $req->fetchAll();
        foreach ($res as $error) {
            // Vérifie les conditions lors de l'ajout d'un professeur.
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
        // S'il créé avec succès le professeur, alors il retourne un succès.
        if ($res2) {
            unset($_SESSION['erreur']);
            return;
        }
        // Sinon, on affiche un message d'erreur
        throw new Exception('Ajout échouée !');
    }

// Méthode de création d'un compte administrateur

    /**
     * @throws Exception
     */
    public function creerAdmin(Administrateur $admin)
    {
        // On appelle la base de données
        $bdd = (new BDD)->getBase();
        $req = $bdd->query('SELECT * FROM utilisateur');
        $res = $req->fetchAll();
        foreach ($res as $error) {
            // Vérifie les conditions lors de l'ajout d'un administrateur.
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
        // S'il créé avec succès l'administrateur, alors il retourne un succès.
        if ($res2) {
            unset($_SESSION['erreur']);
            return;
        }
        // Sinon, on affiche un message d'erreur
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
            return;
        }
        # Si le compte n'existe pas dans la BDD.
        throw new Exception('Ce compte n\'existe pas.');
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
            $req->execute([
                'idUtilisateur' => $user->getIdUtilisateur()
            ]);
            unset($_SESSION['erreur']);
            return;
        }
        # Si le compte n'existe pas dans la BDD.
        throw new Exception('Ce compte n\'existe pas.');
    }
}