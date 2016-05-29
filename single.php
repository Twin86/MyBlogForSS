<?php
//ładuje nagłówek
include 'szablony/_elements/header.php';
?>

<?php

include 'szablony/_elements/_lib/myPostTools.php';

?>
<div class="row">
    <div class="col-md-12 slider">

        <?php
        echo '<img src="' . $tablica[0]["img_url"] . '">';
        ?>

    </div>
</div>

<div class="row content">
    <div class="col-md-12">
        <div class="row">

            <?php

            if (count($tablica) > 0) {
                // output data of each row
                foreach ($tablica as $row) {

                    $wpis = '<div class="col-md-12 wpis">';
                    $wpis = $wpis . '<h2>' . $row["title"] . '</h2><h3><i class="fa fa-calendar" aria-hidden="true"></i>' . $row["data_wpis"] . '</h3><p>' . $row["wpis"] . '<h3>Autor :' . $row["autor"] . '</h3></div>';
                    echo $wpis;
                }

            } else {

                echo "Brak treści do wyświetlenia.";
            }

            ?>

        </div>


    </div>
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-8">
                <!--sekcja dla komentarzy-->
                <div class="row komentarze">
                    <h3>Komentarze</h3>
                    <div class="col-md-12 komentarz">
                        <?php
                        Show_comments($id_post);
                        ?>


                    </div>
                    <div class="col-md-12 komentarz">
                        <!-- ładowanie formularza dodawania komentarza -->
                        <?php
                        include 'szablony/_elements/_comment_module.php';
                        ?>
                    </div>
                </div>
                <!-- koniec sekcji komentarzy -->
            </div>
            <div class="col-md-4 right-col">
                <div class="row">
                    <!-- moduł szukania fraz w bazie -->
                    <?php include 'szablony/_elements/_szukaj.php';?>
                </div>
                <!-- moduł wyświetlania galerii -->
                <?php
                include 'szablony/_elements/_gallery_mode';
                ?>

           </div>
        </div>


    </div>
</div>
<?php
//ładowanei stopki
include 'szablony/_elements/footer.php';
?>
