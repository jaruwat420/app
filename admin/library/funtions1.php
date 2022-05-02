<?php
require('library/database.php');
/*
	Check if a session user id exist or not. If not set redirect
	to login page. If the user session id exist and there's found
	$_GET['logout'] in the query string logout the user
*/
function checkAdminUser()
{
    // ถ้าไม่มีการกำหนดค่า session id ก็จะ Redirect ไปยังหน้า Login อีกครั้ง
    if (!isset($_SESSION['plaincart_user_id'])) {
        header('Location: ' . WEB_ROOT . 'admin/login.php');
        exit;
    }

    // ถ้าผู้ใช้ต้องการ logout
    if (isset($_GET['logout'])) {
        doLogout();
    }
}
function doLogin()
{
    // ถ้าพบ error ก็จะถูกเซฟลงใน array() ที่ชื่อว่า $errorMessage
    $errorMessage = '';

    //รับค่า Username และ Password มาจากแบบฟอร์มล็อกอิน
    $userName = $_POST['txtUserName'];
    $password = $_POST['txtPassword'];
    //เข้ารหัส password ด้วยฟังก์ชัน md5() 
    $hashPassword = md5($password . SECRET_KEY);

    // ประการแรกตรวจสอบให้แน่ใจว่า username & password ไม่เป็นอะไรที่ว่างๆ
    if ($userName == '') {
        $errorMessage = 'You must enter your username';
    } else if ($password == '') {
        $errorMessage = 'You must enter the password';
    } else {
        //ตรวจสอบฐานข้อมูลดูว่า username และ password ถูกต้องตรงกันหรือไม่ 
        //และต้องมีฐานะเป็น admin โดยดูจาก user_role= 'admin'
        $sql = "SELECT user_id
		        FROM tbl_user 
				WHERE user_name = '$userName' AND user_password = '$hashPassword' AND user_role = 'admin' ";
        mysqli_query($sql);

        if (dbNumRows($result) == 1) {
            $row = dbFetchAssoc($result);
            $_SESSION['plaincart_user_id'] = $row['user_id'];

            // อัพเดท เวลาล็อคอิน ว่าได้มีการล็อคอินครั้งสุดท้ายเมื่อใด
            $sql = "UPDATE tbl_user 
			        SET user_last_login = NOW() 
					WHERE user_id = '{$row['user_id']}'";
            dbQuery($sql);

            // ถ้าผู้ใช้ที่ล็อคอินในปัจจุปัน ถูกยืนยันชื่อและรหัสผ่านถูกต้อง ก็จะไปยังหน้าถัดไป
            // ถ้าเคยเข้ามามายังส่วนของ Admin แล้ว
            // ให้ไปยังเว็บเพจหน้าสุดท้ายที่เคยเยี่ยมชม
            if (isset($_SESSION['login_return_url'])) {
                header('Location: ' . $_SESSION['login_return_url']);
                exit;
            } else {
                header('Location: index.php');
                exit;
            }
        } else {
            $errorMessage = 'Wrong username or password or don\'t have permission';
        }
    }

    return $errorMessage;
}
