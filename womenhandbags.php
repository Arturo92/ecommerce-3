<?php include("login.php"); ?>

<?php
require_once("scripts/dbcontroller.php");
$db_handle = new DBController();

if(!empty($_GET["action"])) {
switch($_GET["action"]) {
	case "add":
		if(!empty($_POST["quantity"])) {
			$productByCode = $db_handle->runQuery("SELECT * FROM womenhandbags WHERE code='" . $_GET["code"] . "'");
			$itemArray = array($productByCode[0]["code"]=>array('name'=>$productByCode[0]["name"], 'code'=>$productByCode[0]["code"], 'quantity'=>$_POST["quantity"], 'price'=>$productByCode[0]["price"], 'image'=>$productByCode[0]["image"]));
			//session_id("cart");
			//session_start();
			if(!empty($_SESSION["cart_item"])) {
				if(in_array($productByCode[0]["code"],array_keys($_SESSION["cart_item"]))) {
					foreach($_SESSION["cart_item"] as $k => $v) {
							if($productByCode[0]["code"] == $k) {
								if(empty($_SESSION["cart_item"][$k]["quantity"])) {
									$_SESSION["cart_item"][$k]["quantity"] = 0;
									//session_write_close();
								}
								$_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
								//session_write_close();
							}
					}
				} else {
					$_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
					//session_write_close();
				}
			} else {
				$_SESSION["cart_item"] = $itemArray;
				//session_write_close();
			}
		}
	break;
	case "remove":
	    //session_id("cart");
		//session_start();
		if(!empty($_SESSION["cart_item"])) {
			
			foreach($_SESSION["cart_item"] as $k => $v) {
					if($_GET["code"] == $k)
						unset($_SESSION["cart_item"][$k]);
                        
					if(empty($_SESSION["cart_item"]))
						unset($_SESSION["cart_item"]);
					   // session_write_close();
					    
			}
		}
	break;
	case "empty":
				//session_id("cart");
			    //session_start();
		        unset($_SESSION["cart_item"]);
				//session_write_close();
			
	break;
}
}
?>

<?php include("arrays.php"); ?>
    <!DOCTYPE html>
	<html>
	    <head>
		<title>Saint Laurent | Store</title>
		    <meta name="viewport" content="width=device-width, initial-scale=1.0">
			<?php foreach($stylesheets as $stylesheet){
				echo "<link rel='stylesheet' type='text/css' href='static/stylesheets/".$stylesheet."'>";
			} ?>
			
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		</head>
		<body>
		    <div class="wrapper">
<div class="toolbar">
    <div class="toolbar-holder">
	    <div style="float:right;">
		    <input style="width:16%;" type="text" id="searchbar" placeholder="Search store"> 
			<?php if(!empty($_SESSION['username'])){ echo "<p id='session_user_id' style='float:left; font-size:18px; padding-right:6px;'>" . $_SESSION['username'] . "</p>"; echo "<script> $(document).ready(function(){ $('.logouts').show(); $('.logins').hide(); }); </script>"; } ?>
	    </div>
		<br/>
		<br/>
		<br/>
	    <div class="menu-links-divs">
		    <a id="dl" class="menu-links" href="shopwomen.php">Shop Women</a>
			<a id="ml" class="menu-links" href="shopmen.php">Shop Men</a>
			<a id="cl" class="menu-links" href="collections.php">Collections</a>
			<a class="menu-links" href="stores.php">Store Locator</a>
			<a class="menu-links" href="handbags.php">Client Service</a>
		</div>
	</div>
	<br/>
	<br/>
	<div class="logo-holder">
	    <h1 style="font-size:82px;" id="logo"><a style="color:black; text-decoration:none;" href="index.php">Saint Laurent</a></h1>
	</div>

   <ul style="float:left; width:30%;" id="content"></ul>
</div>

<div class="menu">
    <div id="designerlink" class="menu-link">
	<h1 id="featureddesigners">Womens Store</h1>
	<a href="womenshoes.php">Shoes</a>
    <a href="womenhandbags.php">Hand bags</a>
	<a href="womenminibags.php">Mini bags</a>
	<a href="womenjewlary.php">Jewlary</a>
	</div>
	
    <div id="designerlink2" class="menu-link">
	<h1 id="featureddesigners">Mens Store</h1>
	<a href="menshoes.php">Shoes</a>
    <a href="menhandbags.php">Hand bags</a>
	<a href="menminibags.php">Mini bags</a>
	<a href="menjewlary.php">Jewlary</a>
	</div>
	
	 <div id="designerlink3" class="menu-link">
	<h1 id="featureddesigners">Fashion catalogs</h1>
	<a href="menssummerspring20.php">Men's Summer Spring 20</a>
    <a href="womenswinter19.php">Womens Winter 19</a>
	<a href="womenssummer19.php">Womens Summer 19</a>
	<a href="womenspring19.php">Womens Spring 19</a>
	</div>
	
