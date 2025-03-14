<!DOCTYPE html>
<?php


$con = mysqli_connect("localhost", "root", "", "myhmsdb");

include('newfunc.php');

if (isset($_POST['docsub'])) {
  $doctor = $_POST['doctor'];
  $dpassword = $_POST['dpassword'];
  $demail = $_POST['demail'];
  $spec = $_POST['special'] ?? '';
  $docFees = $_POST['docFees'];
  $hashed_password = password_hash($dpassword, PASSWORD_BCRYPT);
  $query = "insert into doctb(username,password,email,spec,docFees)values('$doctor','$hashed_password','$demail','$spec','$docFees')";
  $result = mysqli_query($con, $query);
  if ($result) {
    echo "<script>alert('Doctor added successfully!');</script>";
  }
}


if (isset($_POST['docsub1'])) {
  $demail = $_POST['demail'];
  $query = "delete from doctb where email='$demail';";
  $result = mysqli_query($con, $query);
  if ($result) {
    echo "<script>alert('Doctor removed successfully!');</script>";
  } else {
    echo "<script>alert('Unable to delete!');</script>";
  }
}


?>
<html lang="en">

<head>


  <!-- Required meta tags -->
  <meta charset="utf-8">
  <link rel="shortcut icon" type="image/x-icon" href="images/favicon.png" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" type="text/css" href="font-awesome-4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="style.css">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">
  <link href="https://fonts.googleapis.com/css?family=IBM+Plex+Sans&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
  <nav class="navbar navbar-expand-lg navbar-dark bg-c fixed-top">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <a class="navbar-brand" href="#"> Advanced Patient Care Solution </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <script>
      var check = function() {
        if (document.getElementById('dpassword').value ==
          document.getElementById('cdpassword').value) {
          document.getElementById('message').style.color = '#5dd05d';
          document.getElementById('message').innerHTML = 'Matched';
        } else {
          document.getElementById('message').style.color = '#f55252';
          document.getElementById('message').innerHTML = 'Not Matching';
        }
      }

      function alphaOnly(event) {
        var key = event.keyCode;
        return ((key >= 65 && key <= 90) || key == 8 || key == 32);
      };
    </script>

    <style>
      .bg-c {
        background: -webkit-linear-gradient(left, #522258, #D95F59);
      }

      .col-md-4 {
        max-width: 20% !important;
      }

      .list-group-item.active {
        z-index: 2;
        color: #fff;
        background-color: #522258;
        border-color: #522258;
      }

      .text-primary {
        color: #522258 !important;
      }

      #cpass {
        display: -webkit-box;
      }

      #list-app {
        font-size: 15px;
      }

      .btn-primary {
        background-color: #522258;
        border-color: #522258;
      }

      .btn-primary:hover {
        background-color: #D95F59;
        border-color: #D95F59;
      }
    </style>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link" href="logout1.php"><i class="fa fa-sign-out" aria-hidden="true"></i>Logout</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#"></a>
        </li>
      </ul>
    </div>
  </nav>
</head>
<style type="text/css">
  button:hover {
    cursor: pointer;
  }

  #inputbtn:hover {
    cursor: pointer;
  }
</style>

