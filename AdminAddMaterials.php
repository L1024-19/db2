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
    <title>Add Materials Page</title>
</head>
<body>
    <h2>
        Add Materials Page
    </h2>
    <form action="AddMaterials.php" method="post">
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
                    Title:
                </td>
                <td>
                    <input type="text" name="title"/>
                </td>
            </tr>
            <tr>
                <td>
                    Author:
                </td>
                <td>
                    <input type="text" name="author"/>
                </td>
            </tr>
            <tr>
                <td>
                    Type:
                </td>
                <td>
                    <input type="text" name="type"/>
                </td>
            </tr>
            <tr>
                <td>
                    URL:
                </td>
                <td>
                    <input type="text" name="url"/>
                </td>
            </tr>
            <tr>
                <td>
                    Assigned Date:
                </td>
                <td>
                    <input type="text" name="assigneddate"/>
                </td>
            </tr>
            <tr>
                <td>
                    Notes:
                </td>
                <td>
                    <input type="text" name="notes"/>
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