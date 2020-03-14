<?php

// Always start this first
session_start();

if (!empty($_POST)) {
    if (empty($_POST['parentemail']) || empty($_POST['parentpassword'])) {
        echo "Fields cannot be left blank.<br>";
    }
    else if (isset($_POST['parentemail']) && isset($_POST['parentpassword'])) {
        // Getting submitted user data from database
        $myconnection = new mysqli('localhost', 'root', '', 'db2');
        $stmt = $myconnection->prepare("SELECT id, email, password FROM parents, users WHERE email = ? ".
        "AND parents.parent_id = users.id");
        $stmt->bind_param('s', $_POST['parentemail']);
        $stmt->execute();
        $result = $stmt->get_result();
    	$user = $result->fetch_object();

    	// Verify user password and set $_SESSION
    	if ($user != NULL && password_verify($_POST['parentpassword'], $user->password)) {
            $_SESSION['user_id'] = $user->id;
            header('Location: ParentDashboard.php');
        }
        else {
            echo("Either Email or Password is incorrect.");
        }
    }
}
?>