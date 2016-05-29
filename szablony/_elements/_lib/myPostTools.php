<?php

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET["id"]) && $_GET["id"] != "") {
        $id_post = $_GET["id"];
        $tablica = Show_main_post($id_post);
        
        if(!isset($_SESSION["last_post_id"])){
            $_SESSION["last_post_id"] = $_GET["id"];
        }
    }

    if (isset($_GET["send_kom"]) && $_GET["send_kom"] == true) {
        $conn = Connect_to_server2();

        if($_GET["komentarz"] != ""){

            if(isset($_GET["social"]) && $_GET["social"] == $_GET["captcha"] ){

                $sql = 'insert into komentarze values (DEFAULT ,"' . $_GET["komentarz"] . '",CURTIME(),CURDATE(),18, '. $id_post . ', "'.$_GET["nick"].'")';
                //czy można podać jako anonim nick jakieoś użytkownika zalogowanego ? a no można i czy to jest błąd :) sam nie wiem


            }else {

                $sql = 'insert into komentarze values (DEFAULT ,"' . $_GET["komentarz"] . '",CURTIME(),CURDATE(),(select id_user from users where nick = "' . $_SESSION["uzytkownik"] . '"),' . $id_post . ',NULL)';

            }

            if(isset($_GET["social"]) && $_GET["social"] != $_GET["captcha"] ){
                $_SESSION["zla_chaptcha"] = true;
            }
            
            if (isset($sql)){
                $conn->query($sql);

                if ($conn->error) {
                    echo " <div class=\"alert alert-warning my-allerts\">
                                <strong>Uwaga!</strong> Coś poszło nie tak
                            </div>";
                    sprintf($conn->connect_error);
                }
            }



        }

        $conn->close();

    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(isset($_SESSION["last_post_id"])){

        $tablica = Show_main_post($_SESSION["last_post_id"]);
        $id_post = $_SESSION["last_post_id"];


    }
}

?>