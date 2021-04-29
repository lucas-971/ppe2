 <div id="contenu">
      <h2>Validation des fiches de frais</h2>
      <h3>Visiteur à sélectionner : </h3>
      <form action="index.php?uc=validerFrais&action=selectionnerMois" method="post">
      <div class="corpsForm">
         
      <p>
	 
        <label for="lstVisiteurs" accesskey="n">Visiteurs : </label>
        <select id="lstVisiteurs" name="lstVisiteurs">
            <?php
			foreach ($lesVisiteurs as $unVisiteur)
			{
                $visiteur = $unVisiteur['id'];
				$nomVisiteur =  $unVisiteur['nom'];
				$prenomVisiteur =  $unVisiteur['prenom'];
				
          if($visiteur == $visiteurASelectionner){
				?>
				<option selected value="<?php echo $visiteur ?>"><?php echo  $nomVisiteur." ".$prenomVisiteur ?> </option>
				<?php 
				}
				else{  ?> 
				<option value="<?php echo $visiteur ?>"><?php echo  $nomVisiteur." ".$prenomVisiteur ?> </option>
				<?php 
				}			
			}
           
		   ?>    
            
        </select>
      </p>
      </div>
      <div class="piedForm">
      <p>
        <input id="ok" type="submit" value="Valider" size="20" />
        <input id="annuler" type="reset" value="Effacer" size="20" />
      </p> 
      </div>
        
      </form>