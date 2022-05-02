<?php require('./library/database.php'); ?>
<?php

session_start();

if (isset($_POST['uname']) && (isset($_POST['password']))) {

    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $uname = validate($_POST['uname']);
    $pass = validate($_POST['password']);

    if (empty($uname)) {
        header("location:index.php?error= user Name is required ");
        exit();
    } else if (empty($pass)) {
        header("location:index.php?error= password is required ");
        exit();
    } else {
        $sql = "SELECT * FROM tbl_user WHERE user_name ='$uname' AND user_password ='$pass'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            if ($row['user_name'] === $uname && $row['user_password'] === $pass) {
                $_SESSION['user_name'] = $row['user_name'];
                $_SESSION['user_regdate'] = $row['user_regdate'];
                $_SESSION['user_id'] = $row['user_id'];
                header("location:home.php");
                exit();
            } else {
                header("location:index.php?error= user Name is required ");
                exit();
            }
        } else {
            header("location:index.php?error=incorect user name or password");
            exit();
        }
    }
} else {
    header("location:index.php ");
    exit();
}
