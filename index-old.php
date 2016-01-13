<?php

if (!isset($_POST['next'])) {
    $url = "https://api.discogs.com/database/search?q=&type=release&per_page=100&token=HGUPsTxYTOaDqzQcKVDLBLRbnHzlKaxiqLdfSClN";
    //echo $url;
} else {
    $url = $_POST['next'];
    //echo $_POST['next'];
}

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
//echo "<pre>";
//echo json_encode($json, JSON_PRETTY_PRINT);
//print_r($json); 

function sortHave($a, $b)
{
    return $a->community->have - $b->community->have;
}

usort($results, sortHave);

function findInDemand() {
    global $results;



    foreach ($results as $row) {
        
        $usersHave = $row->community->have;
        $usersWant = $row->community->want;
        $usersDemand = $row->community->want / $row->community->have;        
        $usersDemand = number_format((float)$usersDemand, 2, '.', '');


        if ($row->community->have < $row->community->want) {

            echo '<ul>';
            echo '<li class="title"><a href="http://discogs.com' . $row->uri . '" target="_blank">' . $row->title . '</a></li>';
            echo '<li class="have">' . $usersHave . '</li>';
            echo '<li class="want">' . $usersWant . '</li>';
            echo '<li class="want">' . $usersDemand . '</li>';
            
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

    sortHave();

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

<!doctype html>

<html lang="en">
    <head>
        <meta charset="utf-8">

        <title>Discogs In Demand Finder</title>
        <meta name="description" content="The HTML5 Herald">
        <meta name="author" content="justclint">

        <style type="text/css">
            .container {
                width:90%;
                margin:0 auto;
            }
            .page-nav {
                width:100%;
            }
            .page-nav li {
                width:50%;
            }
            ul {
                list-style: none;
                overflow: hidden;
                border-bottom: 1px dotted #e8e8e8;
            }
            li {
                float:left;
                text-align: left;
                height: 100%;
                display:block;
                margin-bottom: 20px;
                
            } 
            li.title {
                width:45%;
            }
            li.have, li.have, li.want, li.demand, li.genre, li.style {
                width:8%;
                /*padding:0 10px;*/
            }
        </style>

        <!--[if lt IE 9]>
        <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
    </head>

    <body>

        <div class="container">        

<div style="clear:both;">Total Releases: <?php echo $json->pagination->items ?>   -   Total In Demand: <?php getCountInDemand(); ?> of 100 per page</div>            

            <div class="page-nav">
                <form method="post" action=""> 
                    <input type="hidden" name="next" value="<?php echo $json->pagination->urls->next; ?>">
                    <input type="submit" value="Next" name="submit">
                </form>
            </div>

            <ul>
                <li class="title">Title</li>
                <li class="have">Have</li>
                <li class="want">Want</li>
                <li class="demand">Demand</li>
                <li class="genre">Genre</li>
                <li class="style">Style</li>
            </ul>

            <?php findInDemand(); ?>          

        </div>

    </body>
</html>

