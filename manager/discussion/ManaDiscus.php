<?php
require_once __DIR__ . '/../Manager.php';

// création de la classe ManaDiscus
class ManaDiscus extends Manager
{
// Méthode de création d'une discussion

    /**
     * @throws Exception
     */
    public function creerDiscussion(Discussion $discus)
    {
        $statut = ['eleve', 'parent', 'professeur', 'administrateur'];
        // On appelle la base de données
        $bdd = (new BDD)->getBase();
        $req = $bdd->query('SELECT * FROM discussion');
        $res = $req->fetchAll();
        foreach ($res as $error) {
            // Vérifie les conditions lors de l'ajout d'une discussion.
            // S'il y a une erreur, la fonction s'arrête.
            switch ($error) {
                case ($error['titre'] == $_POST['titre']):
                    throw new Exception('Le titre de la discussion est déja pris.');
            }
        }
        for ($j = 0; $j < 4; $j++) {
            // Cherche l'id de la personne qui a créé la discussion
            $req = $bdd->prepare('SELECT * FROM utilisateur INNER JOIN ' . $statut[$j] . ' ON ' . $statut[$j] . '.idUtil = utilisateur.idUtilisateur WHERE idUtilisateur = :idUtilisateur');
            $req->execute([
                'idUtilisateur' => $_SESSION['user']['idUtilisateur']
            ]);
            $res2 = $req->fetch();
            if (isset($res2['idProf']) && $res2['idUtil'] == $_SESSION['user']['idUtilisateur'] || isset($res2['idEleve']) && $res2['idUtil'] == $_SESSION['user']['idUtilisateur']) {
                $idCreateur = $res2;
            }
            // Cherche l'id de la personne invitée dans la discussion
            $req = $bdd->prepare('SELECT * FROM utilisateur INNER JOIN ' . $statut[$j] . ' ON ' . $statut[$j] . '.idUtil = utilisateur.idUtilisateur WHERE idUtilisateur = :idUtilisateur');
            $req->execute([
                'idUtilisateur' => $_POST['idInvite']
            ]);
            $res3 = $req->fetch();
            if (isset($res3['idProf']) && $res3['idUtil'] != $_SESSION['user']['idUtilisateur'] || isset($res3['idEleve']) && $res3['idUtil'] != $_SESSION['user']['idUtilisateur']) {
                $idInvite = $res3;
                break;
            }
        }
        switch ($idCreateur['statut']) {
            // Si le créateur de la discussion est un étudiant
            case '1':
                if ($idInvite['statut'] === '1') {
                    // Si la personne invitée dans la discussion est un étudiant
                    $req = $bdd->prepare('INSERT INTO discussion (titre, description, dateCreation, idCreateurEleve, idInviteEleve) VALUES (:titre, :description, NOW(), :idCreateurEleve, :idInviteEleve)');
                    $res4 = $req->execute([
                        'titre' => $discus->getTitre(),
                        'description' => $discus->getDescription(),
                        'idCreateurEleve' => $idCreateur['idEleve'],
                        'idInviteEleve' => $idInvite['idEleve']
                    ]);
                } else {
                    // Si la personne invitée dans la discussion est un professeur
                    $req = $bdd->prepare('INSERT INTO discussion (titre, description, dateCreation, idCreateurEleve, idInviteProf) VALUES (:titre, :description, NOW(), :idCreateurEleve, :idInviteProf)');
                    $res4 = $req->execute([
                        'titre' => $discus->getTitre(),
                        'description' => $discus->getDescription(),
                        'idCreateurEleve' => $idCreateur['idEleve'],
                        'idInviteProf' => $idInvite['idProf']
                    ]);
                }
                break;
            // Si le créateur de la discussion est un professeur
            case '3':
                if ($idInvite['statut'] === '1') {
                    // Si la personne invitée dans la discussion est un étudiant
                    $req = $bdd->prepare('INSERT INTO discussion (titre, description, dateCreation, idCreateurProf, idInviteEleve) VALUES (:titre, :description, NOW(), :idCreateurProf, :idInviteEleve)');
                    $res4 = $req->execute([
                        'titre' => $discus->getTitre(),
                        'description' => $discus->getDescription(),
                        'idCreateurProf' => $idCreateur['idProf'],
                        'idInviteEleve' => $idInvite['idEleve']
                    ]);
                } else {
                    // Si la personne invitée dans la discussion est un professeur
                    $req = $bdd->prepare('INSERT INTO discussion (titre, description, dateCreation, idCreateurProf, idInviteProf) VALUES (:titre, :description, NOW(), :idCreateurProf, :idInviteProf)');
                    $res4 = $req->execute([
                        'titre' => $discus->getTitre(),
                        'description' => $discus->getDescription(),
                        'idCreateurProf' => $idCreateur['idProf'],
                        'idInviteProf' => $idInvite['idProf']
                    ]);
                }
                break;
        }
        // S'il créé avec succès la discussion, alors il retourne un succès.
        if ($res4) {
            unset($_SESSION['erreur']);
            return;
        }
        // Sinon, on affiche un message d'erreur
        throw new Exception('Ajout échouée !');
    }

// Méthode de liste de discusssion

