<?php include("arrays.php"); ?>
    <!DOCTYPE html>
	<html>
	    <head>
		<title>Saint Laurent | Store</title>
		    <meta name="viewport" content="width=device-width, initial-scale=1.0">
			<link rel="stylesheet" type="text/css" href="static/stylesheets/index.css">
			<link rel="stylesheet" type="text/css" href="static/stylesheets/guccitoolbar.css">
			
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		</head>
		<body style="background-color:black;">
		    <div style="display:none;" class="wrapper">
<?php include("logger.php"); ?>
<div class="toolbar">
    <div class="toolbar-holder">
	<div class="menu-links-divs">
	<input style="float:left; width:16%;" type="text name="search" id="searchbar" placeholder="Search">
	<a style="color:white;" id="login" class="logins" href="login.php">Log in</a>
			<a id="logout" style="display:none; color:white; text-decoration:none; float:right; font-family: 'Prata', serif;" class="logouts" href="<?php echo $_SERVER['PHP_SELF']; ?>?logout='1'">Logout</a>
	
		  <div style="margin-right:18%;">  
            <a id="dl" class="menu-links" href="womenshoes.php">Shop Women</a>
			<a id="ml" class="menu-links" href="shopmen.php">Shop Men</a>
			<a id="cl" class="menu-links" href="collections.php">Collections</a>
			<a id="sl" class="menu-links" href="stores.php">Store Locator</a>
			<a id="cs" class="menu-links" href="handbags.php">Client Service</a>
			</div>
	<?php if(isset($_GET['logout'])){ echo "<script> $(document).ready(function(){ $('.logins').hide(); }); </script>"; session_destroy(); unset($_SESSION['username']); header("location: index.php"); } ?>
	
		</div>
	</div>
	
<div class="menu" style="padding-left:6%;">
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

    <div id="designerlinksub" class="menu-link" style="display:none; text-align:center;">
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
		
		$('.wrapper').fadeIn(1000);
		
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
	<ul style="float:left; width:30%;" id="content"></ul>
	<?php if(!empty($_SESSION['username'])) { echo "<p id='session_user_id' style='float:right; font-size:18px; padding-right:12px; color:white;'>" . "Welcome " . $_SESSION['username'] . "</p>";  echo "<script> $(document).ready(function(){ $('.logouts').show(); $('.logins').hide(); }); </script>"; } ?>
	<video style="outline:none;" width="100%" height="auto" controls autoplay>
  <source src="video.mp4" type="video/mp4">
</video>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		$('#searchbar').on('input', function() {
			var searchKeyword = $(this).val();
			if (searchKeyword.length >= 3) {
				$.post('search.php', { keywords: searchKeyword }, function(data) {
					$('ul#content').empty();
					$.each(data, function() {
						$('ul#content').append('<li style="list-style-type:none;"><a style="color:white; padding:8px; text-decoration:none; font-size:16px; float:left;" href="' + this.page_name + '.php?id=' + this.id + '">' + this.title + '</a></li>');
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