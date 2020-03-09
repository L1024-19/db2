<?php
    // sql connection
    $myconnection = mysqli_connect('localhost', 'root', '', 'db2') 
    or die ('Could not connect: ' . mysqli_error($myconnection));

    // input variables
    $email = $_POST['email'];
    $password = $_POST['password'];
    $name = $_POST['studentname'];
    $phone = $_POST['phone'];
    $parentemail = $_POST['parentemail'];
    $grade = $_POST['grade'];
    $role = $_POST['role'];

    // get all emails
    $emailselect = "SELECT DISTINCT email FROM users WHERE email = '$parentemail'";
    $emailresult = mysqli_query($myconnection, $emailselect)
    or die ('Query failed: ' . mysqli_error($myconnection));

    $row = mysqli_fetch_array ($emailresult, MYSQLI_ASSOC);

    // insert into users
    if (!empty($_POST['parentemail']) && $row != NULL && $row["email"] == $parentemail) {
        
        // insert into users
        $insert = "INSERT INTO users (email, password, name, phone) VALUES (?, ?, ?, ?)";

        $insertstmt = $myconnection->prepare($insert);
        $insertstmt->bind_param("ssss", $email, $password, $name, $phone);

        if (empty($_POST['email']) || empty($_POST['password']) || empty($_POST['studentname'])) {
            echo 'Email, Password, and Student Name cannot be empty.<br>';
        }
        else if ($insertstmt->execute() === TRUE) {
            echo 'Inserted<br>';
        }
        else {
            echo 'Not inserted<br>';
        }

        // insert into students

        $parentidselect = "SELECT id FROM users WHERE email = '$parentemail'";
        $parentidresult = mysqli_query($myconnection, $parentidselect)
        or die ('Query failed: ' . mysqli_error($myconnection));
        $parentidarray = mysqli_fetch_array ($parentidresult, MYSQLI_ASSOC);
        $parentid = $parentidarray['id'];

        $studentidselect = "SELECT id FROM users WHERE email = '$email'";
        $studentidresult = mysqli_query($myconnection, $studentidselect)
        or die ('Query failed: ' . mysqli_error($myconnection));
        $studentidarray = mysqli_fetch_array ($studentidresult, MYSQLI_ASSOC);
        $studentid = $studentidarray['id'];

        $insertintostudents = "INSERT INTO students (student_id, grade, parent_id) 
        VALUES ($studentid, $grade, $parentid)";

        if (mysqli_query($myconnection, $insertintostudents)) {
            echo "New record created successfully<br>";
        }
        else {
            // echo("Error description: " . mysqli_error($myconnection));
            echo("The email entered in the parent email field is not a parent.<br>");
        }

        // insert into mentees/mentors
        $insertintomentees = "INSERT INTO mentees (mentee_id) VALUES ($studentid)";
        $insertintomentors = "INSERT INTO mentors (mentor_id) VALUES ($studentid)";
        if ($role == "both") {
            mysqli_query($myconnection, $insertintomentors);
            mysqli_query($myconnection, $insertintomentees);
            echo("Insert both<br>");
        }
        else if ($role == "mentor") {
            mysqli_query($myconnection, $insertintomentors);
            echo("Insert mentor<br>");
        }
        else if ($role == "mentee") {
            mysqli_query($myconnection, $insertintomentees);
            echo("Insert mentee<br>");
        }
        else {
            echo("Did not insert role<br>");
        }
        if ($parentidresult != NULL) {
            mysqli_free_result($parentidresult);
        }
        if ($studentidresult != NULL) {
            mysqli_free_result($studentidresult);
        }
    }
    else {
        echo 'Parent Email cannot be empty.<br>';
    }

    // free the object
    if ($emailresult != NULL) {
        mysqli_free_result($emailresult);
    }

    // close connection
    mysqli_close($myconnection);

?>
