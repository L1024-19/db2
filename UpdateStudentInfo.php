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

<form action="UpdateStudentMethod.php" method="post">
    <table>
        <tr>
            <td>
                Old Student Email:
            </td>
            <td>
                <input type="text" name="oldemail"/>
            </td>
        </tr>
        <tr>
            <td>
                New Student Email:
            </td>
            <td>
                <input type="text" name="newemail"/>
            </td>
        </tr>
        <tr>
            <td>
                Old Student Password:
            </td>
            <td>
                <input type="text" name="oldpassword"/>
            </td>
        </tr>
        <tr>
            <td>
                New Student Password:
            </td>
            <td>
                <input type="text" name="newpassword"/>
            </td>
        </tr>
        <tr>
            <td>
                New Student Name:
            </td>
            <td>
                <input type="text" name="newstudentname"/>
            </td>
        </tr>
        <tr>
            <td>
                New Student Phone:
            </td>
            <td>
                <input type="text" name="newphone"/>
            </td>
        </tr>
        <tr>
            <td>
                New Student Grade:
            </td>
            <td>
                <select name="newgrade">
                    <option value="6" selected>6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                </select>        
            </td>
        </tr>
        <tr>
            <td>
                New Student Role:
            </td>
            <td>
                <select name="newrole">
                    <option value="no" selected>No</option>
                    <option value="mentor">Mentor</option>
                    <option value="mentee">Mentee</option>
                    <option value="both">Both</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>
                <input type="submit" value="Submit"/>
            </td>
        </tr>
    </table>
</form>