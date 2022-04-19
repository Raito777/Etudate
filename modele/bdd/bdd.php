
<?php

function getBdd(){

    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'etudate';

    $bdd = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $bdd->exec("SET CHARACTER SET utf8");
    $bdd->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

    return $bdd;
}

?>