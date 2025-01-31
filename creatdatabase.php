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

//  $SQL = "CREATE TABLE IF NOT EXISTS users (
//    id INT AUTO_INCREMENT PRIMARY KEY,  
//    username VARCHAR(100) NOT NULL UNIQUE,  
//    password VARCHAR(100) NOT NULL, 
//    name VARCHAR(100) NOT NULL, 
//    family VARCHAR(100) NOT NULL, 
//    isadmin TINYINT(1) DEFAULT 0 
//  )";





// $SQL = "CREATE TABLE IF NOT EXISTS news (
//    category VARCHAR(100) NOT NULL,
//    id INT AUTO_INCREMENT PRIMARY KEY,          
//    title VARCHAR(255) NOT NULL,                
//    image VARCHAR(255) NOT NULL,                
//    newstext TEXT NOT NULL,                      
//    share TINYINT(1) DEFAULT 0,                  
//    user_id INT NOT NULL,                         
//    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, 
//    FOREIGN KEY (user_id) REFERENCES users(id) 
// )";



mysqli_query($link, $SQL);

?>
