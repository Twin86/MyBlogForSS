<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {


    if ($_POST["title_fild"] != "") {
        $conn = Connect_to_server2();
/*
        $target_dir = "../img/uploads/";

        $target_dir_to_db = "img/uploads/";
        $target_file = $target_dir . basename($_FILES["file"]["name"]);

        $target_file_to_db = $target_dir_to_db . basename($_FILES["file"]["name"]);

        $uploadOk = 1;
        $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
        // Check if image file is a actual image or fake image

        if (isset($_POST["submit"])) {
            $check = getimagesize($_FILES["file"]["tmp_name"]);
            if ($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
        }

        // Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }
        // Check file size
        if ($_FILES["file"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif"
        ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
                echo "The file " . basename($_FILES["file"]["name"]) . " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
*/
        if ($_POST["tryb"] == "nowy") {
            $sql = 'insert into kategorie values (default,"' . $_POST["title_fild"] . '","' . $_POST["text_zone"] . '",' . $_POST["off_on_box"] . ','. $_POST["select_parent"] .')';
            $_POST["title_fild"] = mysqli_real_escape_string($conn,$_POST["title_fild"]);
        } else if ($_POST["tryb"] == "edytuje") {
            /*
            if ($target_file_to_db == '') {
                $sql = 'update wpisy set title = "' . $_POST["title_fild"] . '",wpis ="' . $_POST["text_zone"] . '", url_wpis = "' . $_POST["select_theme"] . '?id=' . $_POST["id_fild"] . '",data_wpis = CURDATE(),czas_wpis = CURTIME(),autor_wpis_id = ' . $_SESSION["id_uzytkownik"] . ',kat_id = ' . $_POST["select_category"] . ',on_off =' . $_POST["off_on_box"] . ' where id_wpis = ' . $_POST["id_fild"];
            } else {
                $sql = 'update wpisy set title = "' . $_POST["title_fild"] . '",wpis ="' . $_POST["text_zone"] . '", url_wpis = "' . $_POST["select_theme"] . '?id=' . $_POST["id_fild"] . '",data_wpis = CURDATE(),czas_wpis = CURTIME(),autor_wpis_id = ' . $_SESSION["id_uzytkownik"] . ',kat_id = ' . $_POST["select_category"] . ',on_off =' . $_POST["off_on_box"] . ', img_url =" ' . $target_file_to_db . '" where id_wpis = ' . $_POST["id_fild"];
            }
            */
            $sql = 'update kategorie set title ="'.$_POST["title_fild"].'" , opis = "'. $_POST["text_zone"] .'" , on_off = '. $_POST["off_on_box"].', parent = '.$_POST["select_parent"].' where id_kategori = '.$_POST["id_fild"];

        }
        $wynik = $conn->query($sql);

        $_SESSION["alerts"] = array();

        if ($conn->error) {
            echo '<div class="alert alert-danger" role="alert">' . printf("Errormessage: %s\n", $conn->error) . '</div>';
            $_SESSION["alerts"] = '<div class="alert alert-danger" role="alert">' . sprintf("Errormessage: %s\n", $conn->error) . '</div>';
           // $_SESSION["alerts"] =  sprintf("Errormessage: %s\n", $conn->error);
        } else {
            echo '<div class="alert alert-success" role="alert">OK</div>';
            $_SESSION["alerts"] = '<div class="alert alert-success" role="alert">OK</div>';
        }

        header("Location: editor_panel.php?module=dodaj_kategorie");

        $conn->close();

    }

}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET["edit"]) && $_GET["edit"] == true) {

        $sql = 'select kategorie.id_kategori as "id", kategorie.title as "tytul" ,kategorie.opis as "tresc",kategorie.on_off as "is_on" , kategorie.parent from kategorie where kategorie.id_kategori = ' . $_GET["id"];
        $conn = Connect_to_server();
        $wynik = $conn->query($sql);

        if ($conn->error) {
            printf("Errormessage: %s\n", $conn->error);
        } else {
            if ($wynik->num_rows > 0) {

                while ($row = $wynik->fetch_assoc()) {
                    $tablica [] = $row;
                }
                //var_dump($tablica);
            }
        }
    }

    if(isset($_SESSION["alerts"])){
        echo $_SESSION["alerts"];
        unset($_SESSION["alerts"]);
    }

}

