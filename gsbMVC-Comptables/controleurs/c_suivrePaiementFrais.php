    <?php
include("vues/v_sommaire.php");
$action = $_REQUEST['action'];
$idComptable = $_SESSION['idComptable'];


switch($action){
	
    
    case 'choisirFichesPaiement':{
	
		$lesFiches = $pdo->getLesInfosFicheFraisVA_MP();
                
                include("vues/v_listeFichesValides.php");
                
		break;
	}
        
        
       case 'misePaiement':{
	
		
           
           if (isset($_POST["payer"]))
               
           {
           
           foreach ($_POST["payer"] as $index => $value)
                    
                    {

   
   $tab = explode(";",$value);
   
   $idVisiteur = $tab[0];
   $mois = $tab[1] ;
   $etat = $tab[2];
   
   echo $idVisiteur."<br/>" ;
   echo $mois;
   
         if($etat=='VA')
   $pdo->majEtatFicheFrais($idVisiteur,$mois,'MP');
         else
      $pdo->majEtatFicheFrais($idVisiteur,$mois,'RB');       

   
                   }
                   
        $lesFiches = $pdo->getLesInfosFicheFraisMP();         
        include("vues/v_listeFichesValides.php");   
        
        
           }
           
           else
           {
                
		echo "vous n'avez rien selectionn�" ;
            }  
        break;
        
       } 
	case 'validerMajFraisForfait':{
		$lesFrais = $_REQUEST['lesFrais'];
		if(lesQteFraisValides($lesFrais)){
	  	 	$pdo->majFraisForfait($idVisiteur,$mois,$lesFrais);
		}
		else{
			ajouterErreur("Les valeurs des frais doivent être numériques");
			include("vues/v_erreurs.php");
		}
	  break;
	}
	case 'validerCreationFrais':{
		$dateFrais = $_REQUEST['dateFrais'];
		$libelle = $_REQUEST['libelle'];
		$montant = $_REQUEST['montant'];
		valideInfosFrais($dateFrais,$libelle,$montant);
		if (nbErreurs() != 0 ){
			include("vues/v_erreurs.php");
		}
		else{
			$pdo->creeNouveauFraisHorsForfait($idVisiteur,$mois,$libelle,$dateFrais,$montant);
		}
		break;
	}
	case 'supprimerFrais':{
		$idFrais = $_REQUEST['idFrais'];
	    $pdo->supprimerFraisHorsForfait($idFrais);
		break;
	}
        
        case 'pdfGeneration':{
          
      $idVisiteur = $_REQUEST['visiteur']; 
     $leMois = $_REQUEST['mois'];  
            
      $fiche = $pdo->getLesInfosFicheFrais($idVisiteur,$leMois) ;
      $montantValide = $fiche['montantValide'] ;
      $fraisForfait = $pdo->getLesFraisForfait($idVisiteur,$leMois) ;
      $fraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur,$leMois) ;
      
       $leVisiteur = $pdo->getInfosVisiteur($idVisiteur) ; 
       
       
       
       include("vues/pdf_generation.php");
       ob_end_clean();    
       $res = creerPdfFiche($fraisForfait,$fraisHorsForfait,$montantValide,$leVisiteur,$leMois) ;
       break;
		
	}
        
}

?> 