</div>
<script>
    $(document).ready(function(){

		$("#dl").hover(function(){
			$("#designerlink").show();
			$("#designerlink2, #designerlink3").hide();
		});
		
		$("#dl").mouseleave(function(){
			$("#designerlink").show();
		});
		
		$("#ml").hover(function(){
			$("#designerlink, #designerlink3").hide();
			$("#designerlink2").show();
		});
		
		$("#ml").mouseleave(function(){
			$("#designerlink2").show();
		});
		
		$("#cl").hover(function(){
			$("#designerlink, #designerlink2").hide();
			$("#designerlink3").show();
		});
		
		$("#cl").mouseleave(function(){
			$("#designerlink3").show();
		});
		
		$("#designerlink, #designerlink2, #designerlink3").mouseleave(function(){
			$("#designerlink, #designerlink2, #designerlink3").hide();
		});
		
		$(".login-form").hide();
	});
</script>
<div id="shopping-cart">
<div class="txt-heading">Shopping Cart</div>

<a id="btnEmpty" href="womenhandbags.php?action=empty">Empty Cart</a>
<?php
if(isset($_SESSION["cart_item"])){
    $total_quantity = 0;
    $total_price = 0;
?>	
<table class="tbl-cart" cellpadding="10" cellspacing="1">
<tbody>
<tr>
<th style="text-align:left;">Name</th>
<th style="text-align:left;">Code</th>
<th style="text-align:right;" width="5%">Quantity</th>
<th style="text-align:right;" width="10%">Unit Price</th>
<th style="text-align:right;" width="10%">Price</th>
<th style="text-align:center;" width="5%">Remove</th>
</tr>	
<?php		
    foreach ($_SESSION["cart_item"] as $item){
        $item_price = $item["quantity"]*$item["price"];
		?>
				<tr>
				<td><img src="<?php echo $item["image"]; ?>" class="cart-item-image" /><?php echo $item["name"]; ?></td>
				<td><?php echo $item["code"]; ?></td>
				<td style="text-align:right;"><?php echo $item["quantity"]; ?></td>
				<td  style="text-align:right;"><?php echo "$ ".$item["price"]; ?></td>
				<td  style="text-align:right;"><?php echo "$ ". number_format($item_price,2); ?></td>
				<td style="text-align:center;"><a href="womenhandbags.php?action=remove&code=<?php echo $item["code"]; ?>" class="btnRemoveAction"><img src="icon-delete.png" alt="Remove Item" /></a></td>
				</tr>
				<?php
				$total_quantity += $item["quantity"];
				$total_price += ($item["price"]*$item["quantity"]);
		}
		?>

<tr>
<td colspan="2" align="right">Total:</td>
<td align="right"><?php echo $total_quantity; ?></td>
<td align="right" colspan="2"><strong><?php echo "$ ".number_format($total_price, 2); ?></strong></td>
<td></td>
</tr>
</tbody>
</table>		
  <?php
} else {
?>
<div class="no-records">Your Cart is Empty</div>
<?php 
}
?>
</div>

<div id="product-grid">
	<div class="txt-heading">Products</div>
	<?php
	$product_array = $db_handle->runQuery("SELECT * FROM womenhandbags ORDER BY id ASC");
	if (!empty($product_array)) { 
		foreach($product_array as $key=>$value){
	?>
		<div style="height:600px; width:450px; margin-left:9%; margin-top:8%;" class="product-item">
			<form method="post" action="womenhandbags.php?action=add&code=<?php echo $product_array[$key]["code"]; ?>">
			<div class="product-image"><img height="480px" width="450px" src="<?php echo $product_array[$key]["image"]; ?>"></div>
			<div style="margin-top:100%;" class="product-tile-footer">
			<div style="text-align:center;" class="product-title"><?php echo $product_array[$key]["name"]; ?></div>
			<div class="product-price"><?php echo "$".$product_array[$key]["price"]; ?></div>
			<div class="cart-action"><input type="text" class="product-quantity" name="quantity" value="0" size="2" /><input type="submit" value="Add to Cart" class="btnAddAction" /></div>
			</div>
			</form>
		</div>
	<?php
		}
	}
	?>
</div>
<script>
    $(document).ready(function(){
		$(".login-form").hide();
	});
</script>
                <?php
			foreach($scripts as $script){
				echo "<script src='static/js/".$script."'></script>";
			}
			?>
			</div>
		</body>
	</html>