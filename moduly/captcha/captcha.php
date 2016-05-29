<?php
/**
 * Created by PhpStorm.
 * User: seba
 * Date: 23.05.16
 * Time: 13:01
 */


$img_array [] = array(
    ["facebook", "moduly/captcha/img/fb.png", "Wskaż ikone facebook'a"],
    ["google+","moduly/captcha/img/g+.png", "Wskaż ikone google+"],
    ["instagram","moduly/captcha/img/ins.png", "Wskaż ikone instagram'a"],
    ["twiter","moduly/captcha/img/twit.png", "Wskaż ikone twiter'a"],
    ["evernote","moduly/captcha/img/evernote.png", "Wskaż ikone evernote'a"]);

if (isset($_SESSION["zla_chaptcha"]) && $_SESSION["zla_chaptcha"] == true ){
   echo " <div class=\"alert alert-warning\" role=\"alert\">Oj chyba nie jesteś dość social :), źle wskazałeś ikonkę .</div> ";
   unset($_SESSION["zla_chaptcha"]);
}

echo '<captcha>';
for ($i = 0; $i < count($img_array[0]); $i++){

    $value =$img_array[0][$i][0];
    $img =$img_array[0][$i][1];
    $name =$img_array[0][$i][2];

    echo "<input type=\"radio\" name=\"social\" value=\"".$value."\" > <img src = \"".$img."\">";
}

$wylosowany = rand(0,count($img_array[0])-1);

echo "<span>".$img_array[0][$wylosowany][2]."</span>";
echo "<input type= \"hidden\" name =\"captcha\" value = \"".$img_array[0][$wylosowany][0]."\">";
echo '</captcha>';