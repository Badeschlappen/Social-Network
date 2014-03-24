/**
 * Shows the status page.
 *
 * @author		Patrick B
 * @copyright 	2014 [CC BY-NC-SA 3.0 <http://creativecommons.org/licenses/by-nc-sa/3.0/deed>] All Rights Reserved.
 * @package		com.mgc.social-network
 *
 **/

<html>
<head>
    <link href="style/style.css" rel="stylesheet" type="text/css" media="screen"/>
</head>
<body>
    <div id="root">
        <div id="logo"></div>
        <div id="sub-navi" style="text-align: right;">
            <form action="login.php" method="post">
                E-Mail: 
                    <input type="text" name="email" style="width: 100px;"/>
                Passwort:
                    <input type="text" name="password" style="width: 100px;"/>
                    <input type="submit" value="Login" name="submit"/>
            </form>
        </div>
        <div id="content">
            <div id="navi"></div>
            <div id="main-content"></div>
        </div>
    </div>
</body>                                                                       
</html>