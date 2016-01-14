<?php
/**
 *
 *
 * @package Discogs In Demand
 *
 * 
 */

/**
 * Check urls for next previous buttons
 */
if (!isset($_POST['next'])) {
    $url = $url;
} else {
    $url = $_POST['next'];
    $urlPrevious = "";
}    


/**
 * A compare funtion to sort releases by the in demand percentage
 * @param  integer $a gets $value['demand']
 * @param  integer $b gets $value['demand']
 * @return integer    the sort order
 */
function sortDemand($a, $b){
    return $b['demand'] - $a['demand'];
}

/**
 * Reads json $results from Discogs.
 * Then converts to an associated array.
 * Then filters the releases that are in demand (have < want)
 * 
 * @return [type] [description]
 */
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

/**
 * The number count of releases in demand (have < want) 
 * @return integer 
 */

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