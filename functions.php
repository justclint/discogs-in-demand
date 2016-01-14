<?php
/**
 *
 *
 * @package Discogs In Demand
 *
 * 
 */
?>


<?php
//require 'config.php';
    if (!isset($_POST['next'])) {
        $url = $url;
    } else {
        $url = $_POST['next'];
    }

function sortDemand($a, $b) 
{
    return $a->community->have - $b->community->have;
}
    

function findInDemand() {
    global $results;

    $demandResults = array();

    foreach ($results as $row) {
        
        $uri = $row->uri;
        $title = $row->title;
        $usersHave = $row->community->have;
        $usersWant = $row->community->want;
        $genreArray = $row->genre;
        $styleArray = $row->style;

        if ($usersHave == 0) {
            $usersDemand = $row->community->want * 100; 
        } else {
            $usersDemand = 100 * (($usersWant-$usersHave) / $usersHave);
        }
               
        $usersDemand = number_format((float)$usersDemand, 2, '.', '');

        if ($row->community->have < $row->community->want) {

            $demandResults[] = array(
                'uri' => $uri, 
                'title' => $title,
                'have' => $usersHave, 
                'want' => $usersWant, 
                'demand' => $usersDemand,
                'genre' => $genreArray,
                'style' => $styleArray
            );

        } 

    }

    return $demandResults;
}



$countInDemand = 0;
function getCountInDemand() {
    global $results;
    global $countInDemand;
    $i = 0;
    foreach ($results as $row) {
        
        if ($row->community->have < $row->community->want) {
            $i++;
        }   
    }
    $countInDemand = $i;
    echo $countInDemand;
}
?>