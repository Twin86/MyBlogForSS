<?php
/**
 * Created by PhpStorm.
 * User: seba
 * Date: 02.05.16
 * Time: 12:11
 */
session_start();
//wyświetlaj błędy

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


require '_lib/myLib.php';

//logowanie
if (!isset($_SESSION['uzytkownik'])) {
    $_SESSION['uzytkownik'] = 'anonimowy';
    $_SESSION['is_ok'] = true;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST["login-name"]) && $_POST["login-name"] != "") {

        //logowanie
        $conn = Connect_to_server();
        //$sql = 'select count(*) as "istnieje" from users where nick = "' . $_POST["login-name"] . '" and password ="' . $_POST["haslo"] . '" and is_lock != 1';
        $sql = "select nick,hash_pass,salt,permissions from users where nick =\"". $_POST["login-name"]."\" and is_lock != 1";
        $wynik = $conn->query($sql);

        if ($wynik->num_rows > 0) {

            while ($row = $wynik->fetch_assoc()) {

                if(sha1($_POST["haslo"].$row["salt"]) == $row["hash_pass"]) {
                    $_SESSION['uzytkownik'] = $_POST["login-name"];
                    $_SESSION["uprawnienia"] = $row["permissions"];
                    //header('Location:' . $_SERVER['REQUEST_URI']);

                } else {
                    $_SESSION['is_ok'] = false;
                    header('Location:' . $_SERVER['REQUEST_URI']);
                }

            }
        }

        mysqli_free_result($wynik);
        $conn->close();

    //wylogowanie
    } else if (isset($_POST["wyloguj"]) && $_POST["wyloguj"] == "logout") {
        $_SESSION = array();
        session_destroy();
        //header('Location:' . $_SERVER['REQUEST_URI']);
        header('Location:index.php');
    }
}


//echo '<p  class = "user-info" style="text-align: center;color: white">Jesteś zalogowany jako user : ' . $_SESSION['uzytkownik'] . '</p>';