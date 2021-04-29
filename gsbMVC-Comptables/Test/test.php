<?php



class FonctionsTest extends PHPUnit_Framework_TestCase
 

{
 public function testerMoisSuivant()
 
 {  
     
 include("../include/fct.inc.php") ;        
 $leMois = moisSuivant(201601);
$this->assertEquals($leMois,201601);
 }



/*$leMois = moisSuivant(201512); 

echo $leMois ; */
}


?>
