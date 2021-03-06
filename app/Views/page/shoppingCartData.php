<?php

/* If session is not started, start session */
if(session_status()==PHP_SESSION_NONE){session_start();}
require_once(__DIR__."/../database.php");  // request database connection with its objects 

if(isset($_POST["item_id"]) && isset($_POST['item_qty'])){
    /* Get $_POST data and place it in array */
    $added_item["item_id"]=$_POST['item_id'];
    $added_item["item_qty"]=$_POST['item_qty'];
    //$added_item["item_size"]=$_POST['item_size'];

    /* Fetch all items from database that matches $_POST['item_id'] 
        Limit 1 at the end so only one item is fetched. */
    $items = $database->find_by_query("SELECT * FROM santon WHERE id='{$added_item["item_id"]}' LIMIT 1");
    
    /* Foreach item -> Remaining data about items fetched from database */
	foreach($items as $itemPanier){

		$added_item["item_name"] = utf8_encode($itemPanier['nom']);
		$added_item["item_price"] = $itemPanier['prix'];
        $added_item["item_image"] = $itemPanier['photo'];
        $added_item["item_url"]   = $itemPanier["nom_url"];
        $added_item["item_categorie"]   = $itemPanier["categorie"];
		
        /* Update item session array with newly added items - items that already exist in the basket will be overwritten */
		$_SESSION["items"][$added_item['item_id']] = $added_item;  


	}	
    /* Calculate number of items in cart and output it in json format */
    exit(json_encode(array('items_in_cart'=>count($_SESSION['items']))));  
    
}
/* Display aded products in the shopping cart */
if(isset($_POST["load_cart_items"])){

    /* If item session is already set and if there are any items added to the session */
	if(isset($_SESSION["items"]) && count($_SESSION["items"])>0){

    ?>
        <div class="table-responsive">
        <table class='table'> <!--Start table that will holds all data in the shopping cart --> 
        <?php
        $total=0; // define total so the script won't throw silly error of a type 'Undefined variable: total in....'
        

        /* Loop through item session array and display data */		
        foreach($_SESSION["items"] as $item){ 
        	$urlPhoto = $this->assetUrl($item["item_image"]);	
        ?>			
            <tr class='itemInCardRow'>            
                <td class='itemInCartDisplay'>
                    <img class='img-responsive item_disp_image' style='max-width:80px;' src="<?php echo $urlPhoto; ?>">
                </td>

                <td class='itemInCartDisplay'>
                    <a href="<?php echo $this->url('vitrine_afficher_santon', [ 'categorie' => $item["item_categorie"], 'nomUrl' => $item["item_url"] ]);?>" title="<?php echo $item["item_name"] ?>">
                        <?php echo $item["item_name"]; ?> 
                    </a>          
                </td>

                <td class='itemInCartDisplay' width="120px">
                    <a href='#' class='subtruct_itm_qty quantity_change' item_id="<?php echo $item["item_id"]; ?>">-</a>  
                        <?php echo "<span class='quantity'>Qte ".$item["item_qty"]."</span>"; ?>    
                    <a href='#' class='add_itm_qty quantity_change' item_id="<?php echo $item["item_id"]; ?>">+</a>        
                </td>

                <td class='itemInCartDisplay'>
                    <?php echo "€".sprintf("%.2f", ($item["item_price"] * $item["item_qty"])); ?>
                </td>
                <td class='itemInCartDisplay'>
                    <a href="#" class="remove_item_from_cart" item_id="<?php echo $item["item_id"]; ?>"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>            
                </td>            
            </tr>
            
        <?php
            /* Calculate Total */
            $total += ($item["item_price"] * $item["item_qty"]);            
            }  // Close foreach loop
        ?>
        
            <!-- This part displays Checkout button and price total -->
            <tr>                 
                <td class='itemInCartDisplay' colspan='2'>
                    <div>
                        <a href='<?php echo $this->url('vitrine_commander'); ?>' title="Review Cart and Check-Out"><button type="button" class="btn btn-default checkoutButton">COMMANDER</button></a>
<!--                        <a class="checkoutButton" href="view_cart.php" CHECKOUT</a>            -->
                    </div>
                </td>                
                 <td class='itemInCartDisplay' colspan='2' style='text-align:right;'>
                    <div class="cart-products-total">                        
                        <span>Total : <span style='font-size:20px; color:#008cba;'></span>
                            <?php
                                // Return a total price with 2 decimals 
                                echo "€".sprintf("%.2f",$total); 
                            ?>
                        </span>
                    </div>
                </td>
            </tr>
        </table>
        </div>
    
    <?php 
       
	}else{
        /*  Information about empty shopping cart  - exit() function prints a message and exits current script
            Can be used as die() */
		exit("Votre panier est vide");
	}    
}

/* Add item quantity - Allow maximum 5 of each item to be added  */
if(isset($_GET["add_itm_qty"]) && isset($_SESSION["items"])){
    if(isset($_SESSION['items'][$_GET["add_itm_qty"]])){
        if($_SESSION['items'][$_GET["add_itm_qty"]]["item_qty"] <= 29){
            $_SESSION['items'][$_GET["add_itm_qty"]]["item_qty"]+=1;
        }else{
            $_SESSION['items'][$_GET["add_itm_qty"]]["item_qty"]=30;    
        }          
    }        
    unset($_GET["add_itm_qty"]);
    exit(json_encode(array('items_in_cart'=>count($_SESSION['items']),(array('all_items'=>$_SESSION["items"])))));     
}

/* Subtract item quantity - deduct qty ONLY if item_qty is NOT smaller than 0  */
if(isset($_GET["subtruct_itm_qty"]) && isset($_SESSION["items"])){
    if(isset($_SESSION['items'][$_GET["subtruct_itm_qty"]])){
        if($_SESSION['items'][$_GET["subtruct_itm_qty"]]["item_qty"] >= 2){
            $_SESSION['items'][$_GET["subtruct_itm_qty"]]["item_qty"]-=1;    
        }else{
            $_SESSION['items'][$_GET["subtruct_itm_qty"]]["item_qty"]=1;    
        }        
    }
    unset($_GET["subtruct_itm_qty"]);
    /* Get item quantity and output it in json format */
    exit(json_encode((array('item_qty'=>$_SESSION["items"]))));     
}

/* Remove item from shopping cart */
if(isset($_GET["remove_item_from_cart"]) && isset($_SESSION["items"])){
    $item_id = $_GET["remove_item_from_cart"];
    /* Check if item is ina item session array */
	if(isset($_SESSION["items"][$item_id])){
		unset($_SESSION["items"][$item_id]);  // Remove/unset item
	}
    /* Calculate total number of items in cart and output it in json format */
    exit(json_encode(array('items_in_cart'=>count($_SESSION['items']))));    
}
?>
