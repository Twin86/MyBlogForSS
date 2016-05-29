<?php
$img_table = array('img/slider/1.jpg', 'img/slider/2.jpg', 'img/slider/3.jpg', 'img/slider/4.jpg');
echo '<img src="' . $img_table[rand(0, sizeof($img_table) - 1)] . '">';
?>