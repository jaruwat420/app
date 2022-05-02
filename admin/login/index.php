<?php require('./library/database.php'); ?>

<body>
    <form action="login.php" method="post">
        <h2>login</h2>
        <?php if (isset($_GET['error'])) { ?>
            <p class="error"><?php echo $_GET['error'] ?></p>
        <?php } ?>
        <label>user Name</label>
        <input type="text" name="uname" id="">

        <label>Password</label>
        <input type="password" name="password" id="">

        <button type="submit">Login</button>
    </form>
</body>

</html>