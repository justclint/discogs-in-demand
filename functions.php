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
	    $url = "https://api.discogs.com/database/search?q=&type=release&per_page=100&token=bRqCIsfeccenixsilAWEaTvPQFdghYbQPFNBTsCr";
	} else {
	    $url = $_POST['next'];
	}





function sortHave($a, $b) 
{
    return $a->community->have - $b->community->have;
}



function findInDemand() {
    global $results;

//100*(want-have)/have

    foreach ($results as $row) {
        
        $usersHave = $row->community->have;
        $usersWant = $row->community->want;

        /**
         * Difference of have/want
         * @var integer
         */
        $dif = $row->community->want - $row->community->have; 
        
        /**
         * Average of have/want      
         * @var integer
         */
        $avg = ($row->community->want + $row->community->have) / 2; 

        /**
         * Percentage of have/want
         * @var integer
         */
        //$percentage = ($dif / $avg) * 100;         


        if ($usersHave === 0) {
            $usersDemand = $row->community->want * 100; 
        } else {
            $usersDemand = 100 * (($usersWant-$usersHave) / $usersHave);
        }

               
        $usersDemand = number_format((float)$usersDemand, 2, '.', '');


        if ($row->community->have < $row->community->want) {

            echo '<ul>';
            echo '<li class="title"><a href="http://discogs.com' . $row->uri . '" target="_blank">' . $row->title . '</a></li>';
            echo '<li class="have">' . $usersHave . '</li>';
            echo '<li class="want">' . $usersWant . '</li>';
            echo '<li class="want">' . $usersDemand . '%</li>';
            
            $genraArray = $row->genre;
            $styleArray = $row->style;

            echo '<li class="genre">';
            foreach ($genraArray as $key => $value){
                echo "$genraArray[$key]"."</br>";
            }
            echo '</li>';

            echo '<li class="style">';
            foreach ($styleArray as $key => $value){
                echo "$styleArray[$key]"."</br>";
            }
            echo '</li>';

            //echo '<li class="ratio">' . $row->genre . '</li>';
            //echo '<li class="ratio">' . $row->style . '</li>';
            echo '</ul>';
        }   
    }

    //usort($results, sortHave);

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