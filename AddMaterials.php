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
$title = $_POST['title'];
$author = $_POST['author'];
$type = $_POST['type'];
$url = $_POST['url'];
$assigneddate = $_POST['assigneddate'];
$notes = $_POST['notes'];

if (empty($meetid) || empty($title) || empty($type) || empty($assigneddate)) {
    echo("Meet ID, Title, Type, and Assigned Date cannot be empty.<br>");
}
else {
    $meetingsquery = "SELECT meet_id from meetings WHERE meet_id = '{$meetid}'";
    $meetingsresult = mysqli_query($myconnection, $meetingsquery)
    or die ('Query failed: ' . mysqli_error($myconnection));
    $meetings = mysqli_fetch_array($meetingsresult, MYSQLI_ASSOC);
    if (empty($meetings)) {
        echo "This is not a valid Meeting ID. :/";
    }
    else {
        // insert material statement
        $insertmaterial = "INSERT INTO material (title, author, type, url, assigned_date, notes)".
        " VALUES (?, ?, ?, ?, ?, ?)";
        $insertmaterialstmt = $myconnection->prepare($insertmaterial);
        $insertmaterialstmt->bind_param("ssssss", $title, $author, $type, $url, $assigneddate, $notes);

        if ($insertmaterialstmt->execute() === TRUE) {
            echo("Inserted into Material<br>");
        }
        else {
            echo($myconnection->error."<br>");
            echo("Not inserted<br>");
        }
        $materialid = $insertmaterialstmt->insert_id;
        // insert assign statement
        $insertassign = "INSERT INTO assign (meet_id, material_id) VALUES (?, ?)";
        $insertassignstmt = $myconnection->prepare($insertassign);
        $insertassignstmt->bind_param("ii", $meetid, $materialid);

        if ($insertassignstmt->execute() === TRUE) {
            echo("Inserted into Assign<br>");
        }
        else {
            echo($myconnection->error."<br>");
            echo("Not inserted<br>");
        }
    }
}
// close connection
mysqli_close($myconnection);
?>