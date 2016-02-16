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
$userAgent = 'USERAGENT';

/**
 * Get the token from the developers section of your Discogs account 
 * @var string
 */
$token = 'TOKEN';

/**
 * Discogs API URL
 * @var string
 */
$url = 'https://api.discogs.com/database/search?q=&type=release&per_page=100&token=' . $token;

?>
