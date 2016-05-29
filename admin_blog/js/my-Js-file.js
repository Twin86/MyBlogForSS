/**
 * Created by seba on 19.04.16.
 */

window.onload = function () {
    // menu_add_action();
};

function menu_add_action() {

    var menus = $("ul.list-group").find("li");

    if (menus.length > 0) {
        for (i = 0; i < menus.length; i++) {

            switch (menus[i].innerText) {
                case "Strona" :
                {
                    $(menus[i]).on("click", function () {
                        $("#work-area").load("szablony/_page_editor.php");
                    });
                    break;
                }
            }

        }
    }

}
