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
    <p><a href="StudentDashboard.html">Student Dashboard </a>
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
        <td><a href="StudentSection.html">View Sections</td>
      </tr>
      <tr>
        <td>Mentor</td>
        <td>Mentor</td>
        <td><a href="MentorList.html">View Mentor</td>
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
          <th>Section Name</th>
          <th>Session Name</th>
          <th>Session Date</th>
          <th>Participate Mentee Count</th>
          <th>Participate/Cancel</th>
        </tr>
        <tr>
          <td name="MentorRole">
            <!--MentorRrole = "Mentor"-->
          </td>
          <td name="MentorCName">
            <!--MentorCName = "Database II"-->
          </td>
          <td name="MentorStName">
            <!--MentorStName = "201"-->
          </td>
          <td name="MentorSsName">
            <!--MentorSsName = "201-5"-->
          </td>
          <td ="MentorSDate">
            <!--MentorSDate = "2020-01-21 ~ 2020-05-09"-->
          </td>
          <td name="MentorCount">
            <!--MentorCount = "N/A" -->
          </td>
          <td>
              <select name="MentorParticipation">
                  <option value="MentorParticipate" selected>Participate</option>
                  <option value="MentorDecline">Decline</option>
                  <input type="submit" value="Submit"/>
              </select>
          </td>
        </tr>
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
