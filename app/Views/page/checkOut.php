<?php 
    $navActive = "";
    /* Get header, navigation pane/bar, database_objects file */
   $this->insert('partials/header', ["navActive" => $navActive]);// also checks if session was started 
    /* If session 'items' is not set, redirect back to index.php */
    if(!isset($_SESSION['items']) || count($_SESSION['items'])==0){
        header("location: index.php");
    }


/* Display aded products in the shopping cart */
?>

    <main>
        <div class="container">
            <div class="container-inner">
                <h2>Ma commande</h2>
                <table class='table table-striped'> <!--Start table that will holds all data in the shopping cart --> 
                    <tr>
                        <th></th>
                        <th>Nom</th>
                        <th>Quantité</th>
                        <th>Prix</th>
                    </tr>
                    <?php
                    $total=0; // define total so the script won't throw silly error of a type 'Undefined variable: total in....'
                    /* Loops through item session array and display data */
                    foreach($_SESSION["items"] as $item){ 			
                    ?>                         
                    <tr class='itemInCardRow'>            
                        <td class='itemInCartDisplay'>
                            <img class='img-responsive item_disp_image' style='max-width:40px; float:left;' src="<?php echo $item["item_image"]; ?>">
                        </td>
                        <td class='itemInCartDisplay'>
                            <?php echo $item["item_name"]; ?>
                        </td>
                        <td class='itemInCartDisplay'>                 
                            <?php echo "<span class='quantity'>Qty ".$item["item_qty"]."</span>"; ?>                     
                        </td>
                        <td class='itemInCartDisplay'>
                            <?php echo "€".sprintf("%.2f", ($item["item_price"] * $item["item_qty"])); ?>
                        </td>
                    </tr>
                    <?php
                        /* Calculate Total */
                        $total += ($item["item_price"] * $item["item_qty"]);

                        }  // Close foreach loop
                    ?>
                    <tr>                 
                        <td class='itemInCartDisplay' colspan='3'>
                            <div>
                                <a href='#' title="Go To Payment"><button type="button" class="btn btn-default checkout_btn">Payer</button></a>
                                <a href='index.php' title="Continue Shopping"><button type="button" class="btn btn-default continue_shopping_btn">Continuer les achats</button></a>

                            </div>
                        </td>
                         <td class='itemInCartDisplay' style='text-align:right;'>
                            <div class="cart-products-total">                        
                                <span>Total : 
                                    <?php
                                        // Return a total price with 2 decimals 
                                        echo sprintf("%.2f",$total) . "€"; 
                                    ?>
                                </span>
                            </div>
                        </td>
                    </tr>
                </table> 
            </div>       
        </div>
    </main>
    
<?php 
/* Get footer */
    $this->insert('partials/footer');
?>  
    
<!--    <body> tag will be closed in footer ....... -->
