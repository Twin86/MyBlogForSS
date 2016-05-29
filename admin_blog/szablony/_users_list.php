<?php
/**
 * Created by PhpStorm.
 * User: seba
 * Date: 26.04.16
 * Time: 21:57
 */
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET["del"]) && $_GET["del"] == true) {
        echo 'usuwa usera z id ' . $_GET["id"];
        $conn = Connect_to_server2();
        $sql = 'delete from users where id_user = ' . $_GET["id"];
        $wynik = $conn->query($sql);
        $conn->close();

        if ($conn->error) {
            printf("Errormessage: %s\n", $conn->error);
        }

        $conn->close();
    }

    if (isset($_GET["lock"]) && $_GET["lock"] == true) {
        $conn = Connect_to_server2();
        $sql = 'select is_lock from users where id_user = ' . $_GET["id"];
        $wynik = $conn->query($sql);

        if ($conn->error) {
            printf("Errormessage: %s\n", $conn->error);
            $conn->close();
        } else {
            while ($row = $wynik->fetch_assoc()) {
                if ($row["is_lock"] == 0) {
                    $sql = 'update users set is_lock = 1 where id_user = ' . $_GET["id"];
                    $wynik2 = $conn->query($sql);
                    echo 'Zablokowano !';
                } else {
                    $sql = 'update users set is_lock = default where id_user = ' . $_GET["id"];
                    $wynik2 = $conn->query($sql);
                    echo 'Odblokowano !';
                }
            }

            $conn->close();
        }
    }
}
?>
        <div class="col-md-12">
            <!-- Form Name -->

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
                <!-- Text input-->
                    <?php
                    Show_users_table();
                    ?>
            </div>
        </div>

