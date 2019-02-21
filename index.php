
<?php


require('mysqlconnector.php');
session_start();
$mysqlconnector = new MysqlConnector("localhost", "niclas", "password");

// Löschen aller Session-Variablen.
$_SESSION = array();

if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000, $params["path"],
        $params["domain"], $params["secure"], $params["httponly"]
    );
}

// Zum Schluß, löschen der Session.
session_destroy();
  error_log('Nutzer wurde aus der der Session gelöscht.');

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

            <section class="grid-x content-box__stage">

                <div class="content-box__stage__image small-6 medium-3 medium-offset-2 large-2 large-offset-2">
                    <img src="images/teaser-mockup.png" alt="iPhone mit Wasserübersicht" title="iPhone mit Wasserübersicht">
                </div>

                <div class="content-box__stage__text small-6 small-offset-1 medium-5 medium-offset-1 large-4 large-offset-2">

                    <h1 id="content-box__stage__text--headline">Wie viel trinkst du wirklich?</h1>

                    <p id="content-box__stage__text--info-text">Logge dich jetzt ein und verwalte deinen Wasserkonsum – einfach und übersichtlich!</p>

                    
                    <a class="content-box--variation__content-section-6__content-box__button" href="registrierung.php">

                        <button class="button--blue button--jetzt-registrieren">Jetzt Registrieren</button>
        
                    </a>

                </div>

            </section>        

        </div>
        
        <section class="grid-padding-x row">

            <div class=" grid-x content-box__wasser-links column">

                <div class="content-box__wasser-links__text flex-center cell">         
                    <h2 class="content-box__wasser-links__text--headline small-12">75%</h2>
                </div>

                <div class="content-box__wasser-links__text flex-center cell">             
                    <p class="content-box__wasser-links__text--text">der Menschen <br> trinken zu wenig</p>
                </div>

            </div>

            <div class="grid-x content-box__wasser-rechts column">

                <div class="content-box__wasser-rechts__text small-9 small-offset-2 medium-10 medium-offset-1 large-9 large-offset-2 ">

                    <h2 id="content-box__wasser-rechts__text--headline">Sechs Gläser Wasser täglich</h2>

                    <p id="content-box__wasser-rechts__text--info-text">Im bewegungsarmen Alltag verliert der Körper etwa 2,5 Liter Flüssigkeit und die wollen wieder aufgefüllt werden. Mindestens 1,5 Liter Wasser müssen wir daher trinken – das sind etwa sechs Gläser. Den Rest nehmen wir über feste Nahrung auf.</p>

                    <a class="content-box--variation__content-section-6__content-box__button" href="warum-wasser.php">

                        <button class="button--blue button--wasser-info">Mehr zum Wasser</button>
        
                    </a>

                </div>

            </div>

        </section>

        <section class="grid-padding-x grid-x row">

                <div class="content-box__section__image small-12 medium-12 large-12">
                    <img src="images/water.png" alt="Wasser von oben" title="Wasser von oben">
                </div>

        </section>
  
        <section class="grid-padding-x grid-x row">

            <div class="content-box__überblick__text grid-x">

                <h3 class="content-box__überblick__text--headline small-9 small-offset-2 medium-10 medium-offset-1 large-3 large-offset-2">Den Überblick behalten</h3>

                <p class="content-box__überblick__text--info-text small-9 small-offset-2 medium-10 medium-offset-1 large-4 large-offset-7">Wie soll man im oft stressigen Alltag den Überblick über seinen Wasserkonsum behalten? Ganz einfach:</p>

            </div>
  
            <div class="content-box__überblick__app-info grid-x">

                <div class="content-box__überblick__app-info__image1 small-6 small-offset-2 medium-3 medium-offset-2 large-3 large-offset-3">

                    <img src="images/teaser-mockup.png" alt="iPhone mit Wasserübersicht" title="iPhone mit Wasserübersicht">

                </div>

                <div class="content-box__überblick__app-info__punkte1 grid-x small-8 small-offset-2 medium-4 medium-offset-1">

                    <div class="content-box__überblick__app-info__punkt grid-x">

                        <img class="content-box__überblick__app-info__punkt--icon small-1 small-offset-0" src="images/+.svg" alt="+" title="+">

                        <p class="content-box__überblick__app-info__punkt--1 small-8 small-offset-2">Ermittle deinen persönlichen Wasserbedarf</p>

                    </div>

                    <div class="content-box__überblick__app-info__punkt grid-x">

                        <img class="content-box__überblick__app-info__punkt--icon small-1 small-offset-0" src="images/+.svg" alt="+" title="+">

                        <p class="content-box__überblick__app-info__punkt--2 small-8 small-offset-2">Verwalte deinen täglichen Wasserkonsum</p>

                    </div>

                    <div class="content-box__überblick__app-info__punkt grid-x">

                        <img class="content-box__überblick__app-info__punkt--icon small-1 small-offset-0" src="images/+.svg" alt="+" title="+">

                        <p class="content-box__überblick__app-info__punkt--3 small-8 small-offset-2">Lass dir anzeigen, wie viel du noch trinken musst</p>

                    </div>

                </div>

                <div class="content-box__überblick__app-info__punkte2 grid-x small-8 small-offset-2 medium-4 medium-offset-1 large-offset-2">

                    <div class="content-box__überblick__app-info__punkt grid-x">

                        <img class="content-box__überblick__app-info__punkt--icon small-1 small-offset-0" src="images/+.svg" alt="+" title="+">

                        <p class="content-box__überblick__app-info__punkt--4 small-8 small-offset-2">Vergleiche dein aktuelles Trinkverhalten mit dem aus der Vergangenheit</p>

                    </div>

                    <div class="content-box__überblick__app-info__punkt grid-x">

                        <img class="content-box__überblick__app-info__punkt--icon small-1 small-offset-0" src="images/+.svg" alt="+" title="+">

                        <p class="content-box__überblick__app-info__punkt--5 small-8 small-offset-2">Teile deine Ergebnisse auf Social Media</p>

                    </div>

                </div>

                <div class="content-box__überblick__app-info__image2 small-6 small-offset-3 medium-3 medium-offset-2 large-3 large-offset-1">

                    <img src="images/teaser-mockup.png" alt="iPhone mit Wasserübersicht" title="iPhone mit Wasserübersicht">
                        
                </div>

            </div>

        </section>    

        <section class="grid-x grid-padding-x content-box__teaser-text-box">

            <div class="content-box__teaser-text-box__headline-box small-10 small-offset-2 medium-4 medium-offset-1 large-offset-2">

                <h3 id="content-box__teaser-text-box__headline">Los geht's!</h3>

            </div> 

            <div class="content-box__teaser-text-box__text-box small-9 small-offset-2 medium-5 medium-offset-1 large-4 large-offset-0">

                <p>Registriere dich jetzt und nutze alle Vorteile der Anwendung – und zwar komplett kostenlos!</p>

            </div>

            <a class="content-box--variation__content-section-6__content-box__button small-offset-2 medium-offset-6" href="registrierung.php">

                <button class="button--blue button--jetzt-registrieren">Jetzt Registrieren</button>

            </a>

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


