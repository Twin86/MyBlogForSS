<?php
/**
 * Created by PhpStorm Moduł kalendarza meczów.
 * User: seba
 * Date: 20.05.16
 * Time: 10:11
 */

$myfile = fopen("moduly/callender/mecze.txt", "r") or die("Unable to open file!");
$iread = fread($myfile,filesize("moduly/callender/mecze.txt"));

fclose($myfile);

$mecze = explode("\n", $iread);

echo '<h2>Nadchodzące mecze, ciekawe wyniki.</h2>';
echo '<div class="row"><div class="col-md-12 callender"> ';
echo $mecze[rand(0,count($mecze)-1)];
echo '</div></div>';


?>