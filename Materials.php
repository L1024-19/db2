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
  <title>Materials</title>
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
    <h2>Materials</h2>
    <table style="width:100%">
    <tr>
      <th>Title</th>
      <th>Author</th>
      <th>Type</th>
      <th>URL</th>
      <th>Assigned Date</th>
      <th>Notes</th>
    </tr>
    <?php
    // Grab user data from the database using the user_id
    // Let them access the "logged in only" pages
    $myconnection = mysqli_connect('localhost', 'root', '', 'db2') 
    or die ('Could not connect: ' . mysqli_error($myconnection));

    $materialidquery = "SELECT material_id from assign WHERE meet_id = '{$_GET['key']}'";
    $materialidresult = mysqli_query($myconnection, $materialidquery)
    or die ('Query failed: ' . mysqli_error($myconnection));
    while ($materialid = mysqli_fetch_array($materialidresult, MYSQLI_ASSOC)) {    
    $materialinfoquery = "SELECT * from material WHERE material_id = '{$materialid['material_id']}'";
        $materialinforesult = mysqli_query($myconnection, $materialinfoquery);
        $materialinfo = mysqli_fetch_array($materialinforesult, MYSQLI_ASSOC);
        echo("<tr>");
        echo("<td>".$materialinfo['title']."</td>");
        echo("<td>".$materialinfo['author']."</td>");
        echo("<td>".$materialinfo['type']."</td>");
        echo("<td>".$materialinfo['url']."</td>");
        echo("<td>".$materialinfo['assigned_date']."</td>");
        echo("<td>".$materialinfo['notes']."</td>");
        echo("</tr>");
    }

    mysqli_close($myconnection);
    ?>
    </table>
</body>