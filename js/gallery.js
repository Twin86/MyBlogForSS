/**
 * Created by seba on 24.05.16.
 */


$(window).load(function(){

    gallery_action ();



});

function gallery_action (){
    $("div.img-gallery-block").on("click",function () {

        var tlo = document.createElement("div");
        tlo.className = "gallery-background";

        var img_box = document.createElement("div");
        img_box.className = "gallery-img";

        var close = document.createElement("span");
        close.className = "gallery-close-button";

        close.innerHTML = "<i class=\"fa fa-times-circle\" aria-hidden=\"true\"></i>";

        $(img_box).append(close);

        $(tlo).append(img_box);
        $("body").append(tlo);

        $(".gallery-close-button").on("click", function () {
            $(tlo).remove();
        });

        var img_url = $(this).find("img").attr("src");
        var img  = document.createElement("img");
        $(img).attr("src",img_url);
        $(img_box).append(img);

    });
}