<?php
try{

    $db_host = "sql131.main-hosting.eu";//"mysql.hostinger.com.br";

    $db_name = "u406455635_sp";

    $db_user = "u406455635_sp";

    $db_password = "253726867";

    $pdo = new PDO("mysql:host=" . $db_host . ";dbname=" . $db_name . ";charset=utf8", $db_user, $db_password);

    //echo "connection to database success";
    $pdo->prepare("set time_zone = '-03:00'")->execute();
}catch(PDOException $error){

    echo "Error connection to database";

}
?>