<?php
/**
 * Created by PhpStorm.
 * User: seba
 * Date: 20.04.16
 * Time: 14:08
 */


function Connect_to_server()
{

    $servername = "";
    $username = "";
    $password = "";
    $dbname = "";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    //wymuszam kodaowanie
    $conn->query('SET NAMES utf8');
    $conn->query('SET CHARACTER_SET utf8_unicode_ci');

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } else {
        return $conn;
    }
}

function Connect_to_server2()
{

    $servername = "";
    $username = "";
    $password = "";
    $dbname = "";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    //wymuszam kodaowanie
    $conn->query('SET NAMES utf8');
    $conn->query('SET CHARACTER_SET utf8_unicode_ci');

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } else {
        return $conn;
    }
}

function Load_tools($co = 'main')
{
    switch ($co) {
        case 'strona' : {
            include "_page_tools.php";
            break;
        }
        case 'dodaj_strone' : {
            include "_page_editor.php";
            break;
        }
        case 'wiadomosci' : {
            include "_page_msg.php";
            break;
        }
        case 'uzytkownicy_edit' : {
            include "_users_list.php";
            break;
        }
        case 'ustawienia' : {
            echo 'Ładuje moduł do edycji ustawień';
            break;
        }
        case 'kategorie' : {
            include "_category_tools.php";
            break;
        }
        case 'dodaj_kategorie' : {
            include "_category_add_edit.php";
            break;
        }

        case 'main' : {
            include "_main_admin_view.php";
            break;
        }
        case 'dodaj_uzytkownik' : {
            include "_users_add_edit.php";
            break;
        }

        default :
            echo 'Brak modułu do wyswietlenia !';
    }
}

function Msg_unread()
{

    $conn = Connect_to_server();
    $sql = "SELECT count(id_msg) as 'msg_unread' FROM wiadomosci where is_read = 1";
    $wynik = $conn->query($sql);
    $conn->close();

    if ($wynik->num_rows > 0) {


        while ($row = $wynik->fetch_assoc()) {

            if ($row["msg_unread"] > 0) {

                echo '<span class="badge">' . $row["msg_unread"] . '</span>';
            }

        }

    }

}

function Show_msg_table()
{

    $conn = Connect_to_server();
    $sql = "SELECT * FROM wiadomosci";

    $wynik = $conn->query($sql);
    $conn->close();

    if ($wynik->num_rows > 0) {
        echo '<p>Tabela zarządzania otrzymanymi wiadomościami z twojego bloga.</p>';
        echo '<table class="table"><thead><tr>';

        $col_num = $wynik->field_count;

        for ($i = 0; $i < $col_num; $i++) {

            $finfo = mysqli_fetch_field_direct($wynik, $i);

            echo '<th>' . $finfo->name . '</th>';
        }

        echo '<th>Check</th></tr></thead><tbody>';

        for ($i = 0; $i < $wynik->num_rows; $i++) {
            echo '<tr>';
            while ($row = $wynik->fetch_assoc()) {

                echo '<td>' . $row["id_msg"] . '</td>' . '<td>' . $row["tytul"] . '</td>' . '<td>' . $row["tresc"] . '</td>' . '<td>' . $row["email"] . '</td>' . '<td>' . $row["id_user"] . '</td>';
                if ($row["is_read"] == "1") {
                    echo '<td>!</td>';
                } else {
                    echo '<td>read</td>';
                }
                echo '<td><input type="checkbox" name="is_mark" title="Zaznacz żeby usunąć"></td>';
                break;

            }
            echo '</tr>';

        }
        echo '</tbody></table>';
    }
}

function Module_to_Pages_short_stat($sql)
{
    $conn = Connect_to_server();
    $wynik = $conn->query($sql);

    if ($conn->error) {
        printf("Errormessage: %s\n", $conn->error);
    } else {

        while ($row = $wynik->fetch_array()) {
            return $row[0];
        }
    }

    $conn->close();

}

