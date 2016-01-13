<?php
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

//echo "<pre>";
//print_r($json); 
?>