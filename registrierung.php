
<?php


require('mysqlconnector.php');
session_start();
$mysqlconnector = new MysqlConnector("localhost", "niclas", "password");


//Validierung der einzelnen Felder:

$error = false;

if(!empty($_POST['submitted'])) // Überprüfung, ob Button geklickt wurde
{
    //get the values from the POST REQUEST
    $name = trim($_POST['name']); $username = trim($_POST['username']); $email = $_POST['email']; $password = $_POST['password'];

    // set the error messages empty
    $name_error = ""; $username_error = ""; $email_error = ""; $password_error = "";

    //if submitted, then validate
    if(empty($name))
	{
		$error=true;
        $name_error=' * Bitte geben Sie Ihren Namen ein';
    }
	if(empty($username))
	{
		$error=true;
        $username_error=' * Bitte geben Sie einen Benutzernamen ein.';
    }

    if(empty($email))
    {
        $email_error = " * Bitte geben Sie eine gültige E-Mail Adresse ein.";
        $error=true;

    }else{

        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            //Unvalid email!
            $email_error = " * Bitte geben Sie eine gültige E-Mail Adresse ein.";
            $error=true;
        }

        if($mysqlconnector->user_exists($email)){
            $email_error = " * Der Benutzer existiert bereits. Bitte einloggen.";
            $error = true;

        }
    }

    if(empty($password))
	{
		$error=true;
        $password_error=' * Bitte geben Sie ein Passwort ein.';
    }

    if(false === $error)
	{
		//Validation Success!
		//Do form processing like email, database etc here
        $mysqlconnector->insert_user($name, $email, $password, $username, 0, 0);
        //echo 'User inserted';
        $_SESSION['justregister'] = $email;
        error_log('Nun ist der User in der Session in justgregistered : ' . $_SESSION['justregister']);
        header('Location: registrierung-2.php');
	}
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registrierung</title>

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

    <main class="grid-container">

        <div class="content-box__registrierung grid-x flex-center">

            <form action="registrierung.php" method="POST" class="small-10 medium-6 large-4 grid-x row">

                <h1 id="content-box__registrierung__headline">Gleich geschafft! Bitte fülle die Felder aus um durchzustarten:</h1>

                <input class="row" type="text" id="name" name="name" placeholder="Name">
                <span class="row error"><?php echo $name_error; ?></span><br/>

                <input class="row" type="text" id="username" name="username" placeholder="Benutzername">
                <span class="row error"><?php echo $username_error; ?></span><br/>

                <input class="row" type="email" id="email" name="email" placeholder="E-Mail">
                <span class="row error"><?php echo $email_error; ?></span><br/>

                <input class="row" type="password" id="password" name="password" placeholder="Passwort">
                <span class="row error"><?php echo $password_error; ?></span><br/>

                <input type="submit" id="sign-up" name="submitted" value="Registrieren">

            </form>


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
