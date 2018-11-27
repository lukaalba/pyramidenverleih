<!DOCTYPE html>
<html>
    <head>
        <title>Cheops GmbH - Home</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport" charset="utf-16">
        <link href="style.css" rel="stylesheet" type="text/css"/>
        <link href="home.css" rel="stylesheet" type="text/css"/>
        <script src="script.js"></script>
        <script src="search.js"></script>
    </head>
    <body onload="currentSlide(1)">
        <?php
            require('header.php');
        ?>

        <div class="slideshow-container">
            <div class="mySlides fade">
                <div class="numbertext">1 / 2</div>
                <img src="images/pyramide.jpg" style="width:100%">
                <div class="text">Pyramide leihen!</div>
            </div>
            <div class="mySlides fade">
                <div class="numbertext">2 / 2</div>
                <img src="images/sphinx.jpg" style="width:100%">
                <div class="text">Sphinx leihen!</div>
            </div>
            <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
            <a class="next" onclick="plusSlides(1)">&#10095;</a>
        </div>
        <br/>
        <div style="text-align:center">
            <span class="dot" onclick="currentSlide(1)"></span>
            <span class="dot" onclick="currentSlide(2)"></span>
        </div>
        <br/>

        <?php
            require('footer.php');
         ?>
     </body>
 </html>
