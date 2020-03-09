<?php
// Put this code at the top of any "protected" page that we create

// Start first
session_start();

if (isset($_SESSION['user_id'])) {
    // Grab user data from the database using the user_id
    // Let them access the "logged in only" pages
} else {
    // Redirect them to the login page
    header("Location: Homepage.html");
}
?>
<form action="UpdateParentMethod.php" method="post">
    <table>
        <tr>
            <td>
                Email:
            </td>
            <td>
                <input type="text" name="email"/>
            </td>
        </tr>
        <tr>
            <td>
            Password:
            </td>
            <td>
                <input type="text" name="password"/>
            </td>
        </tr>
        <tr>
            <td>
                Name:
            </td>
            <td>
                <input type="text" name="name"/>
            </td>
        </tr>
        <tr>
            <td>
                Phone:
            </td>
            <td>
                <input type="text" name="phone"/>
            </td>
        </tr>
        <tr>
            <td>
                <input type="submit" value="Submit"/>
            </td>
        </tr>
    </table>
</form>