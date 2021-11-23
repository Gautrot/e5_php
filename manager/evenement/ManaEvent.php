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
        $statut = ['eleve', 'parent', 'professeur', 'administrateur'];
        // On appelle la base de données
        $bdd = (new BDD)->getBase();
        $req = $bdd->query('SELECT * FROM evenement');
        $res = $req->fetchAll();
        foreach ($res as $error) {
            // Vérifie les conditions lors de l'ajout d'un évènement.
            // S'il y a une erreur, la fonction s'arrête.
            switch ($error) {
                case ($error['titre'] == $_POST['titre']):
                    throw new Exception('Le nom est déja pris dans un autre évènement.');
            }
        }
        // Cherche l'id de l'organisateur choisi
        $req = $bdd->query('SELECT idUtilisateur FROM utilisateur ORDER BY idUtilisateur DESC');
        $res2 = $req->fetchAll();
        foreach ($res2 as $user) {
            for ($j = 0; $j < 4; $j++) {
                $req = $bdd->prepare('SELECT * FROM utilisateur INNER JOIN ' . $statut[$j] . ' ON ' . $statut[$j] . '.idUtil = utilisateur.idUtilisateur WHERE idUtilisateur = :idUtilisateur');
                $req->execute([
                    'idUtilisateur' => $user[0]
                ]);
                $res3 = $req->fetch();
                if (isset($res3['idProf']) || isset($res3['idEleve'])) {
                    $id = $res3;
                    break;
                }
            }
        }
        if ($id['statut'] === '1') {
            // Si l'organisateur principal est un étudiant
            $req = $bdd->prepare('INSERT INTO evenement (titre, description, type, date, horaire, dateCreation, validEvent, idCreateurEleve) VALUES (:titre, :description, :type, :date, :horaire, NOW(), :validEvent, :idCreateurEleve)');
            $res4 = $req->execute([
                'titre' => $event->getTitre(),
                'description' => $event->getDescription(),
                'type' => $event->getType(),
                'date' => $event->getDate(),
                'horaire' => $event->getHoraire(),
                'validEvent' => $event->getValidEvent(),
                'idCreateurEleve' => $res3[0]
            ]);
        } else {
            // Si l'organisateur principal est un professeur
            $req = $bdd->prepare('INSERT INTO evenement (titre, description, type, date, horaire, dateCreation, validEvent, idCreateurProf) VALUES (:titre, :description, :type, :date, :horaire, NOW(), :validEvent, :idCreateurProf)');
            $res4 = $req->execute([
                'titre' => $event->getTitre(),
                'description' => $event->getDescription(),
                'type' => $event->getType(),
                'date' => $event->getDate(),
                'horaire' => $event->getHoraire(),
                'validEvent' => $event->getValidEvent(),
                'idCreateurProf' => $res3[0]
            ]);
        }
        // S'il créé avec succès l'évènement, alors il retourne un succès.
        if ($res4) {
            unset($_SESSION['erreur']);
            return;
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
        #Instancie la classe BDD
        $bdd = (new BDD)->getBase();
        $req = $bdd->query('SELECT * FROM evenement ORDER BY dateCreation DESC');
        return $req->fetchAll();
    }

// Méthode d'affichage d'un évènement

    /**
     * @throws Exception
     */
    public function chercheEvenement(Evenement $event)
    {
        // on appelle la base de données
        $bdd = (new BDD)->getBase();
        $req = $bdd->prepare('SELECT * FROM evenement WHERE idEvent = :idEvent');
        $req->execute([
            'idEvent' => $event->getIdEvent()
        ]);
        $res = $req->fetch();
        if ($res) {
            unset($_SESSION['erreur']);
            return $res;
        }
        // sinon affiche un message d'erreur
        throw new Exception('Erreur pendant la recherche de l\'évènement.', 1);
    }

    // Méthode d'annulation d'un évènement

    /**
     * @throws Exception
     */
    public function annuleEvenement(Evenement $event)
    {
        // on appelle la base de données
        $bdd = (new BDD)->getBase();
        $req = $bdd->prepare('SELECT idEvent FROM evenement WHERE idEvent = :idEvent');
        $req->execute([
            'idEvent' => $event->getIdEvent()
        ]);
        $res = $req->fetch();
        if ($res) {
            $req = $bdd->prepare('UPDATE evenement SET validEvent = 0 WHERE idEvent = :idEvent');
            $req->execute([
                'idEvent' => $event->getIdEvent()
            ]);
            unset($_SESSION['erreur']);
            return true;
        }
        // sinon affiche un message d'erreur
        throw new Exception('Annulation échouée.', 1);
    }
}