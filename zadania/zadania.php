<?php
/**
 * Created by PhpStorm.
 * User: sebastian
 * Date: 20.03.16
 * Time: 12:33
 */


echo '<h1>Zadanie 2</h1><br>';
for ($i = 0; $i < 30; $i++) {
    //„Trzy dodać cztery wynosi 7”
    $a = rand(1, 10);
    $b = rand(1, 10);
    $c = rand(1, 10);
    $wynik = $a + $b + $c;
    echo $a . '+' . $b . '+' . $c . '=' . $wynik . '<br>';
}


echo '<h1>Zadanie 3</h1><br>';
for ($i = 1; $i <= 20; $i++) {
    echo $i . ' jest';

    if ($i % 2 == 0) {
        echo ' parzysta <br>';
    } else {
        echo ' nieparzysta <br>';
    }
}


echo '<h1>Zadanie 4</h1><br>';
for ($i = 1; $i <= 100; $i++) {

    if ($i % 8 == 0) {
        continue;
    } elseif ($i % 10 == 0) {
        continue;
    } else {
        if ($i % 4 == 0) {
            echo $i . '<br>';
        }
    }
}
