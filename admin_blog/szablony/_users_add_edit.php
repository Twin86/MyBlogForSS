<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_POST["user_nick"] != "" ) {

        $flag = false;
        $_dane_z_form = array();

        $_dane_z_form["nick"] = $_POST["user_nick"];
        $_dane_z_form["pass"] = $_POST["user_pass"];
        $_dane_z_form["name"] = $_POST["user_name"];
        $_dane_z_form["surname"] = $_POST["user_surname"];
        $_dane_z_form["email"] = $_POST["user_email"];
        $_dane_z_form["avatar"] = $_POST["user_avatar"];
        $_dane_z_form["is_on"] = $_POST["off_on_box"];
        $_dane_z_form["id"] = $_POST["id_fild"];
        $_dane_z_form["permission"] = $_POST["select_permissions"];

        var_dump($_dane_z_form);
        if (!isset($_SESSION["bledy"])) {
            $_SESSION["bledy"] = array();
        }

        //sprawdzanie danych
        //var_dump($_dane_z_form);
        if ($_POST["tryb"] == "nowy" && strlen($_dane_z_form["nick"]) > 0 && strlen($_dane_z_form["email"]) > 0 && strlen($_dane_z_form["pass"]) > 0
            && strlen($_dane_z_form["name"]) > 0 && strlen($_dane_z_form["surname"]) > 0 ) {

            array_push($_SESSION["bledy"], "Wymagane dane są wprowadzone !");
            $flag = true;

        }elseif ($_POST["tryb"] == "edytuje" && strlen($_dane_z_form["nick"]) > 0 && strlen($_dane_z_form["email"]) > 0
            && strlen($_dane_z_form["name"]) > 0 && strlen($_dane_z_form["surname"]) > 0){

            array_push($_SESSION["bledy"], "Wymagane dane do aktualizacji są wprowadzone !");
            $flag = true;

        } else {

            array_push($_SESSION["bledy"], "Brak wszystkich wymaganych danych");
            $flag = false;

        }

            if ($flag == true) {

                switch ($_POST["tryb"]){
                    case "nowy" : {
                        //dodaje usera
                        array_push($_SESSION["bledy"], "Odpalam dodawanie nowego");
                        $conn = Connect_to_server2();
                        $sql = 'select count(*) as "istnieje" from users where nick = "' . $_dane_z_form["nick"] . '" or email = "' . $_dane_z_form["email"] . '"';
                        $wynik = $conn->query($sql);

                        if ($conn->error) {
                            sprintf("1-Errormessage: %s\n", $conn->error);
                            array_push($_SESSION["bledy"], sprintf("1-Errormessage: %s\n", $conn->error));
                            $flag = false;

                        }else {
                            if($wynik -> num_rows == 1){
                                while ($row = $wynik->fetch_assoc()) {

                                    if ($row["istnieje"] > 0) {
                                        echo 'Login lub email istnieje w bazie, wprowadź inne dane !';
                                        array_push($_SESSION["bledy"], "Login lub email istnieje w bazie, wprowadź inne dane !");

                                        $flag = false;

                                    }else {

                                        $salt = Generate_salt_string();
                                        $text_to_hash = $_dane_z_form["pass"] . $salt;
                                        $text_to_hash = sha1($text_to_hash);

                                        $sql = 'insert into users VALUES (DEFAULT ,"' . $_dane_z_form["name"] . '","' . $_dane_z_form["surname"] . '","' . $_dane_z_form["pass"] . '","' . $_dane_z_form["avatar"] . '","' . $_dane_z_form["email"] . '","' . $_dane_z_form["nick"] . '",'.$_dane_z_form["permission"].','.$_dane_z_form["is_on"].', "' . $text_to_hash . '","' . $salt . '",(select u.permissions_name from users as u where u.permissions = '.$_dane_z_form["permission"].' limit 1))';

                                        $conn->query($sql);

                                        if ($conn->error) {
                                            sprintf("2-Errormessage: %s\n", $conn->error);
                                            array_push($_SESSION["bledy"], sprintf("2-Errormessage: %s\n", $conn->error));
                                            //$_SESSION["bledy"] []  = sprintf("Errormessage: %s\n", $conn->error);

                                        }else{
                                            echo 'Konto zostało porawnie dodane do bazy !';
                                            array_push($_SESSION["bledy"], "Konto zostało porawnie dodane do bazy !");
                                            // $_SESSION["bledy"] [] = 'Konto zostało porawnie dodane do bazy !';
                                        }
                                    }
                                }
                            }


                            $conn->close();
                            break;

                        }
                    }

                    case "edytuje" : {
                        //robie update istniejsacego
                        array_push($_SESSION["bledy"], "Odpalam edytowanie starego");
                        $conn = Connect_to_server2();
                        if ($_dane_z_form["pass"] == ""){

                            $sql = 'update  users set 
                                nick = "' . $_dane_z_form["nick"] . '" ,
                                email = "' . $_dane_z_form["email"] . '",
                                name = "'.$_dane_z_form["name"].'",
                                surname = "'.$_dane_z_form["surname"].'",
                                permissions = '.$_dane_z_form["permission"].',
                                is_lock = '.$_dane_z_form["is_on"].' where id_user = '.$_dane_z_form["id"].'';

                            array_push($_SESSION["bledy"], "Bez aktualizacji hasła");

                        }else {

                            $salt = Generate_salt_string();
                            $text_to_hash = $_dane_z_form["pass"] . $salt;
                            $text_to_hash = sha1($text_to_hash);

                            $sql = 'update  users set 
                                nick = "' . $_dane_z_form["nick"] . '" ,
                                email = "' . $_dane_z_form["email"] . '",
                                name = "'.$_dane_z_form["name"].'",
                                surname = "'.$_dane_z_form["surname"].'",
                                permissions = '.$_dane_z_form["permission"].',
                                is_lock = '.$_dane_z_form["is_on"].',
                                password = "'.$_dane_z_form["pass"].'",
                                hash_pass = "'.$text_to_hash.'",
                                salt = "'.$salt.'" where id_user = '.$_dane_z_form["id"].'';

                            array_push($_SESSION["bledy"], "Z aktualizacją hasła");
                        }


                        try {
                            array_push($_SESSION["bledy"], "Odpalam zapytanie");
                            $conn->query($sql);


                        } catch (Exception $e) {
                            echo 'Caught exception: ',  $e->getMessage(), "\n";
                            array_push($_SESSION["bledy"], $e->getMessage(), "\n");
                        }



                        if ($conn->error) {
                            sprintf("Errormessage: %s\n", $conn->error);
                            array_push($_SESSION["bledy"], sprintf("Errormessage: %s\n", $conn->error));

                        }else{
                            echo 'Konto zostało porawnie zaktualizowane !';
                            array_push($_SESSION["bledy"], "Konto zostało porawnie zaktualizowane !");
                        }

                        $conn->close();
                        break;

                    }
                }
            }

        header("Location: editor_panel.php?module=dodaj_uzytkownik");

    }

}
if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    if (isset($_GET["edit"]) && $_GET["edit"] == true) {

        $sql = 'select id_user as id, name as imie, surname as nazwisko, url_avatar as avatar,email, nick, permissions,permissions_name, is_lock as is_on from users where id_user = ' . $_GET["id"];
        $conn = Connect_to_server();
        $wynik = $conn->query($sql);

        if ($conn->error) {
            printf("Errormessage: %s\n", $conn->error);
        } else {
            if ($wynik->num_rows > 0) {

                while ($row = $wynik->fetch_assoc()) {
                    $tablica [] = $row;
                }
            }
        }
    }


    //wyświetlam błędy

    if(isset($_SESSION["bledy"])){
        if(count($_SESSION["bledy"]) > 0){
            foreach ($_SESSION["bledy"] as $blad){
                echo $blad."</br>";}
            $_SESSION["bledy"] = array();
        }
    }

}



