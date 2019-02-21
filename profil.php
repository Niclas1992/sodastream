
<?php


require('mysqlconnector.php');
session_start();
$mysqlconnector = new MysqlConnector("localhost", "niclas", "password");


if(!empty($_SESSION['loggedin']))
  error_log ('Eingeloggt');
else {
  header('Location: login.php');
}

$error = false;
$height_error = "";
$weight_error = "";
if(!empty($_POST['update-height'])) // Überprüfung, ob Button geklickt wurde
{

    //get the values from the POST REQUEST
    $height = $_POST['height'];

    //if submitted, then validate
    if(empty($height))
	{
		$error=true;
        $height_error=' * Bitte geben Sie Ihre Größe ein';
    }

    if(false === $error)
	{
		//Validation Success!
		//Do form processing like email, database etc here
        error_log("Größe wird geändert");

        if(!empty($_SESSION['loggedin'])){
          $mysqlconnector->update_user_height($_SESSION['loggedin'], $height);
          error_log("User in Session loggedin : " . $_SESSION['loggedin']);
        }else{
          echo 'Session abgelaufen oder nicht da!';
          error_log("User nicht in Session !");
        }
        error_log ('Größe wurde geändert');
	}
}

if(!empty($_POST['update-weight'])) // Überprüfung, ob Button geklickt wurde
{

    //get the values from the POST REQUEST
    $weight = $_POST['weight'];

    //if submitted, then validate
    if(empty($weight))
	{
		$error=true;
        $weight_error=' * Bitte geben Sie Ihr Gewicht ein';
    }

    if(false === $error)
	{
		//Validation Success!
		//Do form processing like email, database etc here
        error_log("Gewicht wird geändert");

        if(!empty($_SESSION['loggedin'])){
          $mysqlconnector->update_user_weight($_SESSION['loggedin'], $weight);
          error_log("User in Session loggedin : " . $_SESSION['loggedin']);
        }else{
          echo 'Session abgelaufen oder nicht da!';
          error_log("User nicht in Session !");
        }
        error_log ('Gewicht wurde geändert');
	}
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Profil</title>

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

                <h1 class="content-box__web-app__header__headline small-9 small-offset-2">Hier kannst du dein Profil einsehen und bearbeiten:</h1>

                <a href="web-app.php" class="medium-offset-9 large-offset-9">

                    <p id="content-box__web-app__header__nav">Wasser Eingabe</p>
                    
                </a>

            </section>        

        </div>

        <section class="grid-padding-x row">
    
            <div class="content-box__profil small-9 small-offset-2 medium-4 medium-offset-1 large-6 large-offset-1 grid-x">

                <h1 class="content-box__profil--headline medium-8">Hier kannst du dein Profil einsehen und bearbeiten:</h1>

            </div>

            <div class="small-8 small-offset-2 medium-8 medium-offset-1 large-6 large-offset-1 grid-x">

                <h2 class="content-box__profil__veränderung--headline small-10 medium-8 medium-offset-1 large-10 large-offset-2">Hat sich etwas an deiner Körpergröße oder deinem Gewicht verändert?</h2>

            </div>

            <div class="content-box__profil__veränderung grid-x row">
        
                <h3 class="content-box__profil__veränderung--headline small-offset-3">Körpergröße aktuell:</h3>

                <div class="content-box__profil__veränderung--aktuell small-4 small-offset-4 medium-offset-7">
                    
                        <!-- HIER DIE AKTUELLE KÖRPERGRÖSSE AUSGEBEN -->

                     
                                               



                            180 cm
                       
                </div>

                <h3 class="content-box__profil__veränderung--headline small-offset-3">Körpergröße neu:</h3>

                <form action="profil.php" method="POST" class="content-box__profil__veränderung__form grid-x flex-center small-12 small-offset-0 medium-6">
    

                    <input class="small-8 small-offset-1 medium-6 medium-offset-1" type="number" min="1" max="220" id="height" name="height" placeholder="Körpergröße (cm)">

    
                    <input class="small-8 small-offset-1 medium-6 medium-offset-1" type="submit" id="input-height" name="update-height" value="Speichern">
    
                </form>

            </div>

            <div class="linie">

            </div>
    
            <div class="content-box__profil__veränderung grid-x row">
        
                <h3 class="content-box__profil__veränderung--headline small-offset-3">Gewicht aktuell:</h3>

                <div class="content-box__profil__veränderung--aktuell small-4 small-offset-5 medium-offset-7">
                    
                        <!-- HIER DAS AKTUELLE GEWICHT AUSGEBEN -->
                        75 kg

                </div>

                <h3 class="content-box__profil__veränderung--headline small-offset-3">Gewicht neu:</h3>

                <form action="profil.php" method="POST" class="content-box__profil__veränderung__form grid-x flex-center small-12 small-offset-0 medium-6">
    

                    <input class="small-8 small-offset-1 medium-6 medium-offset-3" type="number" min="1" max="180" id="weight" name="weight" placeholder="Gewicht (kg)">

    
                    <input class="small-8 small-offset-1 medium-6 medium-offset-3" type="submit" id="input-weight" name="update-weight" value="Speichern">
    
                </form>

            </div>

            <div class="content-box__profil small-9 small-offset-2 medium-4 medium-offset-1 large-6 large-offset-1 grid-x">

                <h2 class="content-box__profil__wasserkonsum--headline medium-8">Dein Wasserkonsum</h2>

            </div>






       
    
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

    
    