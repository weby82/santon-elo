<?php 
    $navActive = "";
    /* Get header, navigation pane/bar, database_objects file */
   $this->insert('partials/header', ["navActive" => $navActive]);// also checks if session was started 
    /* If session 'items' is not set, redirect back to accueil */
    if(!isset($_SESSION['items']) || count($_SESSION['items'])==0){
        header("location: /");
    }

     $this->insert('partials/section-checkOut');


    $this->insert('partials/footer');
?>  
    
