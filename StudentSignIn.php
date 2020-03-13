<?php

// Always start this first
session_start();

if (!empty($_POST)) {
    if (isset($_POST['studentemail']) && isset($_POST['studentpassword'])) {
        // Getting submitted user data from database
        $myconnection = new mysqli('localhost', 'root', '', 'db2');
        $stmt = $myconnection->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param('s', $_POST['studentemail']);
        $stmt->execute();
        $result = $stmt->get_result();
    	$user = $result->fetch_object();

    	// Verify user password and set $_SESSION
    	if (password_verify($_POST['studentpassword'], $user->password)) {
            $_SESSION['user_id'] = $user->id;
            header('Location: StudentSetting.html');
        }
        else {
            echo("Something went wrong");
        }
    }
}
?>
