<?php
/**
 * Created by PhpStorm.
 * User: seba
 * Date: 11.05.16
 * Time: 20:33
 */

session_start();

include 'szablony/my_admin_function.php';

//echo '<h1>Witaj '.$_SERVER['SERVER_NAME'].' | '.$_SERVER['HTTP_HOST'].' | '.$_SERVER['REQUEST_URI'].'|'.$_SERVER['SERVER_NAME'].'</h1>';

//logowanie
if (!isset($_SESSION['uzytkownik'])) {
    $_SESSION['uzytkownik'] = 'anonimowy';
}else if (isset($_SESSION["uprawnienia"]) && $_SESSION["uprawnienia"] === "1") {
    header("Location: index.php?error=brak-uprawnien");
   // echo "<h1>".$_SESSION['uprawnienia']."</h1>";
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //logowanie
    if (isset($_POST["login"]) && 'true' && isset($_POST["exampleInputEmail1"]) != '' && isset($_POST["exampleInputPassword1"]) != '') {

        if ($_POST["login"] && $_POST["exampleInputEmail1"] && $_POST["exampleInputPassword1"]) {
            $sql = 'select id_user,nick,email,password,permissions from users where email = "' . $_POST["exampleInputEmail1"] . '" and password = "' . $_POST["exampleInputPassword1"] . '" and permissions > 1';
            $conn = Connect_to_server();
            $wynik = $conn->query($sql);

            if ($wynik->num_rows == 1) {
                while ($row = $wynik->fetch_assoc()) {
                    $_SESSION['uzytkownik'] = $row["nick"];
                    $_SESSION["id_uzytkownik"] = $row["id_user"];
                }
            } else {
                header("Location: index.php?error=1");
            }
        }


    } else {
        header("Location: index.php?error=2");
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    //wylogowanie
    if (isset($_GET["logout"])) {
        if ($_GET["logout"] === "true") {
            $_SESSION = array();
            session_destroy();
            header("Location: index.php?status=wylogowany");
        }
    }
}

if ($_SESSION['uzytkownik'] === 'anonimowy' || $_SESSION['uprawnienia'] === "1" ) {
    header("Location: index.php?error=3");
}