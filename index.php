<?php
session_start();
if (isset($_GET['stil']) && $_GET['stil'] == 2) {
    $_COOKIE['stil'] = 2;
    setcookie('stil', '2', time() + 3600);
} else if (isset($_GET['stil']) && $_GET['stil'] == 1) {
    $_COOKIE['stil'] = 1;
    setcookie('stil', '1', time() + 3600);
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link type="text/css" rel="stylesheet" href="responsive.css">
        <link type="text/css" rel="stylesheet" href="style.css">
        <?php
        if (isset($_COOKIE['stil']) && $_COOKIE['stil'] == 2) {
            echo '<link type="text/css" rel="stylesheet" href="style2.css">';
        }
        ?>

        <title>Gamp Php</title>
        <?php

        function spruecheArray() {
            $spruch[0] = 'Wer früher stirbt, ist länger tod';
            $spruch[1] = 'Das Leben ist kein Ponyhof';
            $spruch[2] = 'Träume nicht dein Leben, lebe deine Träume';

            foreach ($spruch as $value) {
                echo $value . "<br>";
            }
        }
        ?>


        <script>
            function getCookie(cname) {
                var name = cname + "=";
                var ca = document.cookie.split(';');
                for (var i = 0; i < ca.length; i++) {
                    var c = ca[i];
                    while (c.charAt(0) == ' ') {
                        c = c.substring(1);
                    }
                    if (c.indexOf(name) == 0) {
                        return c.substring(name.length, c.length);
                    }
                }
                return "";
            }


            var d = new Date();
            d.setTime(d.getTime() + (60));
            var expires = "expires=" + d.toUTCString();
            document.cookie = "message=1;" + expires + ";path=/";


            if (getCookie('message') === '')
            {
                alert("Diese Seite speichert Cookies!");
                var d = new Date();
                d.setTime(d.getTime() + (60));
                var expires = "expires=" + d.toUTCString();
                document.cookie = "message=1;" + expires + ";path=/";
            }

        </script>


    </head>
    <body>

        <div class="header">
            <h1>PHP/Javascript Gamper</h1>
            <?php
            if (!isset($_SESSION['User'])) {
                echo'<a href="?login=1">Login</a><a href="?register=1">Registrieren</a>';
            } else {
                echo'<a href="?logout=1">Logout!</a><p>Hallo ' . htmlspecialchars($_SESSION['User']). '</p>';
            }
            ?>
        </div>

        <div class="row">
            <div class="col-3 col-m-3 menu">
                <ul>
                    <li><a href="?aufgabe=1">Aufgabe 1</a></li>
                    <li><a href="?aufgabe=2">Aufgabe 2</a></li>
                    <li><a href="?aufgabe=3">Aufgabe 3</a></li>
                    <li><a href="?inhaltDB=1">Inhalt DB Anzeigen</a></li>
                    <?php
                    if (isset($_SESSION['eingeloggt']) && $_SESSION['eingeloggt'] == 'ja' && !isset($_Get['logout'])) {
                        echo' <li><a href="?special=1">Special</a></li>';
                    }
                    ?>
                </ul>
            </div>

            <div id="section" class="col-6 col-m-9">

                <p><?php
                    if (!empty($_GET)) {
                        if (!empty($_GET['aufgabe']) && $_GET['aufgabe'] == 2) {
                            echo'<h1>Sprueche Array</h1>';
                            echo '<p>' . spruecheArray() . '</p>';
                        } elseif (!empty($_GET['aufgabe']) && $_GET['aufgabe'] == 3) {
                            echo'<h1>Formular Newsletter</h1>';
                            include_once('formular.html');

                            if (!empty($_SESSION)) {
                                if ($_SESSION['erfolg'] === 0) {

                                    echo'<h1>Fehler!</h1>';
                                    if ($_SESSION['Vorname'] == false) {
                                        echo'<p>Ihr Vorname entspricht nicht den Anforderungen</p>';
                                    }
                                    if ($_SESSION['Nachname'] == false) {
                                        echo'<p>Ihr Nachname entspricht nicht den Anforderungen</p>';
                                    }
                                    if ($_SESSION['Alter'] == false) {
                                        echo'<p>Ihr Alter entspricht nicht den Anforderungen (mind. Alter:12)</p>';
                                    }
                                    if ($_SESSION['Email'] == false) {
                                        echo'<p>Ihre Email entspricht nicht den Anforderungen</p>';
                                    }
                                    if (!empty($_SESSION['Email2']) && $_SESSION['Email2'] == 'duplikat') {
                                        echo'<p>Ihre Email befindet sich bereits in der Datenbank</p>';
                                    }
                                }

                                session_destroy();
                            }
                        } elseif (isset($_GET['inhaltDB']) && $_GET['inhaltDB'] == 1) {
                            require_once ('connection.php');        
                            require_once ('select.php');
                           
                        } elseif (isset($_GET['login']) && $_GET['login'] == 1) {
                            require_once('loginFormular.php');

                            if (!empty($_SESSION['eingeloggt']) && $_SESSION['eingeloggt'] == 'nein') {
                                echo'<p>Sie haben falsche Daten angegeben!</p>';
                            }
                        } elseif (isset($_GET['special']) && $_GET['special'] == 1) {

                            require_once 'inhalt/loginUbersicht.php';
                            require_once 'login2.php';
                            
                        } elseif (isset($_GET['logout']) && $_GET['logout'] == 1) {
                            echo $_SESSION['User'] . ' hat sich ausgeloggt!';
                            session_destroy();
                            header('Location: http://localhost/GampAufgabe3/index.php');
                            
                        } elseif (isset($_GET['register']) && $_GET['register'] == 1) {
                            require_once ('loginFormular.php');
                            if (isset($_GET['duplikat']) && $_GET['duplikat'] == 1) {
                                echo'Fehler: Der Benutzername ist bereits vorhanden!';
                            } elseif (isset($_GET['stimmtNichtÜberein']) && $_GET['stimmtNichtÜberein'] == 1) {
                                echo'Fehler: Passwort stimmt nicht überein!';
                            }
                        }
                    } elseif (!empty($_SESSION['erfolg']) && $_SESSION['erfolg'] == 1) {
                        echo'<h1>Erfolg</h1>
                            <p>Sie haben sich erfolgreich angemeldet!</p>';

                        foreach ($_SESSION as $key => $value) {
                            if ($key != 'erfolg' && $key != 'email2' && $key != 'eingeloggt') {
                                echo '<p>' . htmlspecialchars($key) . ': ' . htmlspecialchars($value) . '</p>';
                            }
                            session_unset();
                        }
                    } elseif (!empty($_SESSION['eingeloggt']) && $_SESSION['eingeloggt'] == 'ja') {

                        echo'<p> Sie haben sich erfolgreich eingeloggt';
                    }
                    ?>
                </p>


            </div>

            <div id="side" class="col-3 col-m-12">
                <div class="aside">

                </div>
            </div>

        </div>

        <div class="footer col-m-12">
            <p><?php
                    $datum = date("Y");
                    echo '&copy;Markus Weissenbach ' . $datum;
                    ?>
            </p>
            <a href="?stil=2">
                Stil2
            </a>
            <a href="?stil=1">
                Stil
            </a>

        </div>

    </body>
</html>

