<?php
include '../Manager.php';

// création de la classe ManaEvent
class ManaEvent
{
    // Méthode de création d'un évènement

    /**
     * @throws Exception
     */
    public function creerEvenement(Evenement $event)
    {
        #Instancie la classe BDD
        $bdd = (new BDD)->getBase();
        $req = $bdd->prepare('SELECT nom FROM evenement WHERE nom = :nom');
        $req->execute([
            'nom' => $event->getNom()
        ]);
        $res = $req->fetch();
        if ($res) {
            # Si l'évènement existe dans la BDD.
            header('Location: /e5_php/template/themes/template/creer-evenement');
            throw new Exception('Cet évènement existe.');
        } else {
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
            unset($_SESSION['erreur']);
            header('Location: /e5_php/template/themes/template/evenements');
            if (!$res2) {
                # Si un ou plusieurs champs sont vides.
                throw new Exception('Ajout échouée !');
            }
            return;
        }
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
        $req = $bdd->prepare('SELECT * FROM evenement ORDER BY dateCreation DESC');
        $req->execute();
        return $req->fetchall();
    }

    // Méthode d'affichage d'un utilisateur dans la session 'show'

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
            header('Location: /e5_php/template/themes/template/evenement-no?idEvent=' . $res['idEvent']);
            return $_SESSION['event'] = $res;
        } else {
            // sinon affiche un message d'erreur
            header('Location: /e5_php/template/themes/template/evenements');
            throw new Exception('Erreur pendant la recherche de l\'évènement.', 1);
        }
    }
}