<h1>welcome to my app</h1>
<?php 
	session_start();
	require __DIR__.'/vendor/autoload.php';
	use phpish\shopify;
	require __DIR__.'/conf.php';
	$shopify = shopify\client($_SESSION['shop'], SHOPIFY_APP_API_KEY, $_SESSION['oauth_token']);
	try
	{
		# Making an API request can throw an exception
		$shop_obj_url = $api_url . '/admin/shop.json';
		$shop_content = @file_get_contents( $shop_obj_url );
		// Decode the JSON
		$shop_json = json_decode( $shop_content, true );
		// Create a variable to make the rest of the code more readable
		$shop = $shop_json['shop'];
		 echo "Email is:". $shop['email']; 
		 echo shopify store name:''. $shop['name'];
		//$products = $shopify('GET /admin/products.json', array('published_status'=>'published'));
		//print_r($products);
	}
	catch (shopify\ApiException $e)
	{
		# HTTP status code was >= 400 or response contained the key 'errors'
		echo $e;
		print_r($e->getRequest());
		print_r($e->getResponse());
	}
	catch (shopify\CurlException $e)
	{
		# cURL error
		echo $e;
		print_r($e->getRequest());
		print_r($e->getResponse());
	}
	?>
