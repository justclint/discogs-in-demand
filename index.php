<?php 
require 'functions.php';
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

