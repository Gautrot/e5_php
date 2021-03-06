<?php
require_once __DIR__ . '/../Manager.php';

// création de la classe ManaPee
class ManaPee extends Manager
{
// Méthode de création d'un pee

    /**
     * @throws Exception
     */
    public function creerPee(Pee $pee)
    {
        $bdd = (new BDD)->getBase();
        // Cherche le créateur du projet
        $req = $bdd->prepare('SELECT * FROM utilisateur INNER JOIN professeur ON professeur.idUtil = utilisateur.idUtilisateur WHERE idUtilisateur = :idUtilisateur');
        $req->execute([
            'idUtilisateur' => $_SESSION['user']['idUtilisateur']
        ]);
        $res2 = $req->fetch();
        $req = $bdd->prepare('INSERT INTO projet_edu (nom, description, ref_classe, date, ref_prof) VALUES (:nom, :description, :ref_classe, :date, :ref_prof)');
        $res1 = $req->execute([
            'nom' => $pee->getNom(),
            'description' => $pee->getDescription(),
            'ref_classe' => $pee->getRef_classe(),
            'date' => $pee->getDate(),
            'ref_prof' => $res2['idProf']
        ]);
        if ($res1) {
            unset($_SESSION['erreur']);
            return true;
        }
        throw new Exception('Ajout échouée !');
    }

// Liste deroulante classe

    /**
     * @throws Exception
     */
    public function listeClasse()
    {
        #Instancie la classe BDD
        $bdd = (new BDD)->getBase();
        $req = $bdd->query('SELECT * FROM classe ORDER BY nom DESC');
        return $req->fetchAll();
    }

// Liste deroulante Pee

    /**
     * @throws Exception
     */
    public function listePee()
    {
        #Instancie la classe BDD
        $bdd = (new BDD)->getBase();
        $req = $bdd->query('SELECT * FROM projet_edu ORDER BY nom DESC');
        return $req->fetchAll();
    }

// Méthode de suppression d'un pee

    /**
     * @throws Exception
     */
    public function supprPee(Pee $pee)
    {
        #Instancie la classe BDD
        $bdd = (new BDD)->getBase();
        $req = $bdd->prepare('SELECT id_projet FROM projet_edu WHERE id_projet = :id_projet');
        $req->execute([
            'id_projet' => $_POST['id_projet']
        ]);
        $res = $req->fetch();
        if ($res) {
            $req = $bdd->prepare('DELETE FROM projet_edu WHERE id_projet = :id_projet');
            $req->execute([
                'id_projet' => $_POST['id_projet']
            ]);
            return true;
        }
        throw new Exception('Suppression échouée !');
    }

// Méthode de modification d'un pee

    /**
     * @throws Exception
     */
    public function modifPee(Pee $pee)
    {
        // On appelle la base de données
        $bdd = (new BDD)->getBase();
        $req = $bdd->prepare('SELECT idProf FROM professeur WHERE idUtil = :idUtil');
        $req->execute([
            'idUtil' => $_SESSION['user']['idUtilisateur']
        ]);
        $res = $req->fetch();
        $req = $bdd->prepare('SELECT ref_prof FROM projet_edu WHERE id_projet = :id_projet');
        $req->execute([
            'id_projet' => $_POST['id_projet']
        ]);
        $res2 = $req->fetch();
        // S'il trouve l'id de l'évènement, il va annuler celui-ci
        if ($res[0] === $res2[0]) {
            $req = $bdd->prepare('UPDATE projet_edu SET nom = :nom, description = :description, ref_classe = :ref_classe, date = :date WHERE id_projet = :id_projet');
            $req->execute([
                'nom' => $pee->getNom(),
                'description' => $pee->getDescription(),
                'ref_classe' => $pee->getRef_classe(),
                'date' => $pee->getDate(),
                'id_projet' => $_POST['id_projet']
            ]);
            unset($_SESSION['erreur']);
            return true;
        }
        // Sinon, on affiche un message d'erreur
        throw new Exception('Annulation échouée.', 1);
    }
}
