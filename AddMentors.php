<?php
// Put this code at the top of any "protected" page that we create

// Start first
session_start();
if (isset($_SESSION['user_id'])) {
    // Grab user data from the database using the user_id
    // Let them access the "logged in only" pages
}
else {
    // Redirect them to the login page
    header("Location: Homepage.html");
}
?>

<?php
// sql connection
$myconnection = mysqli_connect('localhost', 'root', '', 'db2') 
or die ('Could not connect: ' . mysqli_error($myconnection));

// variables
$meetid = $_POST['meetid'];
$mentorid = $_POST['mentorid'];

if (empty($meetid) || empty($mentorid)) {
    echo("Meet ID and Mentor ID cannot be empty.<br>");
}
else {
    $mentorsquery = "SELECT mentor_id from mentors WHERE mentor_id = '{$mentorid}'";
    $mentorsresult = mysqli_query($myconnection, $mentorsquery)
    or die ('Query failed: ' . mysqli_error($myconnection));
    $mentors = mysqli_fetch_array($mentorsresult, MYSQLI_ASSOC);
    if (empty($mentors)) {
        echo "This is not a mentor. :/";
    }
    else {
        // insert statement
        $insert = "INSERT INTO enroll2 (meet_id, mentor_id) VALUES (?, ?)";

        $insertstmt = $myconnection->prepare($insert);
        $insertstmt->bind_param("ii", $meetid, $mentorid);

        if (empty($meetid) || empty($mentorid)) {
            echo("Meet ID and Mentor ID cannot be empty.<br>");
        }
        else if ($insertstmt->execute() === TRUE) {
            echo("Inserted<br>");
        }
        else {
            echo("Not inserted<br>");
        }
    }
}
// close connection
mysqli_close($myconnection);
?>