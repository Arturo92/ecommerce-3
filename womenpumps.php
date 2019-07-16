<?php include("logger.php"); ?>

<?php
require_once("scripts/dbcontroller.php");
$db_handle = new DBController();

if(!empty($_GET["action"])) {
switch($_GET["action"]) {
	case "add":
		if(!empty($_POST["quantity"])) {
			$productByCode = $db_handle->runQuery("SELECT * FROM womenpumps WHERE code='" . $_GET["code"] . "'");
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
			<link rel="stylesheet" type="text/css" href="static/stylesheets/index.css">
			<link rel="stylesheet" type="text/css" href="static/stylesheets/guccitoolbar.css">
			<link rel="stylesheet" type="text/css" href="static/stylesheets/style.css">
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		</head>
		<body>
		    <div style="display:none;" class="wrapper">
<div class="toolbar">
    <div class="toolbar-holder">
	<div class="menu-links-divs">
	<input style="float:left; width:16%;" type="text name="search" id="searchbar" placeholder="Search">
	<a id="login" class="logins" href="login.php">Log in</a>
			<a id="logout" style="display:none; color:green; text-decoration:none; float:right;" class="logouts" href="<?php echo $_SERVER['PHP_SELF']; ?>?logout='1'">Logout</a>
	
		  <div style="margin-right:18%;">  <a id="dl" class="menu-links" href="womenshoes.php">Shop Women</a>
			<a id="ml" class="menu-links" href="shopmen.php">Shop Men</a>
			<a id="cl" class="menu-links" href="collections.php">Collections</a>
			<a id="sl" class="menu-links" href="stores.php">Store Locator</a>
			<a id="cs" class="menu-links" href="handbags.php">Client Service</a>
			</div>
	<?php if(isset($_GET['logout'])){ echo "<script> $(document).ready(function(){ $('.logins').hide(); }); </script>"; session_destroy(); unset($_SESSION['username']); header("location: index.php"); } ?>
	
		</div>
	</div>
	<ul style="float:left; width:30%; position:absolute;" id="content"></ul>
	<?php if(!empty($_SESSION['username'])) { echo "<p id='session_user_id' style='float:right; font-size:18px; padding-right:12px; color:white;'>" . "Welcome " . $_SESSION['username'] . "</p>";  echo "<script> $(document).ready(function(){ $('.logouts').show(); $('.logins').hide(); }); </script>"; } ?>
</div>

<div class="menu" style="width:98.2%; text-align:center; background-color:black;">
    <div id="designerlink" class="menu-link">
	<a id="womenshoesid" style="color:white;" href="womenshoes.php">Shoes</a>
    <a style="color:white;" href="womenhandbags.php">Hand bags</a>
	<a style="color:white;" href="womenminibags.php">Mini bags</a>
	<a style="color:white;" href="womenjewlary.php">Jewlary</a>
	</div>
	
    <div id="designerlink2" class="menu-link">
	<a style="color:white;" href="menshoes.php">Shoes</a>
    <a style="color:white;" href="menhandbags.php">Hand bags</a>
	<a style="color:white;" href="menminibags.php">Mini bags</a>
	<a style="color:white;" href="menjewlary.php">Jewlary</a>
	</div>
	
	 <div id="designerlink3" class="menu-link">
	<a style="color:white;" href="menssummerspring20.php">Men's Summer Spring 20</a>
    <a style="color:white;" href="womenswinter19.php">Womens Winter 19</a>
	<a style="color:white;" href="womenssummer19.php">Womens Summer 19</a>
	<a style="color:white;" href="womenspring19.php">Womens Spring 19</a>
	</div>
	
</div>

 <div id="designerlinksub" class="menu-link" style=" width:100%; display:none; text-align:center; background-color:black;">
	<a style="color:white;" href="womenpumps.php">Pumps</a>
    <a style="color:white;" href="womenhandbags.php">High Heels</a>
	<a style="color:white;" href="womenminibags.php">Sandals</a>
	<a style="color:white;" href="womenjewlary.php">Jewlary</a>
	</div>
	
    <div id="designerlink2sub" class="menu-link" style="display:none;">
	<h1 style="color:white;" id="featureddesigners">Mens Store</h1>
	<a style="color:white;" href="menshoes.php">Shoes</a>
    <a style="color:white;" href="menhandbags.php">Hand bags</a>
	<a style="color:white;" href="menminibags.php">Mini bags</a>
	<a style="color:white;" href="menjewlary.php">Jewlary</a>
	</div>
	
	 <div id="designerlink3sub" class="menu-link" style="display:none;">
	<h1 style="color:white;" id="featureddesigners">Fashion catalogs</h1>
	<a style="color:white;" href="menssummerspring20.php">Men's Summer Spring 20</a>
    <a style="color:white;" href="womenswinter19.php">Womens Winter 19</a>
	<a style="color:white;" href="womenssummer19.php">Womens Summer 19</a>
	<a style="color:white;" href="womenspring19.php">Womens Spring 19</a>
	</div>
<script>
    $(document).ready(function(){

        $(".wrapper").fadeIn(600);
		
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
		
		//$("#designerlink, #designerlink2, #designerlink3").mouseleave(function(){
			//$("#designerlink, #designerlink2, #designerlink3").hide();
		//});
		
		$("#cs, #sl").hover(function(){
			$(".menu-link").hide();
		});
		
		$("#womenshoesid").hover(function(){
			$("#designerlinksub").show();
		});
		
		$("#designerlinksub").mouseleave(function(){
			$("#designerlink").hide();
			$(this).hide();
		});
	});
</script>
<div class="logo-holder">
	    <h1 style="font-size:82px; margin-left:1.24%;"id="logo"><a style="color:black; text-decoration:none;" href="index.php">Saint Laurent</a></h1>
	</div>
<div id="shopping-cart">
<!--<div class="txt-heading">Shopping Cart</div>

<a id="btnEmpty" href="womenshoes.php?action=empty">Empty Cart</a>-->
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
				<td style="text-align:center;"><a href="womenshoes.php?action=remove&code=<?php echo $item["code"]; ?>" class="btnRemoveAction"><img src="icon-delete.png" alt="Remove Item" /></a></td>
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
<!-- <div class="no-records">Your Cart is Empty</div> -->
<?php 
}
?>
</div>

<div id="product-grid">
	<!--<div class="txt-heading">Products</div>-->
	<?php
	$product_array = $db_handle->runQuery("SELECT * FROM womenpumps ORDER BY id ASC");
	if (!empty($product_array)) { 
		foreach($product_array as $key=>$value){
	?>
		<div style="height:600px; width:450px; margin-left:9%; margin-top:8%; border:black solid 0;" class="product-item">
			<form method="post" action="womenshoes.php?action=add&code=<?php echo $product_array[$key]["code"]; ?>">
			<div class="product-image"><img height="460px" width="450px" src="<?php echo $product_array[$key]["image"]; ?>"></div>
			<!--<div style="margin-top:100%;" class="product-tile-footer"> -->
			<div style="text-align:center; margin-top:100%;" class="product-title"><?php echo $product_array[$key]["name"]; ?></div>
			<div class="product-price"><?php echo "$".$product_array[$key]["price"]; ?></div>
			<!--<div class="cart-action"><input type="text" class="product-quantity" name="quantity" value="0" size="2" /><input type="submit" style="background-color:transparent;" value="Add to Cart" class="btnAddAction" /></div>
			</div>-->
			</form>
		</div>
	<?php
		}
	}
	?>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		$('#searchbar').on('input', function() {
			var searchKeyword = $(this).val();
			if (searchKeyword.length >= 3) {
				$.post('search.php', { keywords: searchKeyword }, function(data) {
					$('ul#content').empty();
					$.each(data, function() {
						$('ul#content').append('<li style="list-style-type:none;"><a style="color:black; padding:8px; text-decoration:none; font-size:16px; float:left;" href="' + this.page_name + '.php?id=' + this.id + '">' + this.title + '</a></li>');
					});
				}, "json");
			}
			
			if(searchKeyword.length <= 0){
				$('ul#content').empty();
			}
		});
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