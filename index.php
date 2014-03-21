<?php
session_start();
if(isset($_SESSION['userid']))
    {
        // Weiterleitung
            $host = $_SERVER['HTTP_HOST'];
            $uri = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
            header("Location: http://$host$uri/home.html");
            exit;
    }
?>
<html>
<head>
    <link href="style.css" rel="Stylesheet" type="text/css" media="screen"/>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.js"></script>
    <script>
        $(function(){
            $('reg').mouseover(function(){
                §(this).animate({
                    opacity: 0.75,
                    height: '300px'
                }, 1000, function(){
                    // Animation Complete.
                });
            });
            $('reg').mouseover(function(){
                §(this).animate({
                    opacity: 1.00,
                    height: '15px'
                }, 500, function(){
                    // Animation Complete.
                });
            });
        });
    </script>
</head>
<body>
    <div id="reg">
        <b>Hier Regestrieren</b><br /><br />
        <form action="reg.php" method="post">
            Vorname:<br />
                <input type="text" name="prename" style="width:100%;" /><br />
            Nachname:<br />
                <input type="text" name="lastname" style="width:100%;" /><br />
            E-Mail Adresse:
                <input type="mail" name="mail" style="width:100%;" /><br />
            E-Mail Adresse Wiederhohlen:
                <input type="mail" name="rmail" style="width:100%;" /><br />
            Password:
                <input type="password" name="password" style="width:100%;" /><br />
            Password Wiederhohlen:
                <input type="password" name="rpassword" style="width:100%;" /><br />
                <input type="submit" name="reg" value="   Registrieren   " />
        </form>
    </div>
    <div id="root">
        <div id="logo"></div>
        <div id="sub-navi" style="text-align:right;">
            <form action="login.php" method="post">E-Mail: 
                <input type="text" name="email" style="width:100px;"/>
                <input type="password" name="password" style="width:100px;"/>
                <input type="submit" value="login" name="Submit"/>
            </form>
        </div>
    </div>
    <div id="login-img">
    <img src="images/mgc_network.png" alt="LoginGrafik" border="0" />
    </div>
</body>
</html>