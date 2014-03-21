<?php 
// Database connection
mysql_connect("host", "user", "pass") or die("Error connecting to the database.");
mysql_select_db("network");
// Login process
$email = $_POST['email'];
$password = $_POST['password'];
if($email != "" AND $password != ""){
    $email = mysql_real_escape_string($email);
    $password =md5($password);
    // Extract data from database
    $selectUserData = mysql_query("SELCT * FROM user WHERE email = '{$email}'");
    // The user exists at all
        if(mysql_num_rows($selectUserData) > 0){
            $dbData = mysql_fetch_assoc($selectUserData);
            if($dbData['password'] == $password){
                $userip = $_SERVER['REMOTE_ADDR'];
                $userid = $dbData['id'];
                $insert = mysql_query("INSERT INTO loginlog VALUES('','{$userid}','{$userip}')");
                $_SESSION['userid'] = $userid;
                // Weiterleitung
                    $host = $_SERVER['HTTP_HOST'];
                    $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
                    header("Location: http://$host$uri/home.html");
                    exit;  
            }
            else{
                $output = "Incorrect password."
            }
        }
        else{
            $output = "The user does not exist.";
        }
    else{
        $output = "Please fill out all fields."
    }    
}

echo $output;
?>