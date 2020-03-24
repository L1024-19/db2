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


  <!DOCTYPE html>
  <html lang="en" dir="ltr">

  <head>
    <meta charset="utf-8">
    <title>Student Dashboard</title>

    <style>
      table {
        border: 1px solid black;
        border-collapse: collapse;
      }

      td,
      th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
      }

      tr:nth-child(even) {
        background-color: #dddddd;
      }
    </style>
  </head>

  <body>
    <p><a href="StudentSetting.html">Student Setting</a>
      &emsp;
      <a href="Logout.php">Logout</a>
    </p>


    <h1>Student Information</h1>

    <table style="width:100%">
      <tr>
        <th colspan="2">User Type</th>
        <th>Action</th>
      </tr>

      <tr>
        <td>User</td>
        <td>Profile</td>
        <td><a href="StudentUpdateStudentInfo.php">Change Your Profile</td>
      </tr>
      <tr>
        <td>Student</td>
        <td>Section</td>
        <td><a href="StudentSection.php">View Sections</td>
      </tr>
      <tr>
        <td>Mentor</td>
        <td>Mentor</td>
        <td><a href="MentorList.php">View Mentor</td>
      </tr>
      <tr>
        <td>Mentee</td>
        <td>Mentee</td>
        <td><a href="MenteeList.php">View Mentee</td>
      </tr>
    </table>
    <br>


    <h2 style="color:#FF0000" ;>Mentor Notification For Next Week</h2>
    <form action="MentorNotification.php" method="post">
      <table style="width:100%">
        <tr>
          <th>Role</th>
          <th>Course Name</th>
          <th>Session Number</th>
          <th>Session Date</th>
          <th>Participate Mentee Count</th>
          <th>Participate/Cancel</th>
        </tr>

        <?php
        $myconnection = mysqli_connect('localhost', 'root', '', 'db2')
        or die ('Could not connect: ' . mysqli_error($myconnection));

        $menteequery = "SELECT * from enroll WHERE mentee_id = '{$_SESSION['user_id']}'";
        $menteeresult = mysqli_query($myconnection, $menteequery)
        or die ('Query failed: ' . mysqli_error($myconnection));
        $mentee = mysqli_fetch_array($menteeresult, MYSQLI_ASSOC);

        $menteemeetingquery = "SELECT * from meetings JOIN enroll ON (".
        "meetings.meet_id = enroll.meet_id) WHERE mentee_id = '{$_SESSION['user_id']}'";
        $menteemeetingresult = mysqli_query($myconnection, $menteemeetingquery)
        or die ('Query failed: ' . mysqli_error($myconnection));


        while ($menteemeeting = mysqli_fetch_array($menteemeetingresult, MYSQLI_ASSOC)) {
          // enrolled mentee query
          $enrolledmenteequery = "SELECT count(mentee_id) as count from enroll WHERE meet_id = '{$menteemeeting['meet_id']}'";
          $enrolledmenteeresult = mysqli_query($myconnection, $enrolledmenteequery)
          or die ('Query failed: ' . mysqli_error($myconnection));
          $enrolledmentee = mysqli_fetch_array($enrolledmenteeresult, MYSQLI_ASSOC);

          echo("<tr>");
          echo ("<td>Mentee</td>");
          echo("<td>".$menteemeeting['meet_name']."</td>");
          echo("<td>".$menteemeeting['meet_id']."</td>");
          echo("<td>".$menteemeeting['start_date']."</td>");
          echo("<td>".$enrolledmentee['count']."</td>");

          echo("</tr>");

        }
        ?>
      </table>
    </form>
    <br>

    <h2 style="color:#FF0000" ;>Mentee Notification For Next Week</h2>
    <form action="MenteeNotification.php" method="post">
      <table style="width:100%">
        <tr>
          <th>Role</th>
          <th>Course Name</th>
          <th>Section Name</th>
          <th>Session Name</th>
          <th>Session Date</th>
          <th>Participate Mentee Count</th>
          <th>Participate/Cancel</th>
        </tr>
        <tr>
          <td name="MenteeRole"></td>
          <td name="MenteeCName"></td>
          <td name="MenteeStName"></td>
          <td name="MenteeSsName"></td>
          <td name="MenteeSDate"></td>
          <td name="MenteeCount"></td>
          <td>
              <select name="MentorParticipation">
                  <option value="MenteeParticipate" selected>Participate</option>
                  <option value="MenteeDecline">Decline</option>
              </select>
              <input type="submit" value="Submit"/>
          </td>
        </tr>
      </table>
    </form>

  </body>

  </html>
