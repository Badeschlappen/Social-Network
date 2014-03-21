<?php
session_start();
require('config.php');
if(isset($_SESSION['userid']))
    {
        // Weiterleitung
            $host = $_SERVER['HTTP_HOST'];
            $uri = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
            header("Location: http://$host$uri/home.html");
            exit;
    }
if(isset($_POST['pinnwand']) AND $_POST['pinnwand'] != "" AND $_POST['pinnwand'] !="Dein Status"){
    date_default_timezone_set("Europe/Berlin");
    $date = date("Y-m-d H:i:s");
    $pw = mysql_real_escape_string($_POST['pinnwand']);
    $uid = mysql_real_escape_string($_SESSION['userid']);
    $insert = mysql_query("INSERT INTO pinnwand VALUES('{$pw}', '{$uid}', '{$date}')");
}
$select_frindship_requersts = mysql_query("SELECT * FROM frindship WHERE {$_SESSION['userid']} AND confired = 0");
$open_frindship_request = mysql_num_rows($select_frindship_requersts);
if($open_frindship_request > 0){
    $frindship_request = '<a href="reguerst_anwser.php">'. $open_frindship_request.' Freundschaftsanfragen</a>';
}
?>
<html>
<head>
    <link href="style.css" rel="Stylesheet" type="text/css" media="screen"/>
</head>
<body>
    <div id="root">
        <div id="logo"></div>
        <div id="sub-navi"><?php echo $frindship_request; ?></div>
        <div id="content">
            <div id="navi"><?php echo date("Y-m-d H:i:s");?></div>
            <div id="main-content">
                <form action="home.php" method="post">
                    <input type="text" value="Dein Status" name="Pinnwand" style="width:100%;" onfocus="if(this.value == 'Dein Status') this.value = ''" onblur="if(this.value == '') this.value = 'Dein Status'"/>
                </form>
            </div>
        </div>
    </div>
</body>
</html>