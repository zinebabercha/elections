<?php
$DSN = 'mysql:host=localhost;dbname=politico';
try{
    $ConnectingDB = new PDO($DSN,'root','');
    $ConnectingDB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
    echo "Connection failed : ". $e->getMessage();
}
?>