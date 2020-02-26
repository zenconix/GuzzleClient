<html>
<head>
<title>Guzzle test </title>
</head>
<body>

<!--sitepoint.com/feed-->
<form>
Enter input URL <input type="text" name="url" />
</br>
<input type="submit" value="Get Data"/>
</form>
<?php
	if(isset($_REQUEST['url']))
	{
		require './vendor/autoload.php';
		
		$client = new GuzzleHttp\Client([
			'header' => ['User-Agent' =>'MyReader']
		]);
		
		$response = $client->request('GET', $_REQUEST['url']);
		if($response ->getStatusCode()==200)
		{
			if($response->hasHeader('content-length'))
			{
				$contentLength = $response->getHeader('content-length')[0];
				echo $contentLength; 
			}
			$body = $response->getBody();
			$xml = new SimpleXmlElement($body);
			foreach($xml->channel->item as $item)
			{
				echo "<h3>" . $item->title ."</h3>";
				echo "<p>". $item->description ."</p>";
			}
			
			
		}
	}
?>
</body>
</html>