    /**
     * @throws Exception
     */
    public function listeDiscussion()
    {
        #Instancie la classe BDD
        $bdd = (new BDD)->getBase();
        $req = $bdd->query('SELECT * FROM discussion ORDER BY dateCreation DESC');
        return $req->fetchAll();
    }

// Méthode d'affichage d'une discusssion

    /**
     * @throws Exception
     */
    public function chercheDiscussion(Discussion $discus)
    {
        $statut = ['eleve', 'professeur'];
        $id = ['Eleve', 'Prof'];
        $idDis = ['idCreateurEleve', 'idCreateurProf'];
        // on appelle la base de données
        $bdd = (new BDD)->getBase();
        $req = $bdd->prepare('SELECT * FROM discussion WHERE idDiscussion = :idDiscussion');
        $req->execute([
            'idDiscussion' => $discus->getIdDiscussion()
        ]);
        $res = $req->fetch();
        for ($i = 0; $i < 2; $i++) {
            for ($j = 0; $j < 2; $j++) {
                $req = $bdd->prepare('SELECT * FROM discussion INNER JOIN ' . $statut[$i] . ' ON ' . $statut[$i] . '.id' . $id[$i] . ' = discussion.' . $idDis[$j] . ' WHERE idDiscussion = :idDiscussion');
                $req->execute([
                    'idDiscussion' => $res[0]
                ]);
                $res2 = $req->fetch();
                if ($res2) {
                    break;
                }
            }
        }
        if ($res2) {
            unset($_SESSION['erreur']);
            return $res2;
        }
        // sinon affiche un message d'erreur
        throw new Exception('Erreur pendant la recherche de l\'évènement.', 1);
    }

// Méthode de réponse d'une discussion

    /**
     * @throws Exception
     */
    public function reponseDiscussion(Reponse $reponse)
    {
        $statut = ['eleve', 'professeur'];
        $bdd = (new BDD)->getBase();
        // Cherche l'id de l'auteur de la réponse
        $req = $bdd->query('SELECT idUtilisateur FROM utilisateur ORDER BY idUtilisateur DESC');
        $res2 = $req->fetchAll();
        foreach ($res2 as $user) {
            for ($j = 0; $j < 2; $j++) {
                $req = $bdd->prepare('SELECT * FROM utilisateur INNER JOIN ' . $statut[$j] . ' ON ' . $statut[$j] . '.idUtil = utilisateur.idUtilisateur WHERE idUtilisateur = :idUtilisateur');
                $req->execute([
                    'idUtilisateur' => $user[0]
                ]);
                $res3 = $req->fetch();
                if (isset($res3['idProf']) && $res3['idUtil'] == $_SESSION['user']['idUtilisateur'] || isset($res3['idEleve']) && $res3['idUtil'] == $_SESSION['user']['idUtilisateur']) {
                    $id = $res3;
                    break;
                }
            }
        }
        if ($id['statut'] === '1') {
            // Si la réponse vient d'un étudiant
            $req = $bdd->prepare('INSERT INTO reponse (reponse, dateCreation, idDiscussion, idCreateurEleve) VALUES (:reponse, NOW(), :idDiscussion, :idCreateurEleve)');
            $res4 = $req->execute([
                'reponse' => $reponse->getReponse(),
                'idDiscussion' => $reponse->getIdDiscussion(),
                'idCreateurEleve' => $id['idEleve']
            ]);
        } else {
            // Si la réponse vient d'un professeur
            $req = $bdd->prepare('INSERT INTO reponse (reponse, dateCreation, idDiscussion, idCreateurProf) VALUES (:reponse, NOW(), :idDiscussion, :idCreateurProf)');
            $res4 = $req->execute([
                'reponse' => $reponse->getReponse(),
                'idDiscussion' => $reponse->getIdDiscussion(),
                'idCreateurProf' => $id['idProf']
            ]);
        }
        // S'il créé avec succès l'évènement, alors il retourne un succès.
        if ($res4) {
            unset($_SESSION['erreur']);
            return true;
        }
        // sinon affiche un message d'erreur
        throw new Exception('Erreur pendant la recherche de l\'évènement.', 1);
    }

// Méthode de liste de réponse

    /**
     * @throws Exception
     */
    public function listeReponse()
    {
        $statut = ['eleve', 'professeur'];
        $id = ['Eleve', 'Prof'];
        $idDis = ['idCreateurEleve', 'idCreateurProf'];
        #Instancie la classe BDD
        $bdd = (new BDD)->getBase();
        $req = $bdd->query('SELECT idDiscussion FROM discussion ORDER BY dateCreation DESC');
        $res = $req->fetch();
        for ($i = 0; $i < 2; $i++) {
            for ($j = 0; $j < 2; $j++) {
                $req = $bdd->prepare('SELECT * FROM reponse INNER JOIN ' . $statut[$j] . ' ON ' . $statut[$j] . '.id' . $id[$j] . ' = reponse.' . $idDis[$i] . ' WHERE idDiscussion = :idDiscussion');
                $req->execute([
                    'idDiscussion' => $res[0]
                ]);
                $res2 = $req->fetch();
                if ($res2) {
                    $reponse = $res2;
                    break;
                }
            }
        }
        if ($reponse) {
            unset($_SESSION['erreur']);
            return $reponse;
        }
        // sinon affiche un message d'erreur
        throw new Exception('Erreur pendant la recherche de la ou les réponses.', 1);
    }
}