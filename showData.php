<?php require('library/database.php'); ?>



<?php
$sql = "SELECT * FROM tbl_user";
$result = mysqli_query($connect, $sql);
$row = mysqli_fetch_array($result);
echo $row["user_name"]
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="container">
        <label for="">name</label>
    </div>
</body>

</html>