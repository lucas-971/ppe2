
    <div id="menuGauche">
     <div id="infosUtil">
    
        <h2>
    
</h2>
    
      </div>  
        <ul id="menuList">
			<li >
				  Comptable :
				<?php echo $_SESSION['prenom']."  ".$_SESSION['nom']  ?><br><br>
			</li>
           <li class="smenu">
 
           
            <li class="smenu">
              <a href="index.php?uc=validerFrais&action=choisirVisiteur" title="Fiches à Valider">Validation de frais</a>
           </li>
           
            <li class="smenu">
              <a href="index.php?uc=suivrePaiementFrais&action=choisirFichesPaiement" title="Fiches à Mettre en paiement">Fiches de frais</a>
           </li>
            <li class="smenu">
              <a href="index.php?uc=connexion&action=deconnexion" title="Se déconnecter">Déconnexion</a>
           </li>
          
         </ul>
        
    </div>
    