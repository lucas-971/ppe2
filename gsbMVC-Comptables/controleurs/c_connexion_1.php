<?php


Class Connexion
{
    
private $act = "demandeConnexion";
    
public function __construct(){
  
	}
        
	public function _destruct(){
		
	}

	public function recupererAction(){
		
		return ($this->act);
	}
        
        public function setAction($action){
		
		$this->act = $action;
	}
  
}

$c = new Connexion() ;

if(!isset($_REQUEST['action'])){
	$_REQUEST['action'] = $c->recupererAction();
}
$action = $_REQUEST['action'];

$c->setAction($action);


switch($c->recupererAction()){
	case 'demandeConnexion':{
		include("vues/v_connexion.php");
		break;
	}
	case 'valideConnexion':{
		$login = $_REQUEST['login'];
		$mdp = $_REQUEST['mdp'];
		$comptable = $pdo->getInfosComptable($login,$mdp);
		if(!is_array( $comptable)){
			ajouterErreur("Login ou mot de passe incorrect");
			include("vues/v_erreurs.php");
			include("vues/v_connexion.php");
		}
		else{
			$id = $comptable['id'];
			$nom =  $comptable['nom'];
			$prenom = $comptable['prenom'];
			connecter($id,$nom,$prenom);
			include("vues/v_sommaire.php");
		}
		break;
	}
	default :{
		include("vues/v_connexion.php");
		break;
	}
}
?>