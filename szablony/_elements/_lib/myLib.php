<?php
include 'szablony/_elements/_ustawienia.php';

function Connect_to_server()
{

    $servername = "localhost";
    $username = "";
    $password = "";
    $dbname = "";

    //ile postów maksymalnie ma być wyświetlonych
    $post_max = 3;

    // Create connection
    $conn = new mysqli(  $servername,  $username,  $password,  $dbname);

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

    $servername = "localhost";
    $username = "";
    $password = "";
    $dbname = "";

    // Create connection
    $conn = new mysqli( $servername,  $username ,  $password,  $dbname);

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

//moduł wyświetlający najnowsze i aktywne wpisyna stronie

//skracanie wpisu o okreslona ilosc znakow
function CutString($tekst, $url, $limit_chars)
{

    if (strlen($tekst) > $limit_chars) {
        $editTekst = substr($tekst, 0, $limit_chars);
        $editTekst = '<p>' . $editTekst . '</p> <span><a href = "' . $url . '" > Więcej </a> </span>';
    } else {
        $editTekst = $tekst;
    }

    return $editTekst;
}


function Latest_posts_lists($post_limit)
{

    $conn = Connect_to_server();

    $sql = 'select title,url_wpis from wpisy where on_off = 1 order by data_wpis DESC, czas_wpis DESC limit ' . $post_limit . '';
    $wynik = $conn->query($sql);

    if ($wynik->num_rows > 0) {
        // output data of each row new post
        $lista = '<ul>';
        while ($row = $wynik->fetch_assoc()) {
            $lista = $lista . '<li><a href="' . $row["url_wpis"] . '">' . $row["title"] . '</a></li>';

        }
        echo $lista = $lista . '</ul>';

    } else {

        echo "Brak postów !";
    }


    $conn->close();
}


function Most_cooment_post($limit = 5){
    $conn = Connect_to_server();
    $sql = "select wpisy.title as wpis,wpisy.url_wpis as link  ,count(*) as ilosc_komentarzy from komentarze left join wpisy on komentarze.id_wpis = wpisy.id_wpis group by wpisy.id_wpis order by ilosc_komentarzy DESC limit ".$limit;
    $wynik = $conn -> query($sql);


    if ($wynik->num_rows > 0) {
        // output data of each row new post
        echo "<h3>O tym rozmawiamy</h3>";
        $lista = '<ul>';
        while ($row = $wynik->fetch_assoc()) {
            $lista = $lista . '<li><a href="' . $row["link"] . '">' . $row["wpis"] . '<span class="badge show-class">' . $row["ilosc_komentarzy"] . '</span></a></li>';

        }
        echo $lista = $lista . '</ul>';

    } else {

        echo "Brak postów !";
    }


    $conn->close();
}

function Category_lists($cat_limit = 5)
{

    $conn = Connect_to_server();

    if ($cat_limit == NULL) {

        $sql = 'SELECT title,opis,id_kategori FROM kategorie where on_off = 1 and parent = 0 order by  title';
    } else {
        $sql = 'SELECT title,opis,id_kategori FROM kategorie where on_off = 1 and parent = 0  order by  title limit ' . $cat_limit . '';
    }

    $wynik = $conn->query($sql);

    if ($wynik->num_rows > 0) {
        // output data of each row new post
        $lista = '<ul>';
        while ($row = $wynik->fetch_assoc()) {
            //$lista = $lista.'<li><a href="'.$row["url_wpis"].'">'.$row["title"].'</a></li>';
            $lista = $lista . '<li><a href="posts.php?id=' . $row["id_kategori"] . '" title = "' . $row["opis"] . '">' . $row["title"] . '</a></li>';

        }
        echo $lista = $lista . '</ul>';

    } else {

        echo "Brak kategorii !";
    }


    $conn->close();

}

function Sponsor_img_load()
{

    $dir = "img/loga_ligi";
    $files = scandir($dir);

    echo '<div>';
    for ($i = 2; $i < sizeof($files); $i++) {

        echo '<img src="' . $dir . '/' . $files[$i] . '">';
    }
    echo '</div>';
}

function Show_main_post($post_id)
{

    $conn = Connect_to_server();
    $sql = "select data_wpis, czas_wpis,title, wpis, url_wpis, img_url, users.nick as autor from wpisy join users on wpisy.autor_wpis_id = users.id_user where id_wpis = " . $post_id . " and on_off = 1";
    
    $wynik = $conn->query($sql);


    $tablica = [];
    if ($wynik->num_rows > 0) {
        // output data of each row
        while ($row = $wynik->fetch_assoc()) {

            $tablica[] = $row;

        }
        return $tablica;

    } else {

        echo "Brak postów !";
        return 0;
    }


    $conn->close();

}

function Show_comments($id_post)
{

    $conn = Connect_to_server();
    $sql = "select users.nick, data_kom, czas_kom, komentarz, wpisy.id_wpis, no_login_nick from komentarze 
          left join wpisy on komentarze.id_wpis = wpisy.id_wpis left join users on komentarze.id_user = users.id_user 
          where komentarze.id_wpis = " . $id_post;
    $wynik = $conn->query($sql);

    if ($wynik->num_rows > 0) {

        while ($row = $wynik->fetch_assoc()) {
            $anonimowy = "";
            if ($row["nick"] == "anonim"){
                $anonimowy = ' <small> jako </small> '.$row["no_login_nick"];
            }

            $komentarz = '<h4>' . $row["nick"].$anonimowy. ' <data>' . $row["data_kom"] . '</data><czas>' . $row["czas_kom"] . '</czas></czas></data></h4>';
            $komentarz = $komentarz . '<div class="kom">' . $row["komentarz"] . '</div>';
            echo "<div>".$komentarz."</div>";

        }

    } else {
        echo "Temat jeszcze nie komentowany, bądź pierwszy .";
    }
    
    $conn->close();

}

function Add_comments($id_post, $id_kom)
{
    //1/sprawdz czy jest zalogowany


}

function Show_latest_post_short_ver($limit)
{
    $conn = Connect_to_server();
    if ($_GET == null) {
        $sql = "select data_wpis, czas_wpis,title, wpis, url_wpis, img_url,id_wpis from wpisy where on_off = 1 order by data_wpis DESC, czas_wpis DESC limit " . $limit;
        $wynik = $conn->query($sql);

        if ($wynik->num_rows > 0) {

            while ($row = $wynik->fetch_assoc()) {

                $wpis = '<div class="col-md-12 wpis">';
                $wpis = $wpis . '<img-zone><img src="' . $row["img_url"] . '"></img-zone><h2>' . $row["title"] . '</h2><h3>' . $row["data_wpis"] . '</h3>' . CutString($row["wpis"], $row["url_wpis"], 400) . '</div>';
                echo $wpis;

            }

        } else {

            echo "Brak wpisów w tej kategorii";
        }

        $conn->close();
    }
}

function All_post_from_kat_id($id)
{

    $conn = Connect_to_server();
    //$sql = "SELECT * FROM wpisy where kat_id = ".$id." and on_off = 1 order by (data_wpis) DESC";
    //$sql = "SELECT * FROM wpisy join kategorie on wpisy.kat_id = kategorie.id_kategori where (kat_id = ".$id." and wpisy.on_off = 1) or ( kategorie.parent = ".$id." and wpisy.on_off = 1)  order by (data_wpis) DESC";
    $sql = "SELECT wpisy.title as tytul_wpisu, wpisy.wpis, url_wpis,data_wpis,czas_wpis,img_url FROM wpisy join kategorie on wpisy.kat_id = kategorie.id_kategori where (kat_id = " . $id . " and wpisy.on_off = 1) or ( kategorie.parent = " . $id . " and wpisy.on_off = 1) and kategorie.on_off = 1 order by (data_wpis) DESC";

    $wynik = $conn->query($sql);

    if ($conn->error) {
        printf("Errormessage: %s\n", $conn->error);
    }

    if ($wynik->num_rows > 0) {

        while ($row = $wynik->fetch_assoc()) {

            $wpis = '<div class="col-md-12 wpis">';
            $wpis = $wpis . '<img-zone><img src="' . $row["img_url"] . '"></img-zone><h2>' . $row["tytul_wpisu"] . '</h2><h3>' . $row["data_wpis"] . '</h3>' . CutString($row["wpis"], $row["url_wpis"], 300) . '</div>';
            echo $wpis;

        }

    } else {
        echo "Brak wpisów w tej kategorii";
    }

    $conn->close();
}

function Get_mesg_from_contact($email, $nick, $msg)
{

    $conn = Connect_to_server2();
    $sql = "insert into wiadomosci VALUES (DEFAULT,'Wiadomość z bloga','" . $msg . "','" . $email . "', NULL, 1)";
    $conn->query($sql);


    if ($conn->error) {
        printf("Errormessage: %s\n", $conn->error);
    }

    $conn->close();

}

function Send_mail($nick, $email, $msg)
{
    /* budowanie nagłówka dla wiadomoci */
    $naglowek = "Content-type: text/html; charset=utf-8";
    $mesg = 'Nowa wiadomość od ' . $nick . "\r\n" . ' Jego adres to :' . $email . "\r\n" . ' Treść wiadomości : ' . "\r\n" . $msg;
    /* wysłanie wiadomości */
    mail('twin86@gmail.com', "=?UTF-8?B?" . base64_encode('Nowa wiadomość z bloga') . "?=", $mesg, $naglowek);
    /*zapis wiadomości do bazy*/
    Get_mesg_from_contact($email, $nick, $msg);
}


function Main_menu()
{

    $conn = Connect_to_server();
    $sql = "select * from kategorie where on_off = 1 and parent = 0";
    $wynik = $conn->query($sql);

    /*
     * select * from kategorie where on_off = 1 and parent = 0;
     * select * from kategorie where on_off = 1 and parent = dodawana kategoria;
     */

    if ($wynik->num_rows > 0) {
        $head = '<ul class="nav nav-tabs"><li class="active"><a href="index.php">Top</a></li>';
        $wpis = "";

        while ($row = $wynik->fetch_assoc()) {

            if (strpos($_SERVER['REQUEST_URI'], "posts.php?id=" . $row["id_kategori"]) !== false) {
                $active = 'class = "active"';

            } else $active = '';

            $wpis = $wpis . '<li ' . $active . ' ><a href="' . "posts.php?id=" . $row["id_kategori"] . '" title="' . $row["opis"] . '">' . $row["title"] . '</a>';

            $sql2 = 'select * from kategorie where parent = ' . $row["id_kategori"] . ' and on_off = 1 ';
            $wynik2 = $conn->query($sql2);
            if ($wynik2->num_rows > 0) {
                $next_lv = '<ul>';
                while ($lv = $wynik2->fetch_assoc()) {
                    $next_lv = $next_lv . '<li><a href="' . "posts.php?id=" . $lv["id_kategori"] . '" title="' . $lv["opis"] . '">' . $lv["title"] . '</a></li>';
                }
                $next_lv = $next_lv . '</ul>';
                $wpis = $wpis . $next_lv . '</li>';
                mysqli_free_result($wynik2);
            } else {
                $wpis = $wpis . '</li>';
            }

        }
        $wpis = $wpis . '</ul>';
        echo $head . $wpis;
    } else {
        echo 'brak kategorii';
    }

    $conn->close();

}

function Top_menu()
{

}

function Calender_game(){

}


function Szukaj_podobnych($fraza){
    $sql = "SELECT 
    id_wpis AS 'id_wyszukanego',
    url_wpis AS 'link',
    title AS 'tytul_wyszukanego',
    SUBSTRING(wpis, 1, 45) AS 'skrocona_tresc'
FROM
    (SELECT 
        id_wpis,
            title,
            wpis,
            url_wpis,
            LOWER(CONCAT_WS(title, wpis)) AS przeszukaj
    FROM
        wpisy) AS wynik
WHERE
    przeszukaj LIKE LOWER('%".$fraza."%'); ";

    $conn = Connect_to_server();
    $wynik = $conn -> query($sql);

    if($conn ->error) {
        echo sprintf("Errormessage: %s\n", $conn->error);
    }else{


        if($wynik -> num_rows > 0){
            echo "<div class=\"col-md-12\">";
            echo "<h2>Fraza szukana :".$fraza." , pasujących wyników <i class=\"fa fa-check-circle-o\" aria-hidden=\"true\"></i>".$wynik -> num_rows."</h2>";
            while ($row = $wynik -> fetch_assoc()){
                echo "<a href = ".$row["link"]."><h3>".$row["tytul_wyszukanego"]."</h3><p>".$row["skrocona_tresc"]."</p></a>";
            }
            $conn -> close();
            echo "</div>";
        }else echo 'brak wyników !';
    }
}

function Generate_salt_string(){

    $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

    $gen_string = '';
    for ($i = 0; $i < 4; $i++){
        $gen_string .= $chars[rand(0, strlen($chars))];

    }

    return $gen_string;
}
