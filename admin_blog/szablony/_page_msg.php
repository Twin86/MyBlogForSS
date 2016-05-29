<?php
/**
 * Created by PhpStorm.
 * User: seba
 * Date: 26.04.16
 * Time: 21:57
 */
?>
<form action="#" method="POST" class="form-horizontal">
    <fieldset>
        <div class="row">
            <!-- Form Name -->
            <legend>Panel zarządzania wiadomościami</legend>
            <div class="col-md-8 label-left">
                <!-- Text input-->
                <div class="form-group">
                    <?php
                    Show_msg_table();
                    ?>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">

                </div>
                <div class="form-group button-group">
                    <button type="submit" class="btn btn-primary">Zapisz</button>
                    <button type="reset" class="btn btn-warning">Czyść</button>
                </div>

            </div>
        </div>

    </fieldset>
</form>