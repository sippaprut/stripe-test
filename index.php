<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Stripe form</title>
</head>
<body>
	
	<?php include( 'config.php' ); ?>
	
	<form action="save.php" method="POST">
	  <script
	    src="https://checkout.stripe.com/checkout.js" class="stripe-button"
	    data-key="<?php echo $config['pkkey'];?>"
	    data-amount="999"
	    data-name="Demo Site"
	    data-description="Widget"
	    data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
	    data-locale="auto">
	  </script>
	</form>


	
</body>
</html>