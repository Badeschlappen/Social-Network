/**
 * Shows the status page.
 *
 * @author		Patrick B
 * @copyright 	2014 [CC BY-NC-SA 3.0 <http://creativecommons.org/licenses/by-nc-sa/3.0/deed>] All Rights Reserved.
 * @package		com.mgc.social-network
 *
 **/

<?php
//Datenbankverbindung
mysql_connect("localhost", "user", "pass1") or die("Fehler bei der Verbindung mit der Datenbank.");
mysql_select_db("network");
//Loginprozess
$email = $_POST['email'];
$password = $_POST['password'];
if($email != "" AND $password != "") {
    $email = mysql_real_escape_string($email);
    $password = md5($password);
    //Daten aus Datenbank holen
    $selectUserData = mysql_query("SELECT * FROM user WHERE email = '{$email}'");
    if(mysql_num_rows($selectUserData) > 0){
        //Aufarbeiten der Datenbankwerte
        $dbData = mysql_fetch_assoc($selectUserData);
        if($dbData['password'] == $password){
            $userip = $_SERVER['REMOTE_ADDR'];
            $userid = $dbData['id'];
            $insert = mysql_query("INSERT INTO loginlog VALUES ('', '{$userid}','{$userip}')");
            $_SESSION['userid'] = $userid;
            //Weiterleitung
            $host = $_SERVER['HTTP_HOST'];
            $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
            header("Location: http://$host$uri/home.html");
            exit;
        }
        else{
            $output = "Falsches Passwort.";
        }    
    }
    else{
        $output = "Der Benutzer ist nicht vorhanden.";
    }
}
else{
    $output = "Bitte f&uuml;llen Sie alle Felder aus.";
}
echo $output;
?>