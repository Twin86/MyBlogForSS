<?php
session_start();

include 'szablony/_header.php';

if (isset($_SESSION["uzytkownik"])) {
    if ($_SESSION["uzytkownik"] != "anonimowy" && $_SESSION["uprawnienia"] != "1" ) {
        header("Location: editor_panel.php");
    }
}

?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
            <h3 class="text-center">
                Logowanie do panelu administratora
            </h3>
            <form role="form" method="POST" action="editor_panel.php">
                <input type="hidden" id="login" name="login" value="true">
                <div class="form-group">

                    <label for="exampleInputEmail1">
                        Email address
                    </label>
                    <input type="email" class="form-control" id="exampleInputEmail1" name="exampleInputEmail1"/>
                </div>
                <div class="form-group">

                    <label for="exampleInputPassword1">
                        Password
                    </label>
                    <input type="password" class="form-control" id="exampleInputPassword1"
                           name="exampleInputPassword1"/>
                </div>
                <div class="form-group">
                    <p class="help-block">
                        Example block-level help text here.
                    </p>
                </div>
                <div class="checkbox">

                    <label>
                        <input type="checkbox"/> Check me out
                    </label>
                </div>
                <button type="submit" class="btn btn-default">
                    Submit
                </button>
                <a href="editor_panel.php" class="btn btn-default" title="Przejdź do panelu administracji">Enter</a>
            </form>
        </div>
    </div>
</div>
</body>