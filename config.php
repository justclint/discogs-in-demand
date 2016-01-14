<?php
/**
 * Use this file to add any configurations.
 * 
 * @package Discogs In Demand
 * 
 */

/**
 * Discogs requires a unique user agent
 * @var string
 */
$userAgent = 'DiscogsInDemand/0.1 +http://justclint.com';

/**
 * Get the token from the developers section of your Discogs account 
 * @var string
 */
$token = 'bRqCIsfeccenixsilAWEaTvPQFdghYbQPFNBTsCr';

/**
 * Discogs API URL
 * @var string
 */
$url = 'https://api.discogs.com/database/search?q=&type=release&per_page=100&token=' . $token;

?>