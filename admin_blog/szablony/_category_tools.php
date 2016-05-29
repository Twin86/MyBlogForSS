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
            $sql = 'select on_off from kategorie where id_kategori = ' . $_GET["id"];
            $conn = Connect_to_server2();
            $wynik = $conn->query($sql);

            if ($conn->error) {
                printf("Errormessage: %s\n", $conn->error);
            } else {
                if ($wynik->num_rows > 0) {
                    while ($row = $wynik->fetch_assoc()) {
                        if ($row["on_off"] == 1) {
                            $conn->query('update kategorie set on_off = 0 where id_kategori = ' . $_GET["id"]);
                            if ($conn->error) {
                                printf("Errormessage: %s\n", $conn->error);
                            }
                        } else {
                            $conn->query('update kategorie set on_off = 1 where id_kategori = ' . $_GET["id"]);
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
            //przenosze wpisy z kategoriu usuwanej do innej np sieroty
            $sql3 = 'select kategorie.id_kategori as "id_to_move" from kategorie where parent = '.$_GET["id"];
            $sql2 = 'update wpisy set kat_id = (select kategorie.id_kategori from kategorie where title = "Sieroty") where kat_id = '.$_GET["id"];
            $sql = 'delete from kategorie where id_kategori = ' . $_GET["id"];

            $ok = true;

            $conn = Connect_to_server2();

            $wynik = $conn->query($sql3);

            if ($conn->error) {
                sprintf("Errormessage: %s\n", $conn->error);
                $conn->close();
            }else if ($wynik -> num_rows > 0){
                $sql_move = "";
                while($row = $wynik ->fetch_assoc()) {
                    $sql_move = $sql_move.'update kategorie set parent = 0 where id_kategori = '.$row["id_to_move"].';';
                }
                $conn ->query($sql_move);
                if ($conn->error) {
                    sprintf("Errormessage: %s\n", $conn->error);
                    echo $sql_move;
                    $conn->close();
                    $ok = false;
                }
            }

            if($ok){
                $wynik = $conn->query($sql2);

                if ($conn->error) {
                    sprintf("Errormessage: %s\n", $conn->error);
                    $conn->close();
                } else {
                    echo 'Wpisy przesuniete,  ';
                    $wynik = $conn->query($sql);
                    if ($conn->error) {
                        sprintf("Errormessage: %s\n", $conn->error);
                        $conn->close();
                    }else {
                        echo 'Kategoria usunieta ! ';
                        $conn->close();
                    }
                }
            }else echo 'cos poszlo nie tak !';

        }
    }

}


?>

<div class="col-md-12">
    <div class="row">
        <div class="col-md-offset-1 col-md-3 ">
            <div class="info-page ">
                <?php Pages_short_stat('active_cat') ?>
            </div>
        </div>
        <div class="col-md-3 ">
            <div class="info-page">
                <?php Pages_short_stat('disable_cat') ?>
            </div>
        </div>
        <div class="col-md-3 ">
            <div class="info-page">
                <?php Pages_short_stat('all_comments_in_kat') ?>
            </div>
        </div>
    </div>
    <div class="row">
        <?php Show_kat_table() ?>
    </div>
</div>