?>


<form action="editor_panel.php?module=dodaj_uzytkownik" method="POST" enctype="multipart/form-data" class="form-horizontal">
    <!-- sekcja ustawień dla form -->
    <input type="hidden" id="tryb" name="tryb" value="<?php if (isset($tablica)) echo 'edytuje'; else echo 'nowy'; ?>">
    <!--<input type="hidden" id="module" name="module" value="dodaj_strone"> -->
    <fieldset>
        <div class="row">
            <!-- Form Name -->
            <legend>Edycja użytkownika</legend>
            <div class="col-md-6">
                <div class="col-md-12 label-left">
                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-12 control-label" for="user_nick">Login</label>
                        <input id="user_nick" name="user_nick" type="text" placeholder="podaj nick dla konta użytkownika"
                               class="form-control input-md" required=""
                               value="<?php if (isset($tablica)) echo $tablica[0]["nick"]; ?>">
                    </div>
                    <div class="form-group">
                        <label class="col-md-12 control-label" for="user_name">Imię</label>
                        <input id="user_name" name="user_name" type="text" placeholder="podaj imię"
                               class="form-control input-md" required=""
                               value="<?php if (isset($tablica)) echo $tablica[0]["imie"]; ?>">
                    </div>
                    <div class="form-group">
                        <label class="col-md-12 control-label" for="user_surname">Nazwisko</label>
                        <input id="user_surname" name="user_surname" type="text" placeholder="podaj nazwisko"
                               class="form-control input-md" required="true"
                               value="<?php if (isset($tablica)) echo $tablica[0]["nazwisko"]; ?>">
                    </div>

                    <!-- Password input-->
                    <div class="form-group">
                        <label class="col-md-12 control-label" for="user_pass">Hasło</label>
                        <input id="user_pass" name="user_pass" type="password" placeholder="podaj hasło"
                               class="form-control input-md" <?php if (!isset($tablica)) echo "required=\"true\"";?> value="">
                    </div>
                    <div class="form-group">
                        <label class="col-md-12 control-label" for="user_email">Email</label>
                        <input id="user_email" name="user_email" type="text" placeholder="podaj email"
                               class="form-control input-md" required=""
                               value="<?php if (isset($tablica)) echo $tablica[0]["email"]; ?>">
                    </div>

                    <div class="form-group">
                        <div class="col-sm-5">
                            <label class="col-md-12 control-label" for="tags">Ładuj avatar</label>
                            <label class="file">
                                <input type="file" name="file" id="file" class="btn btn-default" style="width: 100%">
                                <span class="file-custom"></span>
                            </label>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-md-2 ">
                <div class="form-group">

                        <label class="col-md-12 control-label" for="avatar">Avatar</label>
                        <div class="col-md-12 avatar">
                            avatar
                        </div>

                </div>

            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label class="col-md-12 control-label" for="select_parent">Wybierz typ uprawnień</label>
                    <select id="select_permissions" name="select_permissions" class="form-control">
                        <!-- Odczytanie kategorii -->

                        <?php
                        $conn = Connect_to_server();
                        $sql = "select permissions, permissions_name from users group by permissions;";
                        $wynik = $conn->query($sql);
                        $conn->close();

                        if ($wynik->num_rows > 0) {
                            // output data of each row

                            if (isset($tablica)) echo '<option value="' . $tablica[0]["permissions"] . '">' . $tablica[0]["permissions_name"] . '</option>';

                            while ($row = $wynik->fetch_assoc()) {
                                if (isset($tablica)) {
                                    if ($row["permissions"] !== $tablica[0]["permissions"]) {
                                        echo '<option value="' . $row["permissions"] . '">' . $row["permissions_name"] . '</option>';
                                    }
                                } else echo '<option value="' . $row["permissions"] . '">' . $row["permissions_name"] . '</option>';

                            }

                        }

                        ?>

                    </select>
                </div>
                <div class="form-group">
                    <label class="col-md-12 control-label" for="off_on_box">Aktywny</label>
                    <label class="radio-inline" for="off_on_box-0">
                        <input type="radio" name="off_on_box" id="off_on_box-0" value="1" <?php if (isset($tablica)) {
                            if ($tablica[0]["is_on"] == "0") echo 'checked="checked"';
                        } else echo 'checked="checked"'; ?>>
                        tak
                    </label>
                    <label class="radio-inline" for="off_on_box-1">
                        <input type="radio" name="off_on_box" id="off_on_box-1"
                               value="0" <?php if (isset($tablica)) if ($tablica[0]["is_on"] == "1") echo 'checked="checked"'; ?>>
                        nie
                    </label>
                </div>
                <div class="form-group">
                    <label class="col-md-12 control-label" for="id_fild">Id konta</label>
                    <input id="id_fild" name="id_fild" type="text"
                           value="<?php if (isset($tablica)) echo $tablica[0]["id"]; else echo 'default'; ?>"
                           class="form-control input-md"
                           readonly="" required="">
                </div>

                <div class="form-group button-group">
                    <button type="submit" class="btn btn-primary">Zapisz</button>
                    <button type="reset" class="btn btn-warning">Czyść</button>
                </div>

            </div>
        </div>

    </fieldset>
</form>