function Pages_short_stat($co)
{

    switch ($co) {
        case 'active_page' : {
            echo '<span>Stron aktywnych ' . $info = Module_to_Pages_short_stat("select count(*) from wpisy where on_off = 1") . '</span>';
            break;
        }
        case 'disable_page' : {
            echo '<span>Stron nie aktywnych ' . $info = Module_to_Pages_short_stat("select count(*) from wpisy where on_off = 0") . '</span>';
            break;
        }
        case 'all_comments' : {
            echo '<span>Komentarzy ' . $info = Module_to_Pages_short_stat("select count(*) from komentarze") . '</span>';
            break;
        }

        case 'active_cat' : {
            echo '<span>Kategorie aktywne ' . $info = Module_to_Pages_short_stat("select count(*) from kategorie where on_off = 1") . '</span>';
            break;
        }

        case 'disable_cat' : {
            echo '<span>Kategorie nie aktywne ' . $info = Module_to_Pages_short_stat("select count(*) from kategorie where on_off = 0") . '</span>';
            break;
        }

        case 'all_comments_in_kat' : {
            echo '<span>Wszystkich komentarzy ' . $info = Module_to_Pages_short_stat("select count(*) from komentarze ") . '</span>';
            break;
        }

        default :
            echo 'Brak statystyk do wyswietlenia !';
    }
}


function Show_users_table()
{

    $conn = Connect_to_server();
    $sql = "SELECT id_user as 'ID',name as 'Imię',surname as 'Nazwisko',url_avatar as 'Avatar',email as 'Email',nick as  'Nick',is_lock FROM users";

    $wynik = $conn->query($sql);
    $conn->close();



    if ($wynik->num_rows > 0) {
        echo '<p>Tabela zarządzania uzytkownikami bloga.</p>';
        echo '<div class="data-div">';
        echo '<table class="table"><thead><tr>';

        $col_num = $wynik->field_count;

        for ($i = 0; $i < $col_num; $i++) {

            $finfo = mysqli_fetch_field_direct($wynik, $i);

            echo '<th>' . $finfo->name . '</th>';
        }

        echo '<th>Check</th><th>Del</th><th>Edit</th></tr></thead><tbody>';

        for ($i = 0; $i < $wynik->num_rows; $i++) {
            echo '<tr>';
            while ($row = $wynik->fetch_assoc()) {

                $lock_status = '';

                if ($row["is_lock"] == 0) {
                    $lock_status = '<a href="editor_panel.php?module=uzytkownicy_edit&lock=true&id=' . $row["ID"] . '"><i class="fa fa-unlock" aria-hidden="true"></i></a>';
                } else {
                    $lock_status = '<a href="editor_panel.php?module=uzytkownicy_edit&lock=true&id=' . $row["ID"] . '"><i class="fa fa-lock" aria-hidden="true"></i></a>';
                }

                echo '<td>' . $row["ID"] . '</td>' . '<td>' . $row["Imię"] . '</td>' . '<td>' . $row["Nazwisko"] . '</td>' . '<td>' . $row["Avatar"] . '</td>' . '<td>' . $row["Email"] . '</td>' . '<td>' . $row["Nick"] . '</td><td>' . $lock_status . '</td>';
                echo '<td><input type="checkbox" name="is_mark" title="Zaznacz żeby usunąć"></td><td><a href="editor_panel.php?module=uzytkownicy_edit&del=true&id=' . $row["ID"] . '"><i class="fa fa-trash" aria-hidden="true"></i></a></td><td><a href="editor_panel.php?module=dodaj_uzytkownik&edit=true&id=' . $row["ID"] . '"><i class="fa fa-pencil" aria-hidden="true"></i><a/></td>';
                break;

            }
            echo '</tr>';

        }
        echo '</tbody></table></div>';
    }
}

