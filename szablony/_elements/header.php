<?php
include 'session.php';
?>

<!DOCTYPE html>
<html lang="pl">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Szczupakiem.PL Blog co na murawie piszczy</title>
    <meta name="description" content="Source code generated using layoutit.com">
    <meta name="Sebastian Tarka" content="Blog o piłce nożnej">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="scss/mojstyl.css" rel="stylesheet">
    <link rel="stylesheet" href="css/font-awesome-4.6.1/css/font-awesome.css">
    <link rel="Shortcut icon" href="img/logo.png"/>
</head>
<body>
<div class="container-fluid test">
    <div class="row top-block">
        <div class="col-md-5">
            <ul class="nav nav-pills">
                <li><a href="index.php">Top</a></li>
                <li><a href="#">Galeria</a></li>
                <li><a href="#">O mnie</a></li>
                <li><a href="#">Kontakt</a></li>
            </ul>
        </div>
        <div class="col-md-7 quick-login-area">
            <?php include '_quick_login' ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="page-header">
                <img src="img/logo.png" class="hidden-xs">
                <h1>
                    Szczupakiem.pl
                    <small>Blog co na murawie piszczy</small>
                </h1>
            </div>
        </div>
    </div>
    <div class="row top-nav-block">
        <?php Main_menu(); ?>
    </div>