?>
<!--
select kategorie.id_kategori as "id", kategorie.title as "tytul"
,kategorie.opis as "tresc",kategorie.on_off as "is_on" ,
kategorie.parent from kategorie where kategorie.id_kategori = ' . $_GET["id"];
-->

<form action="editor_panel.php?module=dodaj_kategorie" method="POST" enctype="multipart/form-data" class="form-horizontal">
    <!-- sekcja ustawień dla form -->
    <input type="hidden" id="tryb" name="tryb" value="<?php if (isset($tablica)) echo 'edytuje'; else echo 'nowy'; ?>">
    <!--<input type="hidden" id="module" name="module" value="dodaj_strone"> -->
    <fieldset>
        <div class="row">
            <!-- Form Name -->
            <legend>Edycja kategorii</legend>
            <div class="col-md-8 label-left">
                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-12 control-label" for="title_fild">Tytuł kategorii</label>
                    <input id="title_fild" name="title_fild" type="text" placeholder="podaj tytuł kategorii"
                           class="form-control input-md" required=""
                           value="<?php if (isset($tablica)) echo $tablica[0]["tytul"]; ?>">
                </div>
                <div class="form-group">
                    <label class="col-md-12 control-label" for="text_zone">Opis kategorii</label>
                    <textarea class="form-control" id="text_zone" name="text_zone"
                              placeholder="miejsce na opis kategorii"><?php if (isset($tablica)) echo $tablica[0]["tresc"]; ?></textarea>
                </div>
                <div class="form-group">
                    <!--
                    <div class="col-md-7">
                        <label class="col-md-12 control-label" for="tags">Tagi</label>
                        <input id="tags" name="tags" type="text" placeholder="sport,news,itp"
                               class="form-control input-md" title="tagi oddzielaj przecinkiem ','">
                    </div>

                    <div class="col-sm-5">
                        <label class="col-md-12 control-label" for="tags">Ładuj obraz</label>
                        <label class="file">
                            <input type="file" name="file" id="file" class="btn btn-default" style="width: 100%">
                            <span class="file-custom"></span>
                        </label>
                    </div>
                    -->
                </div>

            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label class="col-md-12 control-label" for="select_parent">Wybierz rodzica</label>
                    <select id="select_parent" name="select_parent" class="form-control">
                        <!-- Odczytanie kategorii -->

                        <?php
                        $conn = Connect_to_server();
                        $sql = "SELECT id_kategori, title, parent FROM kategorie";
                        $wynik = $conn->query($sql);
                        $conn->close();

                        if ($wynik->num_rows > 0) {
                            // output data of each row

                            if (isset($tablica)) echo '<option value="' . $tablica[0]["id"] . '">' . $tablica[0]["title"] . '</option>';
                            else echo '<option value="0">brak rodzica</option>';

                            while ($row = $wynik->fetch_assoc()) {
                                if (isset($tablica)) {
                                    if ($row["id_kategori"] !== $tablica[0]["kat_id"]) {
                                        echo '<option value="' . $row["id_kategori"] . '">' . $row["title"] . '</option>';
                                    }
                                } else echo '<option value="' . $row["id_kategori"] . '">' . $row["title"] . '</option>';

                            }

                        } else {

                            echo '<option value="default">default</option>';

                        }

                        ?>

                    </select>
                </div>
                <div class="form-group">
                    <label class="col-md-12 control-label" for="off_on_box">Publikacja</label>
                    <label class="radio-inline" for="off_on_box-0">
                        <input type="radio" name="off_on_box" id="off_on_box-0" value="1" <?php if (isset($tablica)) {
                            if ($tablica[0]["is_on"] == "1") echo 'checked="checked"';
                        } else echo 'checked="checked"'; ?>>
                        tak
                    </label>
                    <label class="radio-inline" for="off_on_box-1">
                        <input type="radio" name="off_on_box" id="off_on_box-1"
                               value="0" <?php if (isset($tablica)) if ($tablica[0]["is_on"] == "0") echo 'checked="checked"'; ?>>
                        nie
                    </label>
                </div>
                <div class="form-group">
                    <label class="col-md-12 control-label" for="id_fild">Id kategorii</label>
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
