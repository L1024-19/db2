<?php

// Always start this first
session_start();

if (!empty($_POST)) {
    if (empty($_POST['adminemail']) || empty($_POST['adminpassword'])) {
        echo "Fields cannot be left blank.<br>";
    }
    else if (isset($_POST['adminemail']) && isset($_POST['adminpassword'])) {
        // Getting submitted user data from database
        $myconnection = new mysqli('localhost', 'root', '', 'db2');
        $stmt = $myconnection->prepare("SELECT id, email, password FROM admins, users WHERE email = ? ".
        "AND admins.admin_id = users.id");
        $stmt->bind_param('s', $_POST['adminemail']);
        $stmt->execute();
        $result = $stmt->get_result();
    	$user = $result->fetch_object();

    	// Verify user password and set $_SESSION
    	if ($user != NULL && $_POST['adminpassword'] == $user->password) {
            $_SESSION['user_id'] = $user->id;
            header('Location: AdminDashboard.php');
        }
        else {
            echo("Either Email or Password is incorrect.");
        }
    }
}
?>