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
        include 'szablony/_elements/_slider_module.php';
        ?>

    </div>
</div>

<div class="row content">
    <div class="col-md-12">
        <div class="row">

            <?php
            //ładuje formularz rejestracji
            include 'szablony/_elements/_registration_module.php';
            ?>

        </div>

    </div>
</div>
<?php
//ładowanei stopki
include 'szablony/_elements/footer.php';
?>
