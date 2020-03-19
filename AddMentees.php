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
$menteeid = $_POST['menteeid'];

if (empty($meetid) || empty($menteeid)) {
    echo("Meet ID and Mentee ID cannot be empty.<br>");
}
else {
    $menteesquery = "SELECT mentee_id from mentees WHERE mentee_id = '{$menteeid}'";
    $menteesresult = mysqli_query($myconnection, $menteesquery)
    or die ('Query failed: ' . mysqli_error($myconnection));
    $mentees = mysqli_fetch_array($menteesresult, MYSQLI_ASSOC);
    if (empty($mentees)) {
        echo "This is not a mentee. :/";
    }
    else {
        // insert statement
        $insert = "INSERT INTO enroll (meet_id, mentee_id) VALUES (?, ?)";

        $insertstmt = $myconnection->prepare($insert);
        $insertstmt->bind_param("ii", $meetid, $menteeid);

        if ($insertstmt->execute() === TRUE) {
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