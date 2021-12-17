<?php
require_once __DIR__ . '/../Manager.php';

// création de la classe ManaRdv
class ManaRdv extends Manager
{
// Méthode de création d'un évènement

    /**
     * @throws Exception
     */
    public function creerRdv(Rdv $rdv)
    {
        $statut = ['parent', 'professeur'];
        // On appelle la base de données
        $bdd = (new BDD)->getBase();
        $req = $bdd->query('SELECT * FROM rdv');
        $res = $req->fetchAll();

        // Cherche le créateur du rdv
        for ($i = 0; $i < 2; $i++) {
            // La requete passe dans une boucle qui lie la table utilisateur avec la table parent, puis professeur
            $req = $bdd->prepare('SELECT * FROM utilisateur INNER JOIN ' . $statut[$i] . ' ON ' . $statut[$i] . '.idUtil = utilisateur.idUtilisateur WHERE idUtilisateur = :idUtilisateur');
            $req->execute([
                'idUtilisateur' => $_SESSION['user']['idUtilisateur']
            ]);
            $res2 = $req->fetch();
            if (isset($res2['idParent'])) {
                // Si c'est un parent qui a créé.e le rdv, alors on retourne son id
                $idCreateurParent = $res2;
                break;
            } else if (isset($res2['idProf'])) {
                // Si c'est un professeur.e qui a créé.e le rdv, alors on retourne son id
                $idCreateurProf = $res2;
                break;
            }
        }
        // Cherche la personne invité au rdv
        if (isset($idCreateurProf)) {
            // Si c'est un professeur.e qui a créé.e le rdv, alors on cherche le parent qui est invité
            $req = $bdd->prepare('SELECT * FROM utilisateur INNER JOIN parent ON parent.idUtil = utilisateur.idUtilisateur WHERE idUtilisateur = :idUtilisateur');
            $req->execute([
                'idUtilisateur' => $_POST['idInviteParent']
            ]);
            $res3 = $req->fetch();
            if (isset($res3)) {
                $idInviteParent = $res3;
            }
        } else if (isset($idCreateurParent)) {
            // Si c'est un parent qui a créé.e le rdv, alors on cherche le.la professeur.e qui est invité
            $req = $bdd->prepare('SELECT * FROM professeur WHERE idProf = :idProf');
            $req->execute([
                'idProf' => $_POST['idInviteProf']
            ]);
            $res3 = $req->fetch();
            if (isset($res3)) {
                $idInviteProf = $res3;
            }
        }
        if (isset($idCreateurParent) && isset($idInviteProf) && date('N', strtotime($_POST['date'])) == 6) {
            // Si c'est un parent qui a créé.e le rdv, qu'on retrouve le.la professeur.e qui est invité.e et que son rdv
            // tombe un samedi, alors il va créer le rdv dans la BDD
            $req = $bdd->prepare('INSERT INTO rdv (objet, message, date, horaire, dateCreation, idCreateurParent, idInviteProf, validEvent) VALUES (:objet, :message, :date, :horaire, NOW(), :idCreateurParent, :idInviteProf, 1)');
            $res1 = $req->execute([
                'objet' => $rdv->getObjet(),
                'message' => $rdv->getMessage(),
                'date' => $rdv->getDate(),
                'horaire' => $rdv->getHoraire(),
                'idCreateurParent' => $idCreateurParent['idParent'],
                'idInviteProf' => $idInviteProf['idProf'],
            ]);
        } else if (isset($idCreateurProf) && isset($idInviteParent)) {
            // Si c'est un professeur.e qui a créé.e le rdv et qu'on retrouve le parent qui est invité.e, alors il va créer
            // le rdv dans la BDD
            $req = $bdd->prepare('INSERT INTO rdv (objet, message, date, horaire, dateCreation, idCreateurProf, idInviteParent, validEvent) VALUES (:objet, :message, :date, :horaire, NOW(), :idCreateurProf, :idInviteParent, 1)');
            $res1 = $req->execute([
                'objet' => $rdv->getObjet(),
                'message' => $rdv->getMessage(),
                'date' => $rdv->getDate(),
                'horaire' => $rdv->getHoraire(),
                'idCreateurProf' => $idCreateurProf['idProf'],
                'idInviteParent' => $idInviteParent['idParent'],
            ]);
        }
        // S'il créé avec succès le rdv, alors il retourne un succès.
        if ($res1) {
            unset($_SESSION['erreur']);
            return;
        }
        // Sinon, on affiche un message d'erreur
        throw new Exception('Ajout échouée !');
    }

// Méthode de liste de rdv

    /**
     * @throws Exception
     */
    public function listeRdv()
    {
        #Instancie la classe BDD
        $bdd = (new BDD)->getBase();
        $req = $bdd->query('SELECT * FROM rdv ORDER BY dateCreation DESC');
        return $req->fetchAll();
    }

// Méthode d'affichage d'un rendez-vous

    /**
     * @throws Exception
     */
    public function chercheRdv(Rdv $rdv)
    {
        // On appelle la base de données
        $bdd = (new BDD)->getBase();
        // Cherche le rdv choisi et son.sa créateur.rice
        if ($_SESSION['user']['statut'] === '2') {
            // Si l'auteur.e du rdv est un parent, il cherche le.la professeur.e invité.e
            $req = $bdd->prepare('SELECT * FROM rdv INNER JOIN parent ON parent.idParent = rdv.idCreateurParent INNER JOIN utilisateur ON utilisateur.idUtilisateur = parent.idUtil WHERE idRdv = :idRdv');
            $req->execute([
                'idRdv' => $rdv->getIdRdv()
            ]);
            $res2 = $req->fetch();
            // S'il trouve au moins un rdv, alors il retourne les valeurs
            return $res2;
        } else if ($_SESSION['user']['statut'] === '3') {
            // Si l'auteur.e du rdv est un professeur.e, il cherche le parent invité.e
            $req = $bdd->prepare('SELECT * FROM rdv INNER JOIN professeur ON professeur.idProf = rdv.idCreateurProf INNER JOIN utilisateur ON utilisateur.idUtilisateur = professeur.idUtil WHERE idRdv = :idRdv');
            $req->execute([
                'idRdv' => $rdv->getIdRdv()
            ]);
            $res2 = $req->fetch();
            // S'il trouve au moins un rdv, alors il retourne les valeurs
            return $res2;
        }
        // Sinon, on affiche un message d'erreur
        throw new Exception('Erreur pendant la recherche du rendez-vous.', 1);
    }

// Méthode d'annulation d'un rdv

    /**
     * @throws Exception
     */
    public function annuleRdv(Rdv $rdv)
    {
        // On appelle la base de données
        $bdd = (new BDD)->getBase();
        $req = $bdd->prepare('SELECT idRdv FROM rdv WHERE idRdv = :idRdv');
        $req->execute([
            'idRdv' => $rdv->getIdRdv()
        ]);
        $res = $req->fetch();
        // S'il trouve l'id du rdv, il va annuler celui-ci
        if ($res) {
            $req = $bdd->prepare('UPDATE rdv SET validEvent = 0 WHERE idRdv = :idRdv');
            $req->execute([
                'idRdv' => $rdv->getIdRdv()
            ]);
            unset($_SESSION['erreur']);
            return true;
        }
        // Sinon, on affiche un message d'erreur
        throw new Exception('Annulation échouée.', 1);
    }
}
