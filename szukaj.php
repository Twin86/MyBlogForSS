<?php
//ładuje nagłówek
include 'szablony/_elements/header.php';
?>

    <div class="row">
        <div class="col-md-12 slider">

            <?php
            $img_table = array('img/slider/1.jpg', 'img/slider/2.jpg', 'img/slider/3.jpg', 'img/slider/4.jpg');
            echo '<img src="' . $img_table[rand(0, sizeof($img_table) - 1)] . '">';
            ?>

        </div>
    </div>
    <div class="row news">
        <div class="col-md-12">

            <?php
            echo '<h2>Nadchodzące mecze.txt, ciekawe wyniki.</h2>';
            ?>

        </div>
    </div>
    <div class="row content">
        <div class="col-md-12">
            <div class="row">
                        <!-- moduł szukania fraz w bazie -->
                        <?php include 'szablony/_elements/_szukaj.php';?>
            </div>
            <div class="row wynik-szukania ">

                <?php
                //moduł wyświetlający podobne frazy
                Szukaj_podobnych($_GET["szukaj"]);
                ?>

            </div>
            <div class="row extras">

                <?php

                ?>

                <div class="col-md-4 ">
                    <img src="img/the-ball-488709_1920.jpg">
                    <p>słów kilka o taktyce</p>
                </div>
                <div class="col-md-4 ">
                    <img src="img/soccer-1273968_1920.jpg">
                    <p>co słychać na orliku</p>
                </div>
                <div class="col-md-4 ">
                    <img src="img/door-husband-1271621_1920.jpg">
                    <p>mocny punkt</p>
                </div>
            </div>

        </div>
        </div>
    <div class="row sponsorzy">
        <div class="col-md-12">
            <h2>Na tapecie</h2>

            <?php
            Sponsor_img_load();
            ?>
        </div>
    </div>
<?php
//ładowanei stopki
include 'szablony/_elements/footer.php';
?>