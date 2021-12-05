<?php
require_once __DIR__ . '/../Manager.php';

// création de la classe ManaEvent
class ManaEvent extends Manager
{
// Méthode de création d'un évènement

    /**
     * @throws Exception
     */
    public function creerEvenement(Evenement $event)
    {
        $statut = ['eleve', 'professeur'];
        // On appelle la base de données
        $bdd = (new BDD)->getBase();
        $req = $bdd->query('SELECT * FROM evenement');
        $res = $req->fetchAll();
        foreach ($res as $error) {
            // Vérifie les conditions lors de l'ajout d'un évènement.
            // S'il y a une erreur, la fonction s'arrête.
            if ($error == (($error['titre'] == $_POST['titre']))) {
                throw new Exception('Le nom est déja pris dans un autre évènement.');
            }
        }
        // Cherche l'id d'un étudiant ou d'un professeur de l'établissement avec l'id de l'utilisateur
        for ($i = 0; $i < 2; $i++) {
            $req = $bdd->prepare('SELECT * FROM utilisateur INNER JOIN ' . $statut[$i] . ' ON ' . $statut[$i] . '.idUtil = utilisateur.idUtilisateur WHERE idUtilisateur = :idUtilisateur');
            $req->execute([
                'idUtilisateur' => $_SESSION['user']['idUtilisateur']
            ]);
            $res2 = $req->fetch();
            // S'il l'id de l'utilisateur correspond à l'id d'un étudiant ou d'un professeur de l'établissement,
            // il retourne l'id et le statut de celui-ci
            if (isset($res2['idProf']) || isset($res2['idEleve'])) {
                break;
            }
        }
        if ($res2['statut'] === '1') {
            // Si l'organisateur principal est un étudiant, il va ajouter l'évènement, inscrire l'étudiant
            // et le placer en tant qu'organisateur
            $req = $bdd->prepare('
                INSERT INTO evenement (titre, description, type, date, horaire, dateCreation, validEvent, idCreateurEleve) VALUES (:titre, :description, :type, :date, :horaire, NOW(), :validEvent, :idCreateurEleve);
                INSERT INTO inscription_event (idEleve, idEvent) VALUES (:idEleve, LAST_INSERT_ID());
            ');
            $res3 = $req->execute([
                'titre' => $event->getTitre(),
                'description' => $event->getDescription(),
                'type' => 'Interne',
                'date' => $event->getDate(),
                'horaire' => $event->getHoraire(),
                'validEvent' => 0,
                'idCreateurEleve' => $res2['idEleve'],
                'idEleve' => $res2['idEleve']
            ]);
        } else {
            // Si l'organisateur principal est un professeur, il va ajouter l'évènement, inscrire le professeur
            // et le placer en tant qu'organisateur
            $req = $bdd->prepare('
                INSERT INTO evenement (titre, description, type, date, horaire, dateCreation, validEvent, idCreateurProf) VALUES (:titre, :description, :type, :date, :horaire, NOW(), :validEvent, :idCreateurProf);
                INSERT INTO inscription_event (idProf, idEvent) VALUES (:idProf, LAST_INSERT_ID());
            ');
            $res3 = $req->execute([
                'titre' => $event->getTitre(),
                'description' => $event->getDescription(),
                'type' => $event->getType(),
                'date' => $event->getDate(),
                'horaire' => $event->getHoraire(),
                'validEvent' => 1,
                'idCreateurProf' => $res2['idProf'],
                'idProf' => $res2['idProf']
            ]);
        }
        // S'il créé avec succès l'évènement, alors il retourne un succès.
        if ($res3) {
            unset($_SESSION['erreur']);
            return true;
        }
        // Sinon, on affiche un message d'erreur
        throw new Exception('Ajout échouée !');
    }

// Méthode de liste d'évènements

    /**
     * @throws Exception
     */
    public function listeEvenement()
    {
        // On appelle la base de données
        $bdd = (new BDD)->getBase();
        $req = $bdd->query('SELECT * FROM evenement ORDER BY dateCreation DESC');
        // Il retourne tous les évènements dans la table
        return $req->fetchAll();
    }

// Méthode d'affichage d'un évènement

    /**
     * @throws Exception
     */
    public function chercheEvenement(Evenement $event)
    {
        $statut = ['eleve', 'professeur', 'parent'];
        $idStatut = ['idEleve', 'idProf', 'idParent'];
        $idCreateur = ['idCreateurEleve', 'idCreateurProf', 'idCreateurParent'];
        // On appelle la base de données
        $bdd = (new BDD)->getBase();
        // Cherche l'évènement choisi et son/ses organisateurs
        for ($i = 0; $i < 3; $i++) {
            $req = $bdd->prepare('SELECT * FROM evenement INNER JOIN ' . $statut[$i] . ' ON ' . $statut[$i] . '.' . $idStatut[$i] . ' = evenement.' . $idCreateur[$i] . ' WHERE idEvent = :idEvent');
            $req->execute([
                'idEvent' => $event->getIdEvent()
            ]);
            $res2 = $req->fetch();
            // S'il trouve au moins un évènement, alors il retourne les valeurs
            if ($res2) {
                break;
            }
        }
        for ($j = 0; $j < 3; $j++) {
            // Il vérifie si l'utilisateur est déjà inscrit dans l'évènement
            $req = $bdd->prepare('
                SELECT * FROM utilisateur
                INNER JOIN ' . $statut[$j] . ' ON ' . $statut[$j] . '.idUtil = utilisateur.idUtilisateur
                INNER JOIN inscription_event ON inscription_event.' . $idStatut[$j] . ' = ' . $statut[$j] . '.' . $idStatut[$j] . '
                WHERE utilisateur.idUtilisateur = :idUtilisateur
            ');
            $req->execute([
                'idUtilisateur' => $_SESSION['user']['idUtilisateur']
            ]);
            $res3 = $req->fetch();
            if (isset($res3['idInscription']) && $res3[$idStatut[$j]] !== $res2[$idCreateur[$j]]) {
                // S'il trouve au moins un utilisateur et qu'il est déjà inscrit dans l'évènement,
                // alors il retourne les valeurs avec le bouton "Inscrit.e" qui s'affiche
                unset($_SESSION['erreur']);
                $res2 = array_splice($res2, 0,-12);
                return $res3 + $res2;
            } elseif (isset($res3['idInscription']) && $res3[$idStatut[$j]] === $res2[$idCreateur[$j]]) {
                // S'il trouve au moins un utilisateur et qu'il est l'organisateur de l'évènement,
                // alors il retourne les valeurs avec les boutons "Inscrit.e", "Valider" et "Annuler" qui s'affichent
                unset($_SESSION['erreur']);
                return $res3 + $res2;
            }
        }
        if ($res2) {
            // Sinon, il affiche les valeurs avec le bouton "S'inscrire" qui s'affiche
            unset($_SESSION['erreur']);
            return $res2;
        }
        // Sinon, on affiche un message d'erreur
        throw new Exception('Erreur pendant la recherche de l\'évènement.', 1);
    }

// Méthode d'annulation d'un évènement

    /**
     * @throws Exception
     */
    public function annuleEvenement(Evenement $event)
    {
        // On appelle la base de données
        $bdd = (new BDD)->getBase();
        $req = $bdd->prepare('SELECT idEvent FROM evenement WHERE idEvent = :idEvent');
        $req->execute([
            'idEvent' => $event->getIdEvent()
        ]);
        $res = $req->fetch();
        // S'il trouve l'id de l'évènement, il va annuler celui-ci
        if ($res) {
            $req = $bdd->prepare('UPDATE evenement SET validEvent = 0 WHERE idEvent = :idEvent');
            $req->execute([
                'idEvent' => $event->getIdEvent()
            ]);
            unset($_SESSION['erreur']);
            return true;
        }
        // Sinon, on affiche un message d'erreur
        throw new Exception('Annulation échouée.', 1);
    }

// Méthode de validation d'un évènement

    /**
     * @throws Exception
     */
    public function valideEvenement(Evenement $event)
    {
        // On appelle la base de données
        $bdd = (new BDD)->getBase();
        $req = $bdd->prepare('SELECT idEvent FROM evenement WHERE idEvent = :idEvent');
        $req->execute([
            'idEvent' => $event->getIdEvent()
        ]);
        $res = $req->fetch();
        // S'il trouve l'id de l'évènement, il va valider celui-ci et ajouter automatiquement le professeur
        if ($res) {
            // Cherche l'id du professeur
            $req = $bdd->prepare('SELECT * FROM utilisateur INNER JOIN professeur ON professeur.idUtil = utilisateur.idUtilisateur WHERE idUtilisateur = :idUtilisateur');
            $req->execute([
                'idUtilisateur' => $_SESSION['user']['idUtilisateur']
            ]);
            $res2 = $req->fetch();
            // S'il trouve le professeur, il va ajouter son id dans le createur de l'organisation
            if (isset($res2['idProf'])) {
                $req = $bdd->prepare('UPDATE evenement SET validEvent = 1, idCreateurProf = :idCreateurProf WHERE idEvent = :idEvent');
                $req->execute([
                    'idEvent' => $event->getIdEvent(),
                    'idCreateurProf' => $res2['idProf']
                ]);
                unset($_SESSION['erreur']);
                return true;
            }
        }
        // Sinon, on affiche un message d'erreur
        throw new Exception('Validation échouée.', 1);
    }

// Méthode d'inscription à un évènement

    /**
     * @throws Exception
     */
    public function inscrEvenement(InscriptionEvent $event)
    {
        $statut = ['eleve', 'professeur', 'parent'];
        // On appelle la base de données
        $bdd = (new BDD)->getBase();
        $req = $bdd->prepare('SELECT idEvent FROM evenement WHERE idEvent = :idEvent');
        $req->execute([
            'idEvent' => $event->getIdEvent()
        ]);
        $res = $req->fetch();
        // S'il trouve l'id de l'évènement, il va inscrire un utilisateur
        if ($res) {
            $req = $bdd->query('SELECT idUtilisateur FROM utilisateur');
            $res2 = $req->fetchAll();
            foreach ($res2 as $user) {
                // Cherche la personne à inscrire
                for ($i = 0; $i < 3; $i++) {
                    $req = $bdd->prepare('SELECT * FROM utilisateur INNER JOIN ' . $statut[$i] . ' ON ' . $statut[$i] . '.idUtil = utilisateur.idUtilisateur WHERE idUtilisateur = :idUtilisateur');
                    $req->execute([
                        'idUtilisateur' => $_SESSION['user']['idUtilisateur']
                    ]);
                    $res3 = $req->fetch();
                    if ($res3 && $user['idUtilisateur'] == $_SESSION['user']['idUtilisateur']) {
                        $idInscrit = $res3;
                        break;
                    }
                }
                if (isset($idInscrit)) {
                    break;
                }
            }
            switch ($idInscrit['statut']) {
                case '1':
                    $req = $bdd->prepare('INSERT INTO inscription_event (idEleve, idEvent) VALUES (:idEleve, :idEvent)');
                    $res4 = $req->execute([
                        'idEleve' => $idInscrit['idEleve'],
                        'idEvent' => $event->getIdEvent()
                    ]);
                    break;
                case '2':
                    $req = $bdd->prepare('INSERT INTO inscription_event (idParent, idEvent) VALUES (:idParent, :idEvent)');
                    $res4 = $req->execute([
                        'idParent' => $idInscrit['idParent'],
                        'idEvent' => $event->getIdEvent()
                    ]);
                    break;
                case '3':
                    $req = $bdd->prepare('INSERT INTO inscription_event (idProf, idEvent) VALUES (:idProf, :idEvent)');
                    $res4 = $req->execute([
                        'idProf' => $idInscrit['idProf'],
                        'idEvent' => $event->getIdEvent()
                    ]);
                    break;
            }
            if ($res4) {
                unset($_SESSION['erreur']);
                return true;
            }
        }
        // Sinon, on affiche un message d'erreur
        throw new Exception('Inscription échouée.', 1);
    }
    // Méthode validation d'un évènement

    /**
     * @throws Exception
     */
    public function validationEvent(Evenement $event)
    {
        // On appelle la base de données
        $bdd = (new BDD)->getBase();
        $req = $bdd->prepare('UPDATE `evenement` SET `validEvent`= 1,idCreateurProf = :idCreateurProf WHERE idEvent = :idEvent' );
        $req->execute([
            'idCreateurProf' => $event->getIdCreateurProf(),
            'idEvent' => $event->getIdEvent()
        ]);
        $res = $req->fetch();
        // Sinon, on affiche un message d'erreur
        throw new Exception('Validation échouée.', 1);
    }
}