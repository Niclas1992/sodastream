
<?php

require('mysqlconnector.php');
session_start();
$mysqlconnector = new MysqlConnector("localhost", "test", "test");


//TODO das nur auf geschützten Seiten tun
if(!empty($_SESSION['loggedin']))
  echo 'alles korrekt';
else {
  header('Location: login.php');
}

if(!empty($_POST['glas-submitted'])) // Überprüfung, ob Button geklickt wurde
{
    //get the values from the POST REQUEST
    $input = $_POST['glas'];

    //Schreiben des Wertes mittels einer Funktion in die Datenbank
    $mysqlconnector->insert_water_consum($input, $glas, '6');
    error_log ($input);
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Startseite</title>

    <link rel="stylesheet" href="css/foundation.css">
    <link rel="stylesheet" href="css/main.css">

</head>
<body>

    <header>
        <nav>

            <div id="toggle-menu" class="toggle-menu" onclick="burgerAnimation()">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </div>


            <div id="menu-box-mobile" class="menu-box-mobile grid-padding-x">

                <ul class="grid-x">

                        <li class="menu-box-mobile__nav__login small-12">
                            <a class="menu-box-mobile__nav__element__link" href="login.php">
                                <img src="images/login-mobile.svg" class="menu-box-mobile__nav__login--img" alt="Login-Button" title="Login">Login</a>
                        </li>

                        <li class="menu-box-mobile__nav__element small-12">
                            <a class="menu-box-mobile__nav__element__link" href="web-app.php">Wasser Eingabe</a>
                        </li>

                        <li class="menu-box-mobile__nav__element small-12">
                            <a class="menu-box-mobile__nav__element__link" href="profil.php">Mein Profil</a>
                        </li>

                        <li class="menu-box-mobile__nav__element small-12">
                            <a class="menu-box-mobile__nav__element__link" href="#">Support</a>
                        </li>

                        <li class="menu-box-mobile__nav__element small-12">
                            <a class="menu-box-mobile__nav__element__link" href="warum-wasser.php">Warum Wasser?</a>
                        </li>


                </ul>

            </div>


            <div id="menu-box" class="menu-box grid-container">

                <ul class="menu-box__nav grid-x">

                    <li class="menu-box__nav__element small-2 medium-3 large-2 cell">
                        <a class="menu-box__nav__element__link" href="warum-wasser.php">Warum Wasser?</a>
                    </li>

                    <li class="menu-box__nav__logo small-4 small-offset-1 medium-2 medium-offset-2 large-2 large-offset-3 flex-center cell">
                        <a href="index.php"><img src="images/logo/sodastream.svg" class="menu-box__nav__logo--img" alt="Logo Text: SodaStream" title="Logo"></a>
                    </li>

                    <li class="menu-box__nav__login small-2 medium-1 medium-offset-4 large-1 large-offset-4 cell">
                            <a href="login.php"><img src="images/login.svg" class="menu-box__nav__login--img" alt="Login-Button" title="Login"></a>
                    </li>

                </ul>

            </div>

        </nav>

    </header>

    <main class="content__wrapper grid-container">

        <div class="grid-padding-x">

            <section class="grid-x content-box__web-app__header">

                <h1 class="content-box__web-app__header__headline small-6 small-offset-2">Deine Übersicht für heute:</h1>

                <a href="profil.php" class="medium-offset-9 large-offset-9">

                    <p id="content-box__web-app__header__nav">Mein Profil</p>

                </a>

            </section>

        </div>

        <section class="grid-padding-x row">

            <div class="grid-x content-box__web-app__übersicht column">

                <div class="content-box__web-app__übersicht small-9 small-offset-2 medium-10 medium-offset-1 large-8 large-offset-2 grid-x">

                    <h2 class="content-box__web-app__übersicht--headline medium-12">Deine Übersicht für heute:</h2>


                    <div class="content-box__web-app__übersicht--circle flex-center small-8 small-offset-1 medium-4 medium-offset-4 large-6 large-offset-3">
                        <div class="content-box__web-app__übersicht--circle-prozent">

                            <!-- HIER DIE RECHNUNG EINFÜGEN IN PROZENT UND ÜBER DIV STYLEN-->
                            65 %

                        </div>

                    </div>

                </div>

                <div class="grid-x content-box__web-app__übersicht--zahlen flex-center">

                    <div class="content-box__web-app__übersicht--bisher ">

                        <p class="content-box__web-app__übersicht--bisher-text">Bisher:</p>

                        <div class="content-box__web-app__übersicht--bisher-output">
                            1,5l <!-- HIER DIE AUSGABE DER BISHERIGEN WASSERMENGE DES TAGES-->
                        </div>

                    </div>

                    <div class="content-box__web-app__übersicht--ziel small-offset-3">

                        <p class="content-box__web-app__übersicht--ziel-text">Ziel:</p>

                        <div class="content-box__web-app__übersicht--ziel-output">
                            2,5l <!-- HIER DIE AUSGABE DER BISHERIGEN WASSERMENGE DES TAGES-->
                        </div>

                    </div>

                </div>

            </div>

            <div class="grid-x content-box__web-app__wassermenge column">

                <div class="content-box__web-app__wassermenge small-9 small-offset-2 medium-10 medium-offset-1 large-8 large-offset-2 ">

                    <h4 class="content-box__web-app__wassermenge--headline">Gib deine getrunkene Wassermenge in Liter oder in SodaStream Flaschen an:</h4>



                        <div class="content-box__web-app__wassermenge__eingabe-box--glas grid-x medium-4">

                            <div class="content-box__web-app__wassermenge__eingabe-box--glas__image small-offset-4 medium-offset-2 medium-3">

                                <img src="images/glas.png" alt="Glas Icon" title="Glas Icon">

                            </div>

                            <form action="web-app.php" method="POST" class="content-box__web-app__wassermenge__eingabe-box--glas__form grid-x medium-6 medium-offset-1 flex-center">

                                <input class="content-box__web-app__wassermenge__eingabe-box--glas__form--input small-10 medium-8 large-10" type="number" min="0.1" max="8" step="0.1" id="glas" name="glas" placeholder="Eingabe (Liter)">

                                <input class="content-box__web-app__wassermenge__eingabe-box--glas__form--submit small-10 medium-8 large-10" type="submit" id="input-glas" name="glas-submitted" value="Speichern">

                            </form>


                        </div>

                        <div class="content-box__web-app__wassermenge__eingabe-box--bottle grid-x">

                            <div class="content-box__web-app__wassermenge__eingabe-box--bottle__image small-offset-4 medium-3 medium-offset-2">

                                <img src="images/bottle.png" alt="Bottle Icon" title="Bottle Icon">

                            </div>

                            <form action="web-app.php" method="POST" class="content-box__web-app__wassermenge__eingabe-box--bottle__form grid-x medium-6 medium-offset-1 flex-center">

                                <input class="content-box__web-app__wassermenge__eingabe-box--bottle__form--input small-10 medium-8 large-10" type="number" min="0.1" max="8" step="0.1" id="bottle" name="bottle" placeholder="Menge (Flaschen)">

                                <input class="content-box__web-app__wassermenge__eingabe-box--bottle__form--submit small-10 medium-8 large-10" type="submit" id="input-bottle" name="bottle-submitted" value="Speichern">

                            </form>

                        </div>

                    <p id="content-box--variation__wasser-infos__text--löschen" class="small-6 medium-6 large-4 large-offset-6">Falsche Eingabe gemacht?<br>Einfach mit einem Klick die letzte Eingabe&nbsp;<a class="" id="content-box__login__text--link" href="registrierung.php">löschen!</a></p>


                </div>

            </div>

        </section>

    </main>

    <footer class="footer__wrapper grid-container">

        <div class="footer-box grid-x">

            <div id="footer-box__links" class="cell small-7 small-offset-1 medium-2 medium-offset-1 large-2 large-offset-1">

                <div class="footer-box__links__logo small-2 small-offset-0 medium-2 medium-offset-2 large-2 large-offset-2">
                    <a href="index.php"><img src="images/logo/sodastream_footer.svg" class="footer-box__logo--img" alt="Logo Text: SodaStream" title="Logo"></a>
                </div>

                <div class="footer-box__links__social-media small-4 small-offset-0 medium-2 medium-offset-2 large-2 large-offset-1 flex-center cell">
                    <a href="https://www.twitter.com"><img class="footer-box__links__social-media__icon" src="images/social-media/twitter.svg" alt="Twitter Icon" title="Twitter Icon"></a>
                    <a href="https://www.facebook.com"><img class="footer-box__links__social-media__icon" src="images/social-media/facebook.svg" alt="Facebook Icon" title="Facebook Icon"></a>
                    <a href="https://www.instagram.com"><img class="footer-box__links__social-media__icon" src="images/social-media/instagram.svg" alt="Instagram Icon" title="Instagram Icon"></a>
                    <a href="https://www.instagram.com"><img class="footer-box__links__social-media__icon" src="images/social-media/youtube.svg" alt="Youtube Icon" title="Youtube Icon"></a>
                </div>

            </div>

            <nav class="footer-box__nav small-10 small-offset-1 medium-2 medium-offset-1 large-2 large-offset-2">

                <h4 id="footer-box__headline" class="small-11 small-offset-0 medium-2 medium-offset-0">Produkte</h4>

                <ul class="footer-box__nav-list--one small-offset-5 medium-2 medium-offset-0">
                    <li class="footer-box__nav__element"><a href="#">Wassersprudler</a></li>
                    <li class="footer-box__nav__element"><a href="#">Zubehör</a></li>
                    <li class="footer-box__nav__element"><a href="#">Sirups</a></li>
                </ul>

            </nav>

            <nav class="footer-box__nav small-10 small-offset-1 medium-2 medium-offset-1 large-2 large-offset-0">

                <h4 id="footer-box__headline" class="small-11 small-offset-0 medium-2 medium-offset-0">Informationen</h4>

                <ul class="footer-box__nav-list--two small-offset-5 medium-2 medium-offset-0">
                    <li class="footer-box__nav__element"><a href="#">Support</a></li><br>
                    <li class="footer-box__nav__element"><a href="#">Unternehmen</a></li>
                    <li class="footer-box__nav__element"><a href="#">Stellenangebote</a></li>
                </ul>

            </nav>

            <nav class="footer-box__nav small-10 small-offset-1 medium-2 medium-offset-1 large-2 large-offset-0">

                <ul class="footer-box__nav-list--three small-offset-5 medium-2 medium-offset-0">
                    <li class="footer-box__nav__element"><a href="#">Datenschutz</a></li>
                    <li class="footer-box__nav__element"><a href="#">Impressum</a></li>
                </ul>

            </nav>

        </div>

    </footer>

    <script src="js/vendor/jquery.js"></script>
    <script src="js/vendor/foundation.js"></script>
    <script src="js/main.js"></script>


</body>
</html>
