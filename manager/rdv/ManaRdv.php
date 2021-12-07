<?php
require_once __DIR__ . '/../Manager.php';

// création de la classe ManaRdv
class ManaRdv extends Manager
{
// Méthode de création d'un évènement

    /**
     * @throws Exception
     */
    public function creerRDV(Rdv $rdv)
    {
      $statut = ['parent', 'professeur'];
        // On appelle la base de données
        $bdd = (new BDD)->getBase();
        $req = $bdd->query('SELECT * FROM rdv');
        $res = $req->fetchAll();

        // Cherche le créateur du rdv
        for ($i = 0; $i < 2; $i++) {
            $req = $bdd->prepare('SELECT * FROM utilisateur INNER JOIN ' . $statut[$i] . ' ON ' . $statut[$i] . '.idUtil = utilisateur.idUtilisateur WHERE idUtilisateur = :idUtilisateur');
            $req->execute([
                'idUtilisateur' => $_SESSION['user']['idUtilisateur']
            ]);
            $res2 = $req->fetch();
            if (isset($res2['idParent'])) {
                $idCreateurParent = $res2;
                break;
            } else if (isset($res2['idProf'])) {
                $idCreateurProf = $res2;
                break;
            }
        }
        // Cherche l'invité du rdv
if (isset($idCreateurProf)) {
   $req = $bdd->prepare('SELECT * FROM utilisateur INNER JOIN parent ON parent.idUtil = utilisateur.idUtilisateur WHERE idUtilisateur = :idUtilisateur');
   $req->execute([
       'idUtilisateur' => $_POST['idInviteParent']
   ]);
   $res3 = $req->fetch();
   //var_dump($_POST['idInviteParent']);
   //var_dump($res3);
   //die();
   if (isset($res3)) {
       $idInviteParent = $res3;
   }
} else if (isset($idCreateurParent)) {
  $req = $bdd->prepare('SELECT * FROM professeur WHERE idProf = :idProf');
  $req->execute([
      'idProf' => $_POST['idInviteProf']
  ]);
  $res3 = $req->fetch();
  if (isset($res3)) {
      $idInviteProf = $res3;
  }
}

        //var_dump($res2);
        //var_dump($res3);


        //var_dump(date('N', strtotime($_POST['date'])));

        //var_dump($_POST['date']);
        //die();
        if (isset($idCreateurParent) && isset($idInviteProf) && date('N', strtotime($_POST['date'])) == 6) {
        $req = $bdd->prepare('INSERT INTO rdv (objet, message, date, horaire, dateCreation, idCreateurParent, idInviteProf, validRdv) VALUES (:objet, :message, :date, :horaire, NOW(), :idCreateurParent, :idInviteProf, :validRdv)');
        $res1 = $req->execute([
            'objet' => $rdv->getObjet(),
            'message' => $rdv->getMessage(),
            'date' => $rdv->getDate(),
            'horaire' => $rdv->getHoraire(),
            'idCreateurParent' => $idCreateurParent['idParent'],
            'idInviteProf' => $idInviteProf['idProf'],
            'validRdv' => 1
        ]);
        //var_dump($res1);

       }

        else if (isset($idCreateurProf) && isset($idInviteParent)) {
          $req = $bdd->prepare('INSERT INTO rdv (objet, message, date, horaire, dateCreation, idCreateurProf, idInviteParent, validRdv) VALUES (:objet, :message, :date, :horaire, NOW(), :idCreateurProf, :idInviteParent, :validRdv)');
          $res1 = $req->execute([
              'objet' => $rdv->getObjet(),
              'message' => $rdv->getMessage(),
              'date' => $rdv->getDate(),
              'horaire' => $rdv->getHoraire(),
              'idCreateurProf' => $idCreateurProf['idProf'],
              'idInviteParent' => $idInviteParent['idParent'],
              'validRdv' => 1
          ]);


          //var_dump($res1);

        }

        //die();
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
          //  $statut = ['professeur', 'parent'];
          //  $idStatut = ['Prof', 'Parent'];
          //  $idCreateur = ['idCreateurProf', 'idCreateurParent'];
            // On appelle la base de données
            $bdd = (new BDD)->getBase();
            // Cherche le rdv choisi et son créateur.rice
            if ($_SESSION['user']['statut'] === '2') {
                  $req = $bdd->prepare('SELECT * FROM rdv INNER JOIN parent ON parent.idParent = rdv.idCreateurParent INNER JOIN utilisateur ON utilisateur.idUtilisateur = parent.idUtil WHERE idRdv = :idRdv');
                  $req->execute([
                      'idRdv' => $rdv->getIdRdv()
                  ]);
                  $res2 = $req->fetch();
                  // S'il trouve au moins un rdv, alors il retourne les valeurs
                  return $res2;
            }

            else if ($_SESSION['user']['statut'] === '3') {
                  $req = $bdd->prepare('SELECT * FROM rdv INNER JOIN prof ON prof.idProf = rdv.idCreateurProf INNER JOIN utilisateur ON utilisateur.idUtilisateur = prof.idUtil WHERE idRdv = :idRdv');
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
                    $req = $bdd->prepare('UPDATE rdv SET validRdv = 0 WHERE idRdv = :idRdv');
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
