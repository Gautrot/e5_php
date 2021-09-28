<?php

// utilisation du fichier bdd.php
require_once '../model/bdd.php';

// création de la classe manager
class manager {
  private $bdd;
  public $connexion="",$inscription="";


  // méthode connexion
public function connexion($a){
  session_start();

    // on appelle la base de données
    $this->bdd = new bdd();

    // gestion d'erreur : si l'utilisateur ne rentre rien pour le login ou le mot de passe alors le message "champ vide" apparaitra
    if($a->getLogin() =='' and $a->getMdp() =='' ){
      throw new Exception("champ vide",1);

    }

    if($a->getLogin() ==''){
      throw new Exception("login vide",1);

    }

    if($a->getMdp() ==''){
      throw new Exception("mdp vide",1);

    }
  // préparation de la requête pour la connexion d'un utilisateur
  $req = $this->bdd->getBase()->prepare("SELECT login,mdp from utilisateur where login= :login");
    $req->execute(array(
      'login'=> $a->getLogin(),
      //'mdp'=> $a->getMdp()
      ));
    $res = $req->fetch();

    //vérification du mot de passe entré par l'utilisateur :
    // si le mot de passe est correct alors la connexion est réussi et on entre dans le compte
      if(password_verify($a->getMdp(),$res['mdp']) OR $res['mdp']){
        echo 'ok';
        $reussi = "reussi";
        $_SESSION['login'] = $res["login"];
        $this->connexion="ok";
        header("Location: ../index.php");

      }



else {
  // sinon affiche un message d'erreur
  throw new Exception("Erreur pendant la connexion",1);
  header("Location: ../vue/connexion.php");
}
die();
}


// méthode déconnexion
 public function deconnexion()
  {
    session_start();

    $_SESSION['id'] = 0;

    // redirection vers la page index.php
    header("Location: ../index.php");
  }

// méthode inscription pour un utilisateur
public function inscription($a)
{
  session_start();
  $this->bdd = new bdd();
  $req = $this->bdd->getBase()->prepare('SELECT * FROM utilisateur WHERE login=:login ');
  $req->execute(array(
    'login'=> $a->getLogin(),
    ));

    $res = $req->fetch();

    // si $res est égale à quelque chose alors un message d'erreur s'affiche
    if ($res) {
      throw new Exception("Erreur utilisateur deja existant");

    }
//si les getters sont différents de rien alors :
if($a->getNom() !='' and $a->getPrenom() !='' and $a->getMail() !='' and $a->getLogin() !='' and $a->getMdp() !='') {
  // création de l'objet bdd pour s'y connecter
  $this->bdd = new bdd();
  // preparation de la requête
  $req = $this->bdd->getBase()->prepare('INSERT INTO utilisateur(nom,prenom,mail,login,mdp) values (:nom,:prenom,:mail,:login,:mdp)');
  // execution de la requête
  $req->execute(array(
    'nom'=>$a->getNom(),
    'prenom'=>$a->getPrenom(),
    'mail'=>$a->getMail(),
    'login'=> $a->getLogin(),
    'mdp'=> $a->getMdp() ));

    $res=$req->fetch();


    if($res){
      $_SESSION['mdp']=$res['mdp'];
      header('Location: ../index.php');
    }

    // sinon redirection vers la page inscription.php
    else {
      header('Location: ../index.php');
    }

}
}
}
?>
