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

<!doctype html>
<html lang="en">
<head>
    <title>Add Mentees Page</title>
</head>
<body>
    <h2>
        Add Mentees Page
    </h2>
    <form action="AddMentees.php" method="post">
        <table>
            <tr>
                <td>
                    Meet ID:
                </td>
                <td>
                    <input type="text" name="meetid"/>
                </td>
            </tr>
            <tr>
                <td>
                    Mentee ID:
                </td>
                <td>
                    <input type="text" name="menteeid"/>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="submit" value="Submit"/>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>