<?php
// creat database
// $link = mysqli_connect('localhost:3306','root','');
// $sql = 'CREATE DATABASE NEWS';
// mysqli_query($link,$sql);
// mysqli_close($link);

$link = mysqli_connect('localhost:3306','root','');



//if (!$link) {
//    echo 'Could not connect: ' . mysqli_connect_error();
//    exit;
//}

//echo 'Connected';


mysqli_select_db($link, 'NEWS');

$SQL = "CREATE TABLE IF NOT EXISTS users (
   id INT AUTO_INCREMENT,
    username VARCHAR(100) NOT NULL,
   password VARCHAR(100) NOT NULL,
    name VARCHAR(100) NOT NULL,
   family VARCHAR(100) NOT NULL,
   PRIMARY KEY (id)
)";

mysqli_query($link, $SQL);

?>
