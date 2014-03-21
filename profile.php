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
if(isset($_POST['pinnwand']) AND $_POST['pinnwand'] != "" AND $_POST['pinnwand'] !="Dein Status"){
    date_default_timezone_set("Europe/Berlin");
    $date = date("Y-m-d H:i:s");
    $pw = mysql_real_escape_string($_POST['pinnwand']);
    $uid = mysql_real_escape_string($_SESSION['userid']);
    require('config.php');
    $insert = mysql_query("INSERT INTO pinnwand VALUES('{$pw}', '{$uid}', '{$date}')");
}
if(isset($_GET['p'])){
    require('config.php');
    $p = mysql_real_escape_string($_GET['p']);
    $selcte_user_info =  mysql_query("SELECT FROM user WHERE id = {$p}");
    if(mysql_num_rows($selcte_user_info) != 0){
        $user_data = mysql_fetch_assoc($selcte_user_info);
        $name = $user_data['prename'] ." " .$user_data['lastname'];
        if($_SESSION['userid'] != $p){
            $is_friendship = mysql_query("SELECT * FROM frindship WHERE (firstid = {$_SESSION['userid']} OR secondid = {$_SESSION['userid']}) AND (firstid = {$p} OR secondid = {$p})");
            if(mysql_num_rows($is_friendship) != 0){
                $isfriend = mysql_fetch_assoc($is_friendship);
                if($isfriend['confired'] == 1){
                    $frindlink = '<span style="float: right;"><a href="#">Ihr seid Freunde</a></span>';    
                }
                else{
                    $frindlink = '<span style="float: right;"><a href="#">Freundschaftsanfrage versendet</a></span>';    
                }
            }
            else{
                $frindlink = '<span style="float: right;"><a href="frind.php?p=' .$p .'">Freunde werden</a></span>';
            }    
        }
        else{
            $frindlink = '';
        }
    }
    else{
        $name = "Das Profil ist nicht vorhanden."
    }    
}

?>
<html>
<head>
    <link href="style.css" rel="Stylesheet" type="text/css" media="screen"/>
</head>
<body>
    <div id="root">
        <div id="logo"></div>
        <div id="sub-navi"></div>
        <div id="content" style="background-image: none;">
            <div id="main-content" style="width: 990px;">
                <h2><?php echo $name; ?></h2><?php echo $frindlink; ?>
                    <form action="home.php" method="post">
                        <input type="text" value="Dein Status" name="Pinnwand" style="width:100%;" onfocus="if(this.value == 'Dein Status') this.value = ''" onblur="if(this.value == '') this.value = 'Dein Status'"/>
                    </form>
            </div>
        </div>
    </div>
</body>
</html>