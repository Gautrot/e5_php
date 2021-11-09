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
        // On appelle la base de données
        $bdd = (new BDD)->getBase();
        $req = $bdd->query('SELECT * FROM evenement');
        $res = $req->fetchAll();
        foreach ($res as $error) {
            // Vérifie les conditions lors de l'ajout d'un évènement.
            // S'il y a une erreur, la fonction s'arrête.
            switch ($error) {
                case ($error['nom'] == $_POST['nom']):
                    throw new Exception('Le nom est déja pris dans un autre évènement.');
            }
        }
        $req = $bdd->prepare('INSERT INTO evenement (idCreateur, nom, description, organisateur, type, date, horaire, dateCreation, validEvent) VALUES (:idCreateur, :nom, :description, :organisateur, :type, :date, :horaire, NOW(), :validEvent)');
        $res2 = $req->execute([
            'idCreateur' => $event->getIdCreateur(),
            'nom' => $event->getNom(),
            'description' => $event->getDescription(),
            'organisateur' => $event->getOrganisateur(),
            'type' => $event->getType(),
            'date' => $event->getDate(),
            'horaire' => $event->getHoraire(),
            'validEvent' => $event->getValidEvent()
        ]);
        // S'il créé avec succès l'évènement, alors il retourne un succès.
        if ($res2) {
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
}