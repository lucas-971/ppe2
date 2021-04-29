<?php
include("vues/v_sommaire.php");
$action = $_REQUEST['action'];
$idComptable = $_SESSION['idComptable'];



switch($action){
	
    
        
        case 'choisirVisiteur':{
               
         $lesCles = array_keys( $lesVisiteurs );
	 $visiteurASelectionner = $lesCles[0];
         
       
         
         include("vues/v_listeVisiteur.php"); 
         
         break ;
         
         
        }
        
        
        
        case 'selectionnerMois' : {
        
        $leVisiteur = $_REQUEST['lstVisiteurs'];     
	$lesMois=$pdo->getLesMoisDisponiblesCL($leVisiteur);
		$lesCles = array_keys( $lesMois );
                if ($lesCles!=null)
                {
		$moisASelectionner = $lesCles[0];
		include("vues/v_listeMois.php");
                }
                            
                break;
          }
        
        
       case 'afficherFrais':{
           $idVisiteur = $_REQUEST['visiteur']; 
           $leMois = $_REQUEST['lstMois']; 
		$lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur,$leMois);
		$lesFraisForfait= $pdo->getLesFraisForfait($idVisiteur,$leMois);
		$lesInfosFicheFrais = $pdo->getLesInfosFicheFrais($idVisiteur,$leMois);
		$numAnnee =substr( $leMois,0,4);
		$numMois =substr( $leMois,4,2);
		$libEtat = $lesInfosFicheFrais['libEtat'];
		$montantValide = $lesInfosFicheFrais['montantValide'];
		$nbJustificatifs = $lesInfosFicheFrais['nbJustificatifs'];
		$dateModif =  $lesInfosFicheFrais['dateModif'];
		$dateModif =  dateAnglaisVersFrancais($dateModif);
		include("vues/v_etatFrais.php");
              
                
                break ;
	} 
        
        
        case 'actualiserFraisForfait' : {
            
          $idVisiteur = $_REQUEST['idVisiteur'] ;
          $leMois = $_REQUEST['mois'] ;
         $numAnnee =substr( $leMois,0,4);
	$numMois =substr( $leMois,4,2);
        $lesFraisForfait= $pdo->getLesFraisForfait($idVisiteur,$leMois);  
        include("vues/v_listeFraisForfait.php");  
            
        break;
        
        }
        
        case 'MajFraisForfait':{
            
                $idVisiteur = $_REQUEST['idVisiteur'] ;
                $leMois = $_REQUEST['mois'] ;
                $numAnnee =substr( $leMois,0,4);
                $numMois =substr( $leMois,4,2);
		$lesFraisForfait = $_REQUEST['lesFrais'];
		if(lesQteFraisValides($lesFraisForfait)){
	  	 	$pdo->majFraisForfait($idVisiteur,$leMois,$lesFraisForfait);
                        
                        
                        $leMontantValide = $pdo->getLeMontantTotal($idVisiteur,$leMois);
                        $pdo->majEtatFicheFraisMontant($idVisiteur,$leMois,$leMontantValide); 
                        
		}
		else{
			ajouterErreur("Les valeurs des frais doivent �tre num�riques");
			include("vues/v_erreurs.php");
		}
        $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur,$leMois);
	$lesFraisForfait= $pdo->getLesFraisForfait($idVisiteur,$leMois);    
        $lesInfosFicheFrais = $pdo->getLesInfosFicheFrais($idVisiteur,$leMois);
		
		$libEtat = $lesInfosFicheFrais['libEtat'];
		$montantValide = $lesInfosFicheFrais['montantValide'];
		$nbJustificatifs = $lesInfosFicheFrais['nbJustificatifs'];
		$dateModif =  $lesInfosFicheFrais['dateModif'];
		$dateModif =  dateAnglaisVersFrancais($dateModif);
		include("vues/v_etatFrais.php");   
	  break;
	}
        
        
      case 'supprimerFrais':{
          
            $idFrais = $_REQUEST['idFrais'];
	    $pdo->refuserFraisHorsForfait($idFrais);
            
            
         $idVisiteur = $_REQUEST['idVisiteur'] ;
         $leMois = $_REQUEST['mois'] ; 
         $numAnnee =substr( $leMois,0,4);
         $numMois =substr( $leMois,4,2);
         
        $leMontantValide = $pdo->getLeMontantTotal($idVisiteur,$leMois);
        $pdo->majEtatFicheFraisMontant($idVisiteur,$leMois,$leMontantValide);
         
         
        $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur,$leMois);
	$lesFraisForfait= $pdo->getLesFraisForfait($idVisiteur,$leMois);    
        $lesInfosFicheFrais = $pdo->getLesInfosFicheFrais($idVisiteur,$leMois);
		
		$libEtat = $lesInfosFicheFrais['libEtat'];
		$montantValide = $lesInfosFicheFrais['montantValide'];
		$nbJustificatifs = $lesInfosFicheFrais['nbJustificatifs'];
		$dateModif =  $lesInfosFicheFrais['dateModif'];
		$dateModif =  dateAnglaisVersFrancais($dateModif);
            include("vues/v_etatFrais.php");
            break ;
         
      }
          
        
        case 'reporterFraisHorsForfait':{
          
      $idVisiteur = $_REQUEST['idVisiteur'] ;
      $leMois = $_REQUEST['mois'] ;
      $idFrais = $_REQUEST['idFrais'];
      $numAnnee =substr( $leMois,0,4);
      $numMois =substr( $leMois,4,2);
      
      $pdo->supprimerFraisHorsForfait($idFrais);
      $leMontantValide = $pdo->getLeMontantTotal($idVisiteur,$leMois);
      $pdo->majEtatFicheFraisMontant($idVisiteur,$leMois,$leMontantValide);
      
      
      $laDate = $_REQUEST['date'] ;
      $leLibelle = $_REQUEST['libelle'] ;
      $leMontant = $_REQUEST['montant'] ;
      
      $leMoisSuivant = moisSuivant($leMois); 
      
      if($pdo->dernierMoisSaisi($idVisiteur)==$leMois)
            
      {
     
    $pdo-> creeNouvellesLignesFrais($idVisiteur,$leMoisSuivant)  ;
     
      }
      
      
            
   $pdo->creeNouveauFraisHorsForfait($idVisiteur,$leMoisSuivant,$leLibelle,$laDate,$leMontant) ;
   $leMontantValide = $pdo->getLeMontantTotal($idVisiteur,$leMoisSuivant);
   $pdo->majEtatFicheFraisMontant($idVisiteur,$leMoisSuivant,$leMontantValide);
         
   
   $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur,$leMois);
   $lesFraisForfait= $pdo->getLesFraisForfait($idVisiteur,$leMois);    
   $lesInfosFicheFrais = $pdo->getLesInfosFicheFrais($idVisiteur,$leMois);
		
		$libEtat = $lesInfosFicheFrais['libEtat'];
		$montantValide = $lesInfosFicheFrais['montantValide'];
		$nbJustificatifs = $lesInfosFicheFrais['nbJustificatifs'];
		$dateModif =  $lesInfosFicheFrais['dateModif'];
		$dateModif =  dateAnglaisVersFrancais($dateModif);
		include("vues/v_etatFrais.php"); 
   
   break ;
         
      }
      
       
      case 'validerFicheFrais' : {
          
       $idVisiteur = $_REQUEST['idVisiteur'] ;
       $mois = $_REQUEST['mois'] ;
       $pdo->majEtatFicheFrais($idVisiteur,$mois,'VA')	;
        
        break;
          
      }
        
	
}
?>