<?php
include '../Manager.php';

// création de la classe ManaAdmin
class ManaAdmin
{
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

    // Méthode de suppression de la session 'show'

    public function retourUtilAdmin()
    {
        unset($_SESSION['show']);
        header('Location: /e5_php/template/themes/template/table-util');
    }
}