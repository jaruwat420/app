


<?php
$dbHost = 'localhost';
$dbUser = 'root';
$dbPass = '';
$dbName = 'shoponline';
$conn = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName) or die('MySQl connectfail...' . mysqli_error($connect));

//select database
if (!$conn) {
    echo "connect fail";
}





?>