<body style="padding-top:50px;">
  <div class="container-fluid" style="margin-top:50px;">
    <h3 style="margin-left: 40%; padding-bottom: 20px;font-family: 'IBM Plex Sans', sans-serif;"> WELCOME ADMIN </h3>
    <div class="row">
      <div class="col-md-2" style="max-width:15%;margin-top: 3%;">
        <div class="list-group" id="list-tab" role="tablist">
          <a class="list-group-item list-group-item-action active" id="list-dash-list" data-toggle="list" href="#list-dash" role="tab" aria-controls="home">Dashboard</a>
          <a class="list-group-item list-group-item-action" href="#list-doc" id="list-doc-list" role="tab" aria-controls="home" data-toggle="list">Doctor List</a>
          <a class="list-group-item list-group-item-action" href="#list-pat" id="list-pat-list" role="tab" data-toggle="list" aria-controls="home">Patient List</a>
          <a class="list-group-item list-group-item-action" href="#list-app" id="list-app-list" role="tab" data-toggle="list" aria-controls="home">Appointment Details</a>
          <a class="list-group-item list-group-item-action" href="#list-pres" id="list-pres-list" role="tab" data-toggle="list" aria-controls="home">Prescription List</a>
          <a class="list-group-item list-group-item-action" href="#list-settings" id="list-adoc-list" role="tab" data-toggle="list" aria-controls="home">Add Doctor</a>
          <a class="list-group-item list-group-item-action" href="#list-settings1" id="list-ddoc-list" role="tab" data-toggle="list" aria-controls="home">Delete Doctor</a>
          <a class="list-group-item list-group-item-action" href="#list-mes" id="list-mes-list" role="tab" data-toggle="list" aria-controls="home">Queries</a>

        </div><br>
      </div>
      <div class="col-md-8" style="margin-top: 3%;">
        <div class="tab-content" id="nav-tabContent" style="width: 950px;">



          <div class="tab-pane fade show active" id="list-dash" role="tabpanel" aria-labelledby="list-dash-list">
            <div class="container-fluid container-fullw bg-white">
              <div class="row">
                <div class="col-sm-4">
                  <div class="panel panel-white no-radius text-center">
                    <div class="panel-body">
                      <span class="fa-stack fa-2x"> <i class="fa fa-square fa-stack-2x text-primary"></i> <i class="fa fa-users fa-stack-1x fa-inverse"></i> </span>
                      <!-- <h4 class="StepTitle" style="margin-top: 5%;">Doctor List</h4> -->
                      <script>
                        function clickDiv(id) {
                          document.querySelector(id).click();
                        }
                      </script>
                      <p class="links cl-effect-1">
                        <a href="#list-doc" style=" color: black; text-decoration: none;"
                          onmouseover="this.style.color='red'"
                          onmouseout="this.style.color='black'"
                          onclick="clickDiv('#list-doc-list')">
                          <h4 class="StepTitle" style="margin-top: 5%;">Doctor List</h4>
                        </a>
                      </p>
                    </div>
                  </div>
                </div>

                <div class="col-sm-4" style="left: -3%">
                  <div class="panel panel-white no-radius text-center">
                    <div class="panel-body">
                      <span class="fa-stack fa-2x"> <i class="fa fa-square fa-stack-2x text-primary"></i> <i class="fa fa-users fa-stack-1x fa-inverse"></i> </span>
                      <!-- <h4 class="StepTitle" style="margin-top: 5%;">Patient List</h4> -->

                      <p class="cl-effect-1">
                        <a href="#app-hist" style=" color: black; text-decoration: none;"
                          onmouseover="this.style.color='red'"
                          onmouseout="this.style.color='black'"
                          onclick="clickDiv('#list-pat-list')">
                          <h4 class="StepTitle" style="margin-top: 5%;">Patient List</h4>
                        </a>
                      </p>
                    </div>
                  </div>
                </div>


                <div class="col-sm-4">
                  <div class="panel panel-white no-radius text-center">
                    <div class="panel-body">
                      <span class="fa-stack fa-2x"> <i class="fa fa-square fa-stack-2x text-primary"></i> <i class="fa fa-paperclip fa-stack-1x fa-inverse"></i> </span>
                      <!-- <h4 class="StepTitle" style="margin-top: 5%;">Appointment Details</h4> -->

                      <p class="cl-effect-1">
                        <a href="#app-hist" style=" color: black; text-decoration: none;"
                          onmouseover="this.style.color='red'"
                          onmouseout="this.style.color='black'"
                          onclick="clickDiv('#list-app-list')">
                          <h4 class="StepTitle" style="margin-top: 5%;">Appointment Details</h4>
                        </a>
                      </p>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-sm-4" style="left: 13%;margin-top: 5%;">
                  <div class="panel panel-white no-radius text-center">
                    <div class="panel-body">
                      <span class="fa-stack fa-2x"> <i class="fa fa-square fa-stack-2x text-primary"></i> <i class="fa fa-list-ul fa-stack-1x fa-inverse"></i> </span>
                      <!-- <h4 class="StepTitle" style="margin-top: 5%;">Prescription List</h4> -->

                      <p class="cl-effect-1">
                        <a href="#list-pres" style=" color: black; text-decoration: none;"
                          onmouseover="this.style.color='red'"
                          onmouseout="this.style.color='black'"
                          onclick="clickDiv('#list-pres-list')">
                          <h4 class="StepTitle" style="margin-top: 5%;">Prescription List</h4>
                        </a>
                      </p>
                    </div>
                  </div>
                </div>


                <div class="col-sm-4" style="left: 18%;margin-top: 5%">
                  <div class="panel panel-white no-radius text-center">
                    <div class="panel-body">
                      <span class="fa-stack fa-2x"> <i class="fa fa-square fa-stack-2x text-primary"></i> <i class="fa fa-plus fa-stack-1x fa-inverse"></i> </span>
                      <h4 class="StepTitle" style="margin-top: 5%;">Manage Doctors</h4>

                      <p class="cl-effect-1">
                        <a href="#app-hist" style=" color: blue; text-decoration: none;"
                          onmouseover="this.style.color='red'"
                          onmouseout="this.style.color='blue'"
                          onclick="clickDiv('#list-adoc-list')">Add Doctors</a>
                        &nbsp|
                        <a href="#app-hist" style=" color: blue; text-decoration: none;"
                          onmouseover="this.style.color='red'"
                          onmouseout="this.style.color='blue'"
                          onclick="clickDiv('#list-ddoc-list')">Delete Doctors</a>
                      </p>
                    </div>
                  </div>
                </div>
              </div>




            </div>
          </div>









          <div class="tab-pane fade" id="list-doc" role="tabpanel" aria-labelledby="list-home-list">


            <div class="col-md-8">
              <form class="form-group" action="doctorsearch.php" method="post">
                <div class="row">
                  <div class="col-md-10"><input type="text" name="doctor_contact" placeholder="Enter Email ID" class="form-control"></div>
                  <div class="col-md-2"><input type="submit" name="doctor_search_submit" class="btn btn-primary" value="Search"></div>
                </div>
              </form>
            </div>
            <table class="table table-hover">
              <thead>
                <tr>
                  <th scope="col">Doctor Name</th>
                  <th scope="col">Specialization</th>
                  <th scope="col">Email</th>
                  <th scope="col">Fees</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $con = mysqli_connect("localhost", "root", "", "myhmsdb");
                global $con;
                $query = "select * from doctb";
                $result = mysqli_query($con, $query);
                while ($row = mysqli_fetch_array($result)) {
                  $username = $row['username'];
                  $spec = $row['spec'];
                  $email = $row['email'];
                  $docFees = $row['docFees'];

                  echo "<tr>
                        <td style='min-width: 105px; max-width: 105px; word-wrap: break-word; word-break: break-word; overflow-wrap: break-word;'>$username</td>
                        <td style='min-width: 105px; max-width: 105px; word-wrap: break-word; word-break: break-word; overflow-wrap: break-word;'>$spec</td>
                        <td style='min-width: 220px; max-width: 220px; word-wrap: break-word; word-break: break-word; overflow-wrap: break-word;'>$email</td>
                        <td style='min-width: 100px; max-width: 100px; word-wrap: break-word; word-break: break-word; overflow-wrap: break-word;'>$docFees</td>
                      </tr>";
                }

                ?>
              </tbody>
            </table>
            <br>
          </div>


          <div class="tab-pane fade" id="list-pat" role="tabpanel" aria-labelledby="list-pat-list">

            <div class="col-md-8">
              <form class="form-group" action="patientsearch.php" method="post">
                <div class="row">
                  <div class="col-md-10"><input type="text" name="patient_contact" placeholder="Enter Contact" class="form-control"></div>
                  <div class="col-md-2"><input type="submit" name="patient_search_submit" class="btn btn-primary" value="Search"></div>
                </div>
              </form>
            </div>

            <table class="table table-hover">
              <thead>
                <tr>
                  <th scope="col">Patient ID</th>
                  <th scope="col">First Name</th>
                  <th scope="col">Last Name</th>
                  <th scope="col">Gender</th>
                  <th scope="col">Email</th>
                  <th scope="col">Contact</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $con = mysqli_connect("localhost", "root", "", "myhmsdb");
                global $con;
                $query = "select * from patreg";
                $result = mysqli_query($con, $query);
                while ($row = mysqli_fetch_array($result)) {
                  $pid = $row['pid'];
                  $fname = $row['fname'];
                  $lname = $row['lname'];
                  $gender = $row['gender'];
                  $email = $row['email'];
                  $contact = $row['contact'];

                  echo "<tr>
                        <td>$pid</td>
                        <td style='min-width: 110px; max-width: 110px;  word-wrap: break-word; word-break: break-word; overflow-wrap: break-word;'>$fname</td>
                        <td style='min-width: 110px; max-width: 110px;  word-wrap: break-word; word-break: break-word; overflow-wrap: break-word;'>$lname</td>
                        <td>$gender</td>
                        <td style='min-width: 250px; max-width: 250px;  word-wrap: break-word; word-break: break-word; overflow-wrap: break-word;'>$email</td>
                        <td >$contact</td>
                      </tr>";
                }

                ?>
              </tbody>
            </table>
            <br>
          </div>


          <div class="tab-pane fade" id="list-pres" role="tabpanel" aria-labelledby="list-pres-list">

            <div class="col-md-8">

              <div class="row">



                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th scope="col">Doctor</th>
                      <th scope="col">Patient ID</th>
                      <th scope="col" style="min-width: 92px; max-width: 156px;  word-wrap: break-word; word-break: break-word; overflow-wrap: break-word;">Appoint-ment ID</th>
                      <th scope="col" style="min-width: 105px; max-width: 105px;  word-wrap: break-word; word-break: break-word; overflow-wrap: break-word;">First Name</th>
                      <th scope="col" style="min-width: 105px; max-width: 105px;  word-wrap: break-word; word-break: break-word; overflow-wrap: break-word;">Last Name</th>
                      <th scope="col" style="min-width: 106px; max-width: 156px;  word-wrap: break-word; word-break: break-word; overflow-wrap: break-word;">Appoint-ment Date</th>
                      <th scope="col" style="min-width: 105px; max-width: 150px;  word-wrap: break-word; word-break: break-word; overflow-wrap: break-word;">Appoint-ment Time</th>
                      <th scope="col" style="min-width: 140px; max-width: 140px;  word-wrap: break-word; word-break: break-word; overflow-wrap: break-word;">Disease</th>
                      <th scope="col" style="min-width: 175px; max-width: 175px;  word-wrap: break-word; word-break: break-word; overflow-wrap: break-word;">Allergy</th>
                      <th scope="col" style="min-width: 215px; max-width: 215px;  word-wrap: break-word; word-break: break-word; overflow-wrap: break-word;">Prescription</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $con = mysqli_connect("localhost", "root", "", "myhmsdb");
                    global $con;
                    $query = "select * from prestb";
                    $result = mysqli_query($con, $query);
                    while ($row = mysqli_fetch_array($result)) {
                      $doctor = $row['doctor'];
                      $pid = $row['pid'];
                      $ID = $row['ID'];
                      $fname = $row['fname'];
                      $lname = $row['lname'];
                      $appdate = $row['appdate'];
                      $apptime = $row['apptime'];
                      $disease = $row['disease'];
                      $allergy = $row['allergy'];
                      $pres = $row['prescription'];


                      echo "<tr>
                        <td style='min-width: 105px; max-width: 105px;  word-wrap: break-word; word-break: break-word; overflow-wrap: break-word;'>$doctor</td>
                        <td>$pid</td>
                        <td>$ID</td>
                        <td style='min-width: 105px; max-width: 105px;  word-wrap: break-word; word-break: break-word; overflow-wrap: break-word;'>$fname</td>
                        <td style='min-width: 105px; max-width: 105px;  word-wrap: break-word; word-break: break-word; overflow-wrap: break-word;'>$lname</td>
                        <td>$appdate</td>
                        <td>$apptime</td>
                        <td style='min-width: 140px; max-width: 140px;  word-wrap: break-word; word-break: break-word; overflow-wrap: break-word;'>$disease</td>
                        <td style='min-width: 175px; max-width: 175px;  word-wrap: break-word; word-break: break-word; overflow-wrap: break-word;'>$allergy</td>
                        <td style='min-width: 215px; max-width: 215px;  word-wrap: break-word; word-break: break-word; overflow-wrap: break-word;'>$pres</td>
                      </tr>";
                    }

                    ?>
                  </tbody>
                </table>
                <br>
              </div>
            </div>
          </div>




          <div class="tab-pane fade" id="list-app" role="tabpanel" aria-labelledby="list-pat-list">

            <div class="col-md-8">
              <form class="form-group" action="appsearch.php" method="post">
                <div class="row">
                  <div class="col-md-10"><input type="text" name="app_contact" placeholder="Enter Contact" class="form-control"></div>
                  <div class="col-md-2"><input type="submit" name="app_search_submit" class="btn btn-primary" value="Search"></div>
                </div>
              </form>
            </div>

            <table class="table table-hover">
              <thead>
                <tr>
                  <th scope="col" style="min-width: 92px; max-width: 156px;  word-wrap: break-word; word-break: break-word; overflow-wrap: break-word;">Appoint-ment ID</th>
                  <th scope="col">P.ID</th>
                  <th scope="col" style="min-width: 100px; max-width: 100px; word-wrap: break-word; word-break: break-word; overflow-wrap: break-word;">First Name</th>
                  <th scope="col" style="min-width: 90px; max-width: 90px; word-wrap: break-word; word-break: break-word; overflow-wrap: break-word;">Last Name</th>
                  <th scope="col">Gender</th>
                  <th scope="col">Email</th>
                  <th scope="col">Contact</th>
                  <th scope="col">Doctor Name</th>
                  <th scope="col">Doctor Fees</th>
                  <th scope="col" style="min-width: 106px; max-width: 156px;  word-wrap: break-word; word-break: break-word; overflow-wrap: break-word;">Appoint-ment Date</th>
                  <th scope="col" style="min-width: 105px; max-width: 150px;  word-wrap: break-word; word-break: break-word; overflow-wrap: break-word;">Appoint-ment Time</th>
                  <th scope="col">Appointment Status</th>
                </tr>
              </thead>
              <tbody>
                <?php

                $con = mysqli_connect("localhost", "root", "", "myhmsdb");
                global $con;

                $query = "select * from appointmenttb;";
                $result = mysqli_query($con, $query);
                while ($row = mysqli_fetch_array($result)) {
                ?>
                  <tr>
                    <td><?php echo $row['ID']; ?></td>
                    <td><?php echo $row['pid']; ?></td>
                    <td style="min-width: 105px; max-width: 105px; word-wrap: break-word; word-break: break-word; overflow-wrap: break-word;"><?php echo $row['fname']; ?></td>
                    <td style="min-width: 105px; max-width: 105px; word-wrap: break-word; word-break: break-word; overflow-wrap: break-word;"><?php echo $row['lname']; ?></td>
                    <td><?php echo $row['gender']; ?></td>
                    <td style="min-width: 210px; max-width: 210px; word-wrap: break-word; word-break: break-word; overflow-wrap: break-word;"><?php echo $row['email']; ?></td>
                    <td><?php echo $row['contact']; ?></td>
                    <td style="min-width: 105px; max-width: 105px; word-wrap: break-word; word-break: break-word; overflow-wrap: break-word;"><?php echo $row['doctor']; ?></td>
                    <td><?php echo $row['docFees']; ?></td>
                    <td><?php echo $row['appdate']; ?></td>
                    <td><?php echo $row['apptime']; ?></td>
                    <td>
                      <?php if (($row['userStatus'] == 1) && ($row['doctorStatus'] == 1)) {
                        echo "Active";
                      }
                      if (($row['userStatus'] == 0) && ($row['doctorStatus'] == 1)) {
                        echo "Cancelled by Patient";
                      }

                      if (($row['userStatus'] == 1) && ($row['doctorStatus'] == 0)) {
                        echo "Cancelled by Doctor";
                      }

                      if (($row['userStatus'] == 1) && ($row['doctorStatus'] == 3)) {
                        echo " Prescribed by Doctor ";
                      }
                      ?></td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
            <br>
          </div>

          <div class="tab-pane fade" id="list-messages" role="tabpanel" aria-labelledby="list-messages-list">...</div>

          <div class="tab-pane fade" id="list-settings" role="tabpanel" aria-labelledby="list-settings-list">
            <form class="form-group" method="post" action="admin-panel1.php">
              <div class="row">
                <div class="col-md-4"><label>Doctor Name:</label></div>
                <div class="col-md-8"><input type="text" class="form-control" name="doctor" onkeydown="return alphaOnly(event);" required></div><br><br>
                <div class="col-md-4"><label>Specialization:</label></div>
                <div class="col-md-8">
                  <select name="special" class="form-control" id="special" required>
                    <option value="" name="spec" disabled selected>Select Specialization</option>
                    <option value="General" name="spec">General</option>
                    <option value="Cardiologist" name="spec">Cardiologist</option>
                    <option value="Neurologist" name="spec">Neurologist</option>
                    <option value="Pediatrician" name="spec">Pediatrician</option>
                  </select>
                </div><br><br>
                <div class="col-md-4"><label>Email ID:</label></div>
                <div class="col-md-8"><input type="email" class="form-control" name="demail" required></div><br><br>
                <div class="col-md-4"><label>Password:</label></div>
                <div class="col-md-8"><input type="password" class="form-control" onkeyup='check();' name="dpassword" id="dpassword" required></div><br><br>
                <div class="col-md-4"><label>Confirm Password:</label></div>
                <div class="col-md-8" id='cpass'><input type="password" class="form-control" onkeyup='check();' name="cdpassword" id="cdpassword" required>&nbsp &nbsp<span id='message'></span> </div><br><br>


                <div class="col-md-4"><label>Consultancy Fees:</label></div>
                <div class="col-md-8"><input type="text" class="form-control" name="docFees" required></div><br><br>
              </div>
              <input type="submit" name="docsub" value="Add Doctor" class="btn btn-primary">
            </form>
          </div>

          <div class="tab-pane fade" id="list-settings1" role="tabpanel" aria-labelledby="list-settings1-list">
            <form class="form-group" method="post" action="admin-panel1.php">
              <div class="row">

                <div class="col-md-4"><label>Email ID:</label></div>
                <div class="col-md-8"><input type="email" class="form-control" name="demail" required></div><br><br>

              </div>
              <input type="submit" name="docsub1" value="Delete Doctor" class="btn btn-primary" onclick="confirm('do you really want to delete?')">
            </form>
          </div>


          <div class="tab-pane fade" id="list-attend" role="tabpanel" aria-labelledby="list-attend-list">...</div>

          <div class="tab-pane fade" id="list-mes" role="tabpanel" aria-labelledby="list-mes-list">

            <div class="col-md-8">
              <form class="form-group" action="messearch.php" method="post">
                <div class="row">
                  <div class="col-md-10"><input type="text" name="mes_contact" placeholder="Enter Contact" class="form-control"></div>
                  <div class="col-md-2"><input type="submit" name="mes_search_submit" class="btn btn-primary" value="Search"></div>
                </div>
              </form>
            </div>

            <table class="table table-hover">
              <thead>
                <tr>
                  <th scope="col">User Name</th>
                  <th scope="col">Email</th>
                  <th scope="col">Contact</th>
                  <th scope="col">Message</th>
                </tr>
              </thead>
              <tbody>
                <?php

                $con = mysqli_connect("localhost", "root", "", "myhmsdb");
                global $con;

                $query = "select * from contact;";
                $result = mysqli_query($con, $query);
                while ($row = mysqli_fetch_array($result)) {

                  #$fname = $row['fname'];
                  #$lname = $row['lname'];
                  #$email = $row['email'];
                  #$contact = $row['contact'];
                ?>
                  <tr>
                    <td style='min-width: 150px; max-width: 150px; word-wrap: break-word; word-break: break-word; overflow-wrap: break-word;'><?php echo $row['name']; ?></td>
                    <td style='min-width: 250px; max-width: 250px; word-wrap: break-word; word-break: break-word; overflow-wrap: break-word;'><?php echo $row['email']; ?></td>
                    <td style='min-width: 120px; max-width: 120px; word-wrap: break-word; word-break: break-word; overflow-wrap: break-word;'><?php echo $row['contact']; ?></td>
                    <td style='min-width: 500px; max-width:500px; word-wrap: break-word; word-break: break-word; overflow-wrap: break-word;'><?php echo $row['message']; ?></td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
            <br>
          </div>



        </div>
      </div>
    </div>
  </div>
  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.10.1/sweetalert2.all.min.js"></script>
</body>

</html>
