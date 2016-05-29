<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_POST["user_nick"] != "") {
        $flag = false;
        $_dane_z_form = array();

        $_dane_z_form["nick"] = $_POST["user_nick"];
        $_dane_z_form["pass"] = $_POST["user_pass"];
        $_dane_z_form["name"] = $_POST["user_name"];
        $_dane_z_form["surname"] = $_POST["user_surname"];
        $_dane_z_form["email"] = $_POST["user_email"];
        $_dane_z_form["avatar"] = $_POST["user_avatar"];
        $_dane_z_form["reg"] = $_POST["regulamin"];

        //sprawdzanie danych
        //var_dump($_dane_z_form);
        if (strlen($_dane_z_form["nick"]) > 0 && strlen($_dane_z_form["email"]) > 0 && $_dane_z_form["reg"] == "1"
            && strlen($_dane_z_form["pass"]) > 0 && strlen($_dane_z_form["name"]) > 0 && strlen($_dane_z_form["surname"]) > 0
        ) {
            echo 'Wymagane dane są wprowadzone !';
            $flag = true;

        } else {
            echo 'Brak wszystkich wymaganych danych';

        }

        if ($flag == true) {
            $conn = Connect_to_server2();
            $sql = 'select count(*) as "istnieje" from users where nick = "' . $_dane_z_form["nick"] . '" or email = "' . $_dane_z_form["email"] . '"';

            $wynik = $conn->query($sql);

            while ($row = $wynik->fetch_assoc()) {
                if ($row["istnieje"] == 1) {
                    echo 'Login lub email istnieje w bazie, wprowadź inne dane !';

                } else {

                    $salt = Generate_salt_string();
                    $text_to_hash = $_dane_z_form["pass"].$salt;
                    $text_to_hash = sha1($text_to_hash);

                    $sql = 'insert into users VALUES (DEFAULT ,"' . $_dane_z_form["name"] . '","' . $_dane_z_form["surname"] . '","' . $_dane_z_form["pass"] . '","' . $_dane_z_form["avatar"] . '","' . $_dane_z_form["email"] . '","' . $_dane_z_form["nick"] . '",default,default, "'.$text_to_hash.'","'.$salt.'","Bloger")';
                    $conn->query($sql);

                    if ($conn->error) {
                        printf("Errormessage: %s\n", $conn->error);

                    } else {
                        echo 'Konto zostało porawnie dodane do bazy !';
                    }
                }
            }

            $conn->close();
        }

    }
}

?>
<form action="<?php $_SERVER['REQUEST_URI'] ?>" method="POST" class="form-horizontal registration-form">
    <fieldset>

        <!-- Form Name -->
        <legend>Rejestracja w Blogu Szczupakiem.pl</legend>

        <!-- Text input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="user_nick">Nick</label>
            <div class="col-md-5">
                <input id="user_nick" name="user_nick" type="text" placeholder="Twój nick używany w serwisie"
                       class="form-control input-md" required="">
            </div>
        </div>

        <!-- Password input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="user_pass">Hasło</label>
            <div class="col-md-5">
                <input id="user_pass" name="user_pass" type="password" placeholder="Twoje hasło"
                       class="form-control input-md" required="">

            </div>
        </div>

        <!-- Text input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="user_name">Imię</label>
            <div class="col-md-5">
                <input id="user_name" name="user_name" type="text" placeholder="Twoje imię"
                       class="form-control input-md" required="">

            </div>
        </div>

        <!-- Text input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="user_surname">Nazwisko</label>
            <div class="col-md-5">
                <input id="user_surname" name="user_surname" type="text" placeholder="Twoje nazwisko"
                       class="form-control input-md" required="">
            </div>
        </div>

        <!-- Text input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="user_email">Email</label>
            <div class="col-md-5">
                <input id="user_email" name="user_email" type="email" placeholder="Twój email"
                       class="form-control input-md" required="">
            </div>
        </div>


        <!-- File Button -->
        <div class="form-group">
            <label class="col-md-4 control-label" for="user_avatar">Avatar</label>
            <div class="col-md-4">
                <input id="user_avatar" name="user_avatar" class="input-file" type="file">
            </div>
        </div>

        <!-- Multiple Checkboxes -->
        <div class="form-group">
            <label class="col-md-4 control-label" for="regulamin">Regulamin</label>
            <div class="col-md-4">
                <div class="checkbox">
                    <label for="regulamin-0">
                        <input type="checkbox" name="regulamin" id="regulamin-0" value="1" required="">
                        Akceptuje
                    </label>
                </div>
            </div>
        </div>
        <div class="form-group submit-area">
            <div class="col-md-12">
                <button type="submit" class="btn btn-default">Rejestruj</button>
            </div>
        </div>
    </fieldset>
</form>

