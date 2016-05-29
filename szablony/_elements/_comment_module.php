<form action="<?php echo $_SERVER["REQUEST_URI"];?>" method="GET" class="form-horizontal" >
    <input name="id" type="text" value="<?php if(isset($id_post)) echo $id_post;?> " hidden>
    <input name="send_kom" type="text" value="true" hidden>
    <fieldset>

        <!-- Form Name -->
        <legend>Zostaw komentarz</legend>

        <!-- Text input-->
        <div class="form-group">
            <label class="col-md-2 control-label" for="textinput">Twój Nick</label>
            <div class="col-md-4">
                <input id="textinput" name="nick" type="text" placeholder="Twój nick" value = "<?php if(isset($_SESSION["uzytkownik"]) && $_SESSION["uzytkownik"] != "anonimowy" ) echo $_SESSION["uzytkownik"];if(isset($_GET["nick"]) && $_GET["nick"] != "") echo $_GET["nick"]; ?>" <?php if(isset($_SESSION["uzytkownik"]) && $_SESSION["uzytkownik"] != "anonimowy" ) echo "readonly";  ?> class="form-control input-md" >
            </div>
        </div>

        <!-- Textarea -->
        <div class="form-group">
            <label class="col-md-2 control-label" for="textarea">Twój wpis</label>
            <div class="col-md-10">
                <textarea class="form-control" id="textarea" name="komentarz" placeholder="Tu wstaw swój komentarz" rows="4"><?php if(isset($_GET["komentarz"]) && $_GET["komentarz"] != "") echo $_GET["komentarz"]; ?></textarea>
            </div>
        </div>

        <?php

            if ($_SESSION['uzytkownik'] == 'anonimowy') {
                echo 'Musisz się zalogowć żeby módz komentować, bez konieczności rozwiązywania captcha <a href ="#" title="Przekirouj do sekcji logowania">zaloguj</a>';
                include 'moduly/captcha/captcha.php';
            }
        ?>

        <!-- Button -->
        <div class="form-group">
            <div class="col-md-12" style="text-align: right">
                <button id="sendkombutton" name="sendkombutton" class="btn btn-primary" type="submit">Zapisz wpis</button>
            </div>
        </div>
    </fieldset>
</form>