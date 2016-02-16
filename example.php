<?php 
require 'config.php';
require 'functions.php';
require 'discogs-api.php';
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

         <?php
         
         ?>   

        <div style="clear:both;">Total Releases: <?php echo $json->pagination->items ?>   -   Total In Demand: <?php getCountInDemand(); ?> of 100 per page</div>            

        <div class="page-nav">

        <?php 
            if (isset($urlPrevious)) { 
                echo '<button onclick="history.go(-1);">Back </button>';
            }
        ?>    
            <form method="post" action=""> 
                <input type="hidden" name="next" value="<?php echo $json->pagination->urls->next; ?>">
                <input type="submit" value="Next" name="submitNext">
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

<?php 
    $arrayDemand = findInDemand();

    usort($arrayDemand, "sortDemand");

    foreach ($arrayDemand as $key => $value) {

        echo '<ul>';
        echo '<li class="title"><a href="http://discogs.com' . $value['uri'] . '" target="_blank">' . $value['title'] . '</a></li>';
        echo '<li class="have">' . $value['have'] . '</li>';
        echo '<li class="want">' . $value['want'] . '</li>';
        echo '<li class="want">' . $value['demand'] . '%</li>';

        echo '<li class="genre">';
        foreach ($value['genre'] as $genres => $genre) {
             echo '<div>';
             print_r($genre);
        }
        echo '</li>';

        echo '<li class="style">';
        foreach ($value['style'] as $styles => $style) {
             echo '<div>';
             print_r($style);
        }
        echo '</li>';

        echo '</ul>';
       
    } 
?>

        </div>

    </body>
</html>
