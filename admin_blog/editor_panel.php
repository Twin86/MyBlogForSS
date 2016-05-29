<?php
include 'szablony/_session.php';
?>
<?php
include 'szablony/_header.php';
?>
<div class="container-fluid">
    <div class="row top-area">
        <div class="col-md-8">
            <a href="editor_panel.php"><h3>Panel administracyjny bloga, witaj <?php echo $_SESSION["uzytkownik"];?> </h3></a>

        </div>
        <div class="col-md-4 top-tools-area">

            <a href="editor_panel.php?module=dodaj_strone" title="Narzędzie do edycji stron bloga"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
            <a href="editor_panel.php?module=dodaj_uzytkownik" title="Dodaj użytkownika"><i class="fa fa-users" aria-hidden="true"></i></a>
            <i class="fa fa-envelope-o" aria-hidden="true"></i>
            <i class="fa fa-info" aria-hidden="true"></i>
            <a href="editor_panel.php?logout=true"> <i class="fa fa-sign-out" aria-hidden="true"></i></a>
        </div>
    </div>
    <div class="row mid-area">
        <div class="col-md-2 mid-left-area">
            <ul class="list-group">
                <li class="list-group-item test"><a href="editor_panel.php?module=strona"
                                                    title="Narzędzie do edycji stron bloga">Wpisy</a>
                    <ul class="test2">
                        <li><a href="editor_panel.php?module=dodaj_strone" title="Narzędzie do edycji stron bloga">Dodaj wpis</a></li>
                        <li>Komentarze</li>
                    </ul>
                </li>
                <li class="list-group-item"><a href="editor_panel.php?module=kategorie" title="Zarządzaj kategoriami">Kategorie</a>
                    <ul class="test2">
                        <li><a href="editor_panel.php?module=dodaj_kategorie" title="Dodawanie kategori do bloga">Dodaj kategorię</a></li>
                    </ul>
                </li>
                <li class="list-group-item"><a href="editor_panel.php?module=wiadomosci"
                                               title="Przeglądaj i odpowiadaj na wiadomości otrzymywane od swoich czytelników">Wiadomości <?php Msg_unread() ?></a>
                </li>
                <li class="list-group-item"><a href="editor_panel.php?module=uzytkownicy_edit"
                                               title="Edycja użytkowników zarejsestrowanych na twoim blogu.">Użytkownicy</a>
                <ul class="test2">
                        <li><a href="editor_panel.php?module=dodaj_uzytkownik"
                            title="Dodaj użytkownika do bazy">Dodaj</a></li>
                    </ul>
                </li>
                <li class="list-group-item">Ustawienia</li>
            </ul>
        </div>

        <div class="col-md-10 mid-center-area" id="work-area">
            <?php
            // var_dump($_GET);
            // var_dump($_POST);
            if(isset($_GET["module"])) {
                Load_tools($_GET["module"]);
            }else Load_tools();

            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
        </div>
        <div class="col-md-4">
        </div>
    </div>
</div>
</body>