function Show_posts_table()
{

    $sql = "select wpisy.id_wpis as 'ID' , substring(wpisy.title,1,60) as 'Tytuł', wpisy.data_wpis as 'Data wpisu', users.nick 'Autor', kategorie.title as 'Kategoria', count(komentarze.id_koment)  as 'komentowany', wpisy.on_off as 'status' from wpisy left join users on wpisy.autor_wpis_id = users.id_user left join kategorie on wpisy.kat_id =  kategorie.id_kategori left join komentarze on wpisy.id_wpis = komentarze.id_wpis group by wpisy.id_wpis";
    $conn = Connect_to_server();

    $wynik = $conn->query($sql);

    if ($conn->error) {
        printf("Errormessage: %s\n", $conn->error);
    } else if ($wynik->num_rows > 0) {
        echo '<p>Tabela wpisów w twoim blogu</p>';
        echo '<div class="data-div">';

        echo '<table class="table"><thead><tr>';

        $col_num = $wynik->field_count;

        for ($i = 0; $i < $col_num; $i++) {

            $finfo = mysqli_fetch_field_direct($wynik, $i);

            echo '<th>' . $finfo->name . '</th>';
        }
        echo '<th>Check</th><th>Del</th><th>Edit</th></tr></thead><tbody>';

        while ($row = $wynik->fetch_assoc()) {
            if ($row["status"] == 1) {
                $status = '<i class="fa fa-toggle-on" aria-hidden="true"></i>';
            } else {
                $status = '<i class="fa fa-toggle-off" aria-hidden="true"></i>';
            }

            echo '<tr><td>' . $row["ID"] . '</td><td>' . $row["Tytuł"] . '</td><td>' . $row["Data wpisu"] . '</td><td>' . $row["Autor"] . '</td><td>' . $row["Kategoria"] . '</td><td>' . $row["komentowany"] . '</td><td><a href="editor_panel.php?module=strona&change_status=true&id=' . $row["ID"] . '">' . $status . '</a></td>';
            echo '<td><input type="checkbox" name="is_mark" title="Zaznacz żeby usunąć"></td><td><a href="editor_panel.php?module=strona&del=true&id=' . $row["ID"] . '"><i class="fa fa-trash" aria-hidden="true"></i></a></td><td><a href="editor_panel.php?module=dodaj_strone&edit=true&id=' . $row["ID"] . '"><i class="fa fa-pencil" aria-hidden="true"></i></a></td></tr>';
        }

        echo '</tbody></table></div>';
    }

    $conn->close();
}


function Show_kat_table()
{

    $sql = "SELECT 
    kategorie.id_kategori AS 'ID',
    kategorie.title AS 'Tytuł',
    kategorie.on_off AS 'status',
    kategorie.parent AS 'Rodzic',
    COUNT(wpisy.id_wpis) AS 'Liczba wpisów'
FROM
    kategorie
        left JOIN
    wpisy ON kategorie.id_kategori = wpisy.kat_id
GROUP BY kategorie.id_kategori; ";

    $conn = Connect_to_server();

    $wynik = $conn->query($sql);

    if ($conn->error) {
        printf("Errormessage: %s\n", $conn->error);
    } else if ($wynik->num_rows > 0) {
        echo '<p>Tabela wpisów w twoim blogu</p>';
        echo '<div class="data-div">';

        echo '<table class="table"><thead><tr>';

        $col_num = $wynik->field_count;


        for ($i = 0; $i < $col_num; $i++) {

            $finfo = mysqli_fetch_field_direct($wynik, $i);

            echo '<th>' . $finfo->name . '</th>';
        }
        echo '<th>Check</th><th>Del</th><th>Edit</th></tr></thead><tbody>';

        while ($row = $wynik->fetch_assoc()) {
            if ($row["status"] == 1) {
                $status = '<i class="fa fa-toggle-on" aria-hidden="true"></i>';
            } else {
                $status = '<i class="fa fa-toggle-off" aria-hidden="true"></i>';
            }

            echo '<tr><td>' . $row["ID"] . '</td><td>' . $row["Tytuł"] . '</td><td><a href="editor_panel.php?module=kategorie&change_status=true&id=' . $row["ID"] . '">' . $status . '</a></td><td>' . $row["Rodzic"] . '</td><td>' . $row["Liczba wpisów"] . '</td>';
            echo '<td><input type="checkbox" name="is_mark" title="Zaznacz żeby usunąć"></td><td><a href="editor_panel.php?module=kategorie&del=true&id=' . $row["ID"] . '"><i class="fa fa-trash" aria-hidden="true"></i></a></td><td><a href="editor_panel.php?module=dodaj_kategorie&edit=true&id=' . $row["ID"] . '"><i class="fa fa-pencil" aria-hidden="true"></i></a></td></tr>';
        }

        echo '</tbody></table></div>';
    }

    $conn->close();
}

function Generate_salt_string(){

    $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

    $gen_string = '';
    for ($i = 0; $i < 4; $i++){
        $gen_string .= $chars[rand(0, strlen($chars))];

    }

    return $gen_string;
}
