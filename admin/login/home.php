<?php
include('library/database.php');
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['usernam'])) {

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>HOME</title>
    </head>

    <body>
        <h1><?php echo "hello :" . $_SESSION['user_name'] ?></h1>
        <h1><?php echo "ไอดี :" . $_SESSION['id'] ?></h1>
        <h1><?php echo "อายุ :" . $_SESSION['age'] ?></h1>
        <h1><?php echo "อายุ :" . $_SESSION['user_id'] ?></h1>
        <h1><?php echo "อายุ :" . $_SESSION['user_regdate'] ?></h1>

    </body>

    </html>
<?php } else {
    header("Location:index.php");
} ?>