<?php
/**
 * Created by PhpStorm.
 * User: seba
 * Date: 10.05.16
 * Time: 13:08
 */
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET["change_status"])) {
        if ($_GET["change_status"] == true) {
            $sql = 'select on_off from wpisy where id_wpis = ' . $_GET["id"];
            $conn = Connect_to_server2();
            $wynik = $conn->query($sql);

            if ($conn->error) {
                printf("Errormessage: %s\n", $conn->error);
            } else {
                if ($wynik->num_rows > 0) {
                    while ($row = $wynik->fetch_assoc()) {
                        if ($row["on_off"] == 1) {
                            $conn->query('update wpisy set on_off = 0 where id_wpis = ' . $_GET["id"]);
                            if ($conn->error) {
                                printf("Errormessage: %s\n", $conn->error);
                            }
                        } else {
                            $conn->query('update wpisy set on_off = 1 where id_wpis = ' . $_GET["id"]);
                            if ($conn->error) {
                                printf("Errormessage: %s\n", $conn->error);
                            }
                        }
                    }
                } else echo 'Brak danych';
            }
            $conn->close();

        }
    }
    if (isset($_GET["del"])) {
        if ($_GET["del"] == true) {
            $sql = 'delete from wpisy where id_wpis = ' . $_GET["id"];
            $conn = Connect_to_server2();
            $wynik = $conn->query($sql);

            if ($conn->error) {
                printf("Errormessage: %s\n", $conn->error);
            } else {
                echo '<div class="alert alert-success" role="alert">OK, wpis usunięty prawidłowo !</div>';
            }
            $conn->close();

        }
    }

}


?>

<div class="col-md-12">
    <div class="row">
        <div class="col-md-offset-1 col-md-3 ">
            <div class="info-page ">
                <?php Pages_short_stat('active_page') ?>
            </div>
        </div>
        <div class="col-md-3 ">
            <div class="info-page">
                <?php Pages_short_stat('disable_page') ?>
            </div>
        </div>
        <div class="col-md-3 ">
            <div class="info-page">
                <?php Pages_short_stat('all_comments') ?>
            </div>
        </div>
    </div>
    <div class="row">
        <?php Show_posts_table() ?>
    </div>
</div>
