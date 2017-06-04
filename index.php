<?php
require_once ("calendar.php");
require_once ("form.php");
session_start();
if (!isset($_SESSION['count'])){
    $_SESSION['count'] = 1;} 
else {
    $_SESSION['count']++;}
$calendar= new calendar;
$form= new form;
?>
<html>
    <head>
        <title>Kalendarz</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css/main.css">
    </head>
    <body>
        <nav class="navabr navbar-inverse">
            <div class="header container-fluid">
                <div class="navbar-header hidden-xs">
                    <i class="header__logo fa fa-calendar" aria-hidden="true"></i>
                </div>
                <span class="header__title">YOUR CALENDAR</span>
            </div>
        </nav>
        <div class="main container">
            <div class="row">
                <div class="calendar">
                    <?php
                    $calendar->createDays();
                    ?>
                </div>
            </div>
            <div class="addingEvents">
                <?php
                $form->eventForm()
                ?>
            </div>
        </div>
        <script src="js/jquery-3.2.1.min.js"></script>
        <script src="http://code.jquery.com/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/calendar.js"></script>
    </body>
</html>