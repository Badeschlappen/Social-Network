<?php
// Variablen deklarieren
$prename = $_POST['prename'];
$lastname = $_POST['lastname'];
$email = $_POST['mail'];
$password = $_POST['password'];
    if($prename != "" AND $lastname != "" AND $email != "" AND $password != ""){
        //Überprüfen, ob Password und E-Mail Adresse überein stimmen
        if($email == $_POST['rmail']){
            //Überprüfen ob Name Korrekt
            if($password == $_POST['rpassword']){
                $zeichen = "!&$%()/\?=1234567890{}[]<>|,;:._^^^^+#'";
                $pospn = strpos($prename, $zeichen);
                $posln = strpos($lastname, $zeichen);
                if($pospn === false AND $posln === false){
                    $posm1 = strpos($email, "@");
                    $posm2 = strpos($email, ".");
                    if($posm2 != "" AND $posm1 != ""){
                        //Sciherheit
                        $prename = htmlspecialchars($prename);
                        $prename = mysql_real_escape_string($prename);
                        $prename = htmlentities($prename);
                        $lastname = htmlspecialchars($lastname);
                        $lastname = mysql_real_escape_string($lastname);
                        $lastname = htmlentities($lastname);
                        $email = htmlspecialchars($email);
                        $email = mysql_real_escape_string($email);
                        $email = htmlentities($email);
                        $password = md5($password);
                        //Verbindung mit der Datenbank
                        mysql_connect("host", "user", "pass") or die("Fehler bei der Verbindung mit der Datenbank.");
                        mysql_select_db("network");
                        //Überprüfen, ob E-Mail schon vorhanden
                        $selectEmail = mysql_query("SELECT * FROM user WHERE email = '{$email}'");
                        if(mysql_num_rows($selectEmail) ==0){
                            $insertData = mysql_query("INSERT INTO user VALUES ('' , '{$prename}', '{$lastname}', '$email}', '{$password}')");
                        }
                        else{
                            $output = "Die E-Mail Adresse wurde bereits verwendet.";
                        }    
                    }
                    else{
                        $output = "E-Mail Aresse nicht korrekt.";
                    }
                }
                else{
                    $output = "Ihr Name kann nicht korrekt sind. Bitte &auml;ndern sie diesen.";
                }
                else{
                    $output = "Die E-Mail Adressen stimmen nicht &uuml;berein.";
                }
            }
            else{
                $output = "Die E-Mail Adressen stimmen nicht &uuml;berein.";
            }
        }
        else{
            $output = "Bitte f&uuml;llen sie alle Felder aus.";
        }
    }
echo $output;
?>