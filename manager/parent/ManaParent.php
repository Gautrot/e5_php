<?php
include '../Manager.php';

// création de la classe ManaParent
class ManaParent extends Manager
{
  // Méthode d'inscription pour un parent

  /**
   * @throws Exception
   */
  public function inscriptionParent(Parents $parent)
  {
      $bdd = (new BDD)->getBase();
      $req = $bdd->prepare('SELECT * FROM utilisateur WHERE mail = :mail ');
      $req->execute([
          'login' => $parent->getMail()
      ]);
      $res = $req->fetch();
      // si $res est égale à quelque chose alors un message d'erreur s'affiche
      if ($res) {
          throw new Exception('Le parent existe déjà.');
      }
      // si les getters sont différents de rien alors :
      if ($parent->getNom() !== '' && $parent->getPrenom() !== '' && $parent->getMail() !== '' && $parent->getLogin() !== '' && $parent->getMdp() !== ''
          || $parent->getNom() !== null && $parent->getPrenom() !== null && $parent->getMail() !== null && $parent->getLogin() !== null && $parent->getMdp() !== null) {
          // création de l'objet bdd pour s'y connecter
          $bdd = (new BDD)->getBase();
          // preparation de la requête
          $req = $bdd->prepare('
              INSERT INTO utilisateur (nom, prenom, dateNaissance, adresse, telephone, mail, login, mdp, statut) VALUES (:nom, :prenom, :dateNaissance, :adresse, :telephone, :mail, :login, :mdp, :statut);
              INSERT INTO parent (idParent, metier, idEleve) VALUES (LAST_INSERT_ID(), :id_Eleve);
          ');
          // execution de la requête
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
              'metier' => $parent->getMetier()
          ]);
          if ($res2) {
              $req = $bdd->prepare('SELECT idUtilisateur, login, mdp, statut FROM utilisateur WHERE login = :login AND mdp = :mdp');
              $req->execute([
                  'login' => $parent->getLogin(),
                  'mdp' => $parent->getMdp()
              ]);
              $res3 = $req->fetch();
              unset($_SESSION['erreur']);
              header('Location: /e5_php/template/themes/template/index');
              return $_SESSION['user'] = $res3;
          } else {
              // sinon redirection vers la page inscription
              throw new Exception('Inscription échouée.');
          }
      }
      throw new Exception('Erreur.');
  }

}
