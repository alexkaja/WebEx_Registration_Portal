<?php
    require("config.php");
    if(!empty($_POST))
    {
        // Ensure that the user fills out fields
        if(empty($_POST['username']))
        { die("Please enter a username."); }
        if(empty($_POST['fname']))
        { die("Please enter a first name."); }
        if(empty($_POST['lname']))
        { die("Please enter a last name."); }
        if(empty($_POST['password']))
        { die("Please enter a password."); }
        if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
        { die("Invalid E-Mail Address"); }

        // Check if the username is already taken
        $query = "
            SELECT
                1
            FROM users
            WHERE
                username = :username
        ";
        $query_params = array( ':username' => $_POST['username'] );
        try {
            $stmt = $db->prepare($query);
            $result = $stmt->execute($query_params);
        }
        catch(PDOException $ex){ die("Failed to run query: " . $ex->getMessage()); }
        $row = $stmt->fetch();
        if($row){ die("This username is already in use"); }
        $query = "
            SELECT
                1
            FROM users
            WHERE
                email = :email
        ";
        $query_params = array(
            ':email' => $_POST['email']
        );
        try {
            $stmt = $db->prepare($query);
            $result = $stmt->execute($query_params);
        }
        catch(PDOException $ex){ die("Failed to run query: " . $ex->getMessage());}
        $row = $stmt->fetch();
        if($row){ die("This email address is already registered"); }

        // Add row to database
        $query = "
            INSERT INTO users (
                username,
                fname,
                lname,
                password,
                salt,
                email
            ) VALUES (
                :username,
                :fname,
                :lname,
                :password,
                :salt,
                :email
            )
        ";

        // Security measures
        $salt = dechex(mt_rand(0, 2147483647)) . dechex(mt_rand(0, 2147483647));
        $password = hash('sha256', $_POST['password'] . $salt);
        for($round = 0; $round < 65536; $round++){ $password = hash('sha256', $password . $salt); }
        $query_params = array(
            ':username' => $_POST['username'],
            ':fname' => $_POST['fname'],
            ':lname' => $_POST['lname'],
            ':password' => $password,
            ':salt' => $salt,
            ':email' => $_POST['email']
        );
        try {
            $stmt = $db->prepare($query);
            $result = $stmt->execute($query_params);
        }
        catch(PDOException $ex){ die("Failed to run query: " . $ex->getMessage()); }
        header("Location: index.php");
        die("Redirecting to index.php");
    }
?>

<form action="register.php" method="post">
    <label>Username:</label>
    <input type="text" name="username" value="" /><br>
    <label>first name:</label>
    <input type="text" name="fname" value="" /><br>
    <label>Last name:</label>
    <input type="text" name="lname" value="" /><br>
    <label>Email:</label>
    <input type="text" name="email" value="" /><br>
    <label>Password:</label>
    <input type="password" name="password" value="" /> <br /><br />
    <input type="submit" class="btn btn-info" value="Register" />
</form>
