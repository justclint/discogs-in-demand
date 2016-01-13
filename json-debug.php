<?php

$url = "https://api.discogs.com/database/search?q=&type=release&per_page=100&token=bRqCIsfeccenixsilAWEaTvPQFdghYbQPFNBTsCr";
$userAgent = 'DiscogsInDemand/0.1 +http://justclint.com';

//initialize the session
$ch = curl_init();
//Set the User-Agent Identifier
curl_setopt($ch, CURLOPT_USERAGENT, $userAgent);
//Set the URL of the page or file to download.
curl_setopt($ch, CURLOPT_URL, $url);
//Ask cURL to return the contents in a variable instead of simply echoing them
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//Execute the curl session
$output = curl_exec($ch);
//close the session
curl_close ($ch);


$json = json_decode($output);

$results = $json->results;

//echo $output;
//echo json_encode($json, JSON_PRETTY_PRINT);

echo "<pre>";
print_r($json); 

?>