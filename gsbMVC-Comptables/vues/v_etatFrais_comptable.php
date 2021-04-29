
<h3>Fiche de frais non cloturées : 
    </h3>
    <div class="encadre">
    <p>
        
     <table class="listeLegere">
  	   <caption>Descriptif des fiches non cloturees-
       </caption>
             
         <tr>
                
                <th class="libelle">Valider</th>
                 <th class="libelle">Visiteur</th>
                <th class="date">Mois</th>
                <th class='montant'>Montant Estime</th> 
                <th class="date">Date Modification</th>
                <th class='montant'>Nombre de justificatifs</th> 
             </tr>
        
         
         
         
        <?php 
        
         foreach( $lesInfosFicheFraisCR as $uneInfosFicheFraisCR) 
		{
                
		$idVisiteur = $uneInfosFicheFraisCR['idVisiteur'];
                $mois = $uneInfosFicheFraisCR['mois'];
		$montantValide = $uneInfosFicheFraisCR['montantValide'];
		$nbJustificatifs = $uneInfosFicheFraisCR['nbJustificatifs'];
		$dateModif =  $uneInfosFicheFraisCR['dateModif'];
		$dateModif =  dateAnglaisVersFrancais($dateModif);
		
                
        
	    
	?>		
            <tr>
                <td> <?php echo "Valider" ?></td>
                <td><?php echo $idVisiteur ?></td>
                <td><?php echo $mois ?></td>
                 <td><?php echo $montantValide ?></td>
                  <td><?php echo $dateModif ?></td>
                        <td><?php echo $nbJustificatifs ?></td>
                <td><a href="index.php?uc=etatFrais&action=cloturerFiches&idVisiteur=<?php echo $idVisiteur ?>&mois=<?php echo $mois ?>" 
				onclick="return confirm('Voulez-vous vraiment cloturer cette fiche ?');">Valider la fiche</a></td>
             </tr>
	<?php		 
          
          }
	?>	  
                       
             
             
             
             
	
    </table>   
        
        
        
        
        
        
            
                     
    </p>
  	
 
   
  </div>
  </div>
 













