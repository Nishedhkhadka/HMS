<!DOCTYPE html>
<?php #include("func.php");
?>
<html>

<head>
  <title>Patient Details</title>
  <link rel="shortcut icon" type="image/x-icon" href="images/favicon.png" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
</head>

<body style='background:-webkit-linear-gradient(left,#522258,#D95F59);'>
  <?php
  include("newfunc.php");
  if (isset($_POST['patient_search_submit'])) {
    $contact = $_POST['patient_contact'];
    $query = "select * from patreg where contact= '$contact'";
    $result = mysqli_query($con, $query);
    if (!$result) {
      die("Query failed: " . mysqli_error($con)); // Debug query issues
    }

    if (mysqli_num_rows($result) > 0) {
      $row = mysqli_fetch_array($result);
      if ($row['lname'] == "" & $row['email'] == "" & $row['contact'] == "" & $row['password'] == "") {
        echo "<script> alert('No entries found! Please enter valid details'); 
          window.location.href = 'admin-panel1.php#list-doc';</script>";
      } else {
        echo "<div class='container-fluid' style='margin-top:50px;'>
	<div class='card' style='border:none;'>
	<div class='card-body' style='background:-webkit-linear-gradient(left,#522258,#D95F59);color:#ffffff;'>
<table class='table table-hover'>
  <thead>
    <tr>
      <th scope='col'>First Name</th>
      <th scope='col'>Last Name</th>
      <th scope='col'>Email</th>
      <th scope='col'>Contact</th>
    </tr>
  </thead>
  <tbody>";


        $fname = $row['fname'];
        $lname = $row['lname'];
        $email = $row['email'];
        $contact = $row['contact'];
        echo "<tr>
          <td>$fname</td>
          <td>$lname</td>
          <td>$email</td>
          <td>$contact</td>
        </tr>";

        echo "</tbody></table><center><a href='admin-panel1.php' class='btn btn-light'>Back to dashboard</a></div></center></div></div></div>";
      }
    } else {
      echo "<script>
        alert('No entries found!');
        window.location.href = 'admin-panel1.php#list-doc';
    </script>";
      exit();
    }
  }

  ?>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
</body>

</html>