<?php
//set database details
define('DB_SERVER','localhost');
define('DB_USER','root');
define('DB_PASSWORD','');
define('DB_NAME','id20625889_kamaldiriye');
//establish connection using database details
$connection = new mysqli(DB_SERVER,DB_USER,DB_PASSWORD,DB_NAME);

//check if any error in database connection. if yes then display errors.
if($connection->connect_errno)
{
    exit('Database connection failed. Reason:'.$connection->connect_errno);
}
?>