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

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>Section List</title>

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
  <a href="StudentSetting.html">Student Setting</a>
  <h2 style="color:#FF0000" ;>Section List</h2>

  <table style="width:100%">
    <tr>
      <th>Course Title</th>
      <th>Section Name</th>
      <th>Start Date</th>
      <th>End Date</th>
      <th>Time Slot</th>
      <th>Capacity</th>
      <th>Enrolled Mentee</th>
      <th>Enrolled Mentor</th>
      <th>Enroll as Mentee</th>
      <th>Teach as Mentor</th>
    </tr>
    <?php
    $myconnection = mysqli_connect('localhost', 'root', '', 'db2') 
    or die ('Could not connect: ' . mysqli_error($myconnection));
    $meetingsquery = "SELECT meet_id from enroll WHERE mentee_id = '{$_SESSION['user_id']}'";
    $meetingsresult = mysqli_query($myconnection, $meetingsquery)
    or die ('Query failed: ' . mysqli_error($myconnection));
    // while ($meetings = mysqli_fetch_array($meetingsresult, MYSQLI_ASSOC)) {    
    //     echo($meetings["meet_id"]."<br>");
    // }
    $meetinginfoquery = "SELECT * from meetings WHERE meet_id IN (".$meetingsquery.")";
    $meetinginforesult = mysqli_query($myconnection, $meetinginfoquery)
    or die ('Query failed: ' . mysqli_error($myconnection));
    // while ($meetinginfo = mysqli_fetch_array($meetinginforesult, MYSQLI_ASSOC)) {    
    //     echo($meetinginfo["meet_name"]."<br>");
    // }
    $meetinginfowithtimequery = "SELECT * from meetings, time_slot WHERE ".
    "meetings.time_slot_id = time_slot.time_slot_id";
    $meetinginfowithtimeresult = mysqli_query($myconnection, $meetinginfowithtimequery)
    or die ('Query failed: ' . mysqli_error($myconnection));
    while ($meetinginfowithtime = mysqli_fetch_array($meetinginfowithtimeresult, MYSQLI_ASSOC)) {    
        // enrolled mentee query
        $enrolledmenteequery = "SELECT count(mentee_id) as count from enroll WHERE meet_id = '{$meetinginfowithtime['meet_id']}'";
        $enrolledmenteeresult = mysqli_query($myconnection, $enrolledmenteequery)
        or die ('Query failed: ' . mysqli_error($myconnection));
        $enrolledmentee = mysqli_fetch_array($enrolledmenteeresult, MYSQLI_ASSOC);
        // enrolled mentor query
        $enrolledmentorquery = "SELECT count(mentor_id) as count from enroll2 WHERE meet_id = '{$meetinginfowithtime['meet_id']}'";
        $enrolledmentorresult = mysqli_query($myconnection, $enrolledmentorquery)
        or die ('Query failed: ' . mysqli_error($myconnection));
        $enrolledmentor = mysqli_fetch_array($enrolledmentorresult, MYSQLI_ASSOC);
        echo("<tr>");
        echo("<td>".$meetinginfowithtime['meet_name']."</td>");
        echo("<td>"."?"."</td>");
        echo("<td>"."?"."</td>");
        echo("<td>"."?"."</td>");
        echo("<td>".$meetinginfowithtime['day_of_the_week']." ".
        date("g:i a", strtotime($meetinginfowithtime['start_time']))." - ".
        date("g:i a", strtotime($meetinginfowithtime['end_time']))."</td>");
        echo("<td>".(9 - $enrolledmentee['count'] - $enrolledmentor['count'])."</td>");
        echo("<td>".$enrolledmentee['count']."</td>");
        echo("<td>".$enrolledmentor['count']."</td>");
        if ($enrolledmentee['count'] < 6) {
            echo("<td>"."<a href=''>Enroll</a>"."</td>");
        }
        else {

        }
        if ($enrolledmentor['count'] < 3) {
            echo("<td>"."<a href=''>Teach</a>"."</td>");
        }
        else {

        }
        echo("</tr>");
    }
    ?>
    <tr>
      <td>Database II</td>
      <td>201</td>
      <td>2020-01-21</td>
      <td>2020-05-09</td>
      <td>T 11:00 AM - 12:15 PM</td>
      <td>45</td>
    </tr>

    <tr>
      <td>Algorithm</td>
      <td>203</td>
      <td>2020-01-21</td>
      <td>2020-05-09</td>
      <td>Th 12:30 PM - 13:45 PM</td>
      <td>45</td>
    </tr>

    <tr>
      <td>Artificial Intelligence</td>
      <td>420</td>
      <td>2020-01-21</td>
      <td>2020-05-09</td>
      <td>Th 15:30 PM - 16:45 PM</td>
      <td>38</td>
    </tr>

    <tr>
      <td>Machine Learning</td>
      <td>422</td>
      <td>2020-01-21</td>
      <td>2020-05-09</td>
      <td>W 15:30 PM - 16:45 PM</td>
      <td>49</td>
    </tr>

    <tr>
      <td>Computer Graphics I</td>
      <td>427</td>
      <td>2020-01-21</td>
      <td>2020-05-09</td>
      <td>W 18:30 PM - 21:20 PM</td>
      <td>35</td>
    </tr>

  </table>

</body>

</html>
