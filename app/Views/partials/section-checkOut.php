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

                    $urlPhoto =	$this->assetUrl($item["item_image"]);		
                    ?>                         
                    <tr class='itemInCardRow'>            
                        <td class='itemInCartDisplay'>
                            <img class='img-responsive item_disp_image' style='max-width:40px; float:left;' src="<?php echo $urlPhoto; ?>">
                        </td>
                        <td class='itemInCartDisplay'>
                            <?php echo $item["item_name"]; ?>
                        </td>
                        <td class='itemInCartDisplay'>                 
                            <?php echo "<span class='quantity'>Qte ".$item["item_qty"]."</span>"; ?>                     
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
                                <a class="btn btn-default checkout_btn" href="<?php echo $this->url('vitrine_paiement_cheque'); ?>" title="Payer par chèque">Payer par chèque</a>
                                <a class="btn btn-default checkout_btn" href='#' title="Paypal">Payer par Paypal</a>
                                <a class="btn btn-default continue_shopping_btn" href="<?php echo $this->url('vitrine_categorie', ['categorie' => 'nativite']); ?>" title="Continue Shopping">Continuer les achats</a>

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