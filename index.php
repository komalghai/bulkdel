<?php
echo "<h1>welcome to my app</h1>";
	session_start();
		ini_set('display_startup_errors',1);
	ini_set('display_errors',1);
	error_reporting(-1);
	require __DIR__.'/vendor/autoload.php';
	use phpish\shopify;
	require __DIR__.'/conf.php';
	echo "<pre>";
	print_r($_SESSION);
	echo "</pre>";
	echo "dkcjdskjfckdjgvgv   ".$_SESSION['oauth_token'];
	$shopify = shopify\client($_SESSION['shop'], SHOPIFY_APP_API_KEY, $_SESSION['oauth_token']);
	try
	{
		# Making an API request can throw an exception
		$shop = $shopify('GET /admin/shop.json');
		print_r($shop);
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
