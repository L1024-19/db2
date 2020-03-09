<?php
    // sql connection
    $myconnection = mysqli_connect('localhost', 'root', '', 'db2') 
    or die ('Could not connect: ' . mysqli_error($myconnection));

    // variables
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);;
    $name = $_POST['name'];
    $phone = $_POST['phone'];

    // insert statement
    $insert = "INSERT INTO users (email, password, name, phone) VALUES (?, ?, ?, ?)";

    $insertstmt = $myconnection->prepare($insert);
    $insertstmt->bind_param("ssss", $email, $password, $name, $phone);

    if (empty($_POST['email']) || empty($_POST['password']) || empty($_POST['name'])) {
        echo("Email, Password, and Name cannot be empty.<br>");
    }
    else if ($insertstmt->execute() === TRUE) {
        echo("Inserted<br>");
    }
    else {
        echo("Not inserted<br>");
    }

    $parentidselect = "SELECT id FROM users WHERE email = '$email'";
    $parentidresult = mysqli_query($myconnection, $parentidselect)
    or die ('Query failed: ' . mysqli_error($myconnection));
    $parentidarray = mysqli_fetch_array ($parentidresult, MYSQLI_ASSOC);
    $parentid = $parentidarray['id'];

    $insertintoparents = "INSERT INTO parents (parent_id) VALUES ($parentid)";

    if (mysqli_query($myconnection, $insertintoparents)) {
        echo("Inserted into parents successfully<br>");
    }
    else {
        // echo("Error description: " . mysqli_error($myconnection));
        echo("Inserting into parents unsuccessful<br>");
    } 

    mysqli_free_result($parentidresult);

    header('Location: ParentSignIn.html');

    // close connection
    mysqli_close($myconnection);

?>
