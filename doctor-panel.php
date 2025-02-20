<!DOCTYPE html>
<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
include('func1.php');

$con = mysqli_connect("localhost", "root", "", "myhmsdb");

// $doctor = $_SESSION['dname'];
if (isset($_SESSION['dname'])) {
  $doctor = $_SESSION['dname'];
} else {
  // If the session variable is not set, redirect to login or show an error
  echo "<script> window.location='doctor-panel.php';</script>";
  exit();
}

if (isset($_GET['cancel'])) {
  $query = mysqli_query($con, "update appointmenttb set doctorStatus='0' where ID = '" . $_GET['ID'] . "'");
  if ($query) {
    echo "<script>alert('Your appointment successfully cancelled');</script>";
    echo "<script>window.location.href = 'doctor-panel.php';</script>";
  }
}

if (isset($_GET['accept'])) {
  $query = mysqli_query($con, "update appointmenttb set doctorStatus='2' where ID = '" . $_GET['ID'] . "'");
  if ($query) {
    echo "<script>alert('Appointment successfully accepted');</script>";
    echo "<script>window.location.href = 'doctor-panel.php';</script>";
  }
}

//for appointment status prescribed by doctor (line 36 to 42 is added)
if (isset($_GET['prescribe'])) {
  $query = mysqli_query($con, "UPDATE appointmenttb SET doctorStatus='3' WHERE ID = '" . $_GET['ID'] . "'");
  if ($query) {
    echo "<script>alert('Prescription submitted successfully');</script>";
    echo "<script>window.location.href = 'doctor-panel.php';</script>";
  }
}


// Check for new appointments
$newAppointmentsQuery = mysqli_query($con, "SELECT * FROM appointmenttb WHERE isNew = TRUE");
if (mysqli_num_rows($newAppointmentsQuery) > 0) {
  echo "<script>
    document.addEventListener('DOMContentLoaded', function() {
      $('#newAppointmentModal').modal('show');
    });
  </script>";
  // Update the isNew flag to FALSE
  mysqli_query($con, "UPDATE appointmenttb SET isNew = FALSE WHERE isNew = TRUE");
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
  <link rel="shortcut icon" type="image/x-icon" href="images/favicon.png" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css?family=IBM+Plex+Sans&display=swap" rel="stylesheet">
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
    <a class="navbar-brand" href="#"> Advanced Patient Care Solution </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <style>
      .btn-outline-light:hover {
        color: #ffffff;
        background-color: #522258;
        border-color: #522258;
      }

      .filter {
        background-color: rgb(43, 124, 45);
        color: white;
        border: 2px rgb(43, 124, 45);
        border-radius: 12px;
        text-align: center;
        padding: 4px;
        z-index: 1;
        font-size: 20px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
      }
    </style>

    <style>
      .bg-primary {
        background: -webkit-linear-gradient(left, #522258, #D95F59);
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
      <form class="form-inline my-2 my-lg-0" method="post" action="search.php">
        <input class="form-control mr-sm-2" type="text" placeholder="Enter contact number" aria-label="Search" name="contact">
        <input type="submit" class="btn btn-outline-light" id="inputbtn" name="search_submit" value="Search">
      </form>
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
    <h3 style="margin-left: 40%; padding-bottom: 20px;font-family:'IBM Plex Sans', sans-serif;"> Welcome &nbsp<?php echo $_SESSION['dname'] ?> </h3>
    <div class="row">
      <div class="col-md-2" style="max-width:15%;margin-top: 3%;">
        <div class="list-group" id="list-tab" role="tablist">
          <a class="list-group-item list-group-item-action active" href="#list-dash" role="tab" aria-controls="home" data-toggle="list">Dashboard</a>
          <a class="list-group-item list-group-item-action" href="#list-app" id="list-app-list" role="tab" data-toggle="list" aria-controls="home">Appointments</a>
          <a class="list-group-item list-group-item-action" href="#list-pres" id="list-pres-list" role="tab" data-toggle="list" aria-controls="home"> Prescription List</a>

        </div><br>
      </div>
      <div class="col-md-8" style="margin-top: 3%;">
        <div class="tab-content" id="nav-tabContent" style="width: 950px;">
          <div class="tab-pane fade show active" id="list-dash" role="tabpanel" aria-labelledby="list-dash-list">

            <div class="container-fluid container-fullw bg-white">
              <div class="row">

                <div class="col-sm-4" style="left: 10%">
                  <div class="panel panel-white no-radius text-center">
                    <div class="panel-body">
                      <span class="fa-stack fa-2x"> <i class="fa fa-square fa-stack-2x text-primary"></i> <i class="fa fa-list fa-stack-1x fa-inverse"></i> </span>
                      <!-- <h4 class="StepTitle" style="margin-top: 5%;"> View Appointments</h4> -->
                      <script>
                        function clickDiv(id) {
                          document.querySelector(id).click();
                        }
                      </script>
                      <p class="links cl-effect-1">
                        <a href="#list-app" style=" color: black; text-decoration: none;"
                          onmouseover="this.style.color='red'"
                          onmouseout="this.style.color='black'"
                          onclick="clickDiv('#list-app-list')">
                          <h4 class="StepTitle" style="margin-top: 5%;"> View Appointments</h4>
                        </a>
                      </p>
                    </div>
                  </div>
                </div>

                <div class="col-sm-4" style="left: 15%">
                  <div class="panel panel-white no-radius text-center">
                    <div class="panel-body">
                      <span class="fa-stack fa-2x"> <i class="fa fa-square fa-stack-2x text-primary"></i> <i class="fa fa-list-ul fa-stack-1x fa-inverse"></i> </span>
                      <!-- <h4 class="StepTitle" style="margin-top: 5%;"> Prescriptions</h4> -->

                      <p class="links cl-effect-1">
                        <a href="#list-pres" style=" color: black; text-decoration: none;"
                          onmouseover="this.style.color='red'"
                          onmouseout="this.style.color='black'"
                          onclick="clickDiv('#list-pres-list')">
                          <h4 class="StepTitle" style="margin-top: 5%;"> Prescriptions</h4>
                        </a>
                      </p>
                    </div>
                  </div>
                </div>

              </div>
            </div>
          </div>


          <div class="tab-pane fade" id="list-app" role="tabpanel" aria-labelledby="list-home-list">

            <table class="table table-hover">
              <thead>
                <tr>
                  <th scope="col">P.ID</th>
                  <th scope="col" style="min-width: 92px; max-width: 156px;  word-wrap: break-word; word-break: break-word; overflow-wrap: break-word;">Appoint-ment ID</th>
                  <th scope="col">First Name</th>
                  <th scope="col">Last Name</th>
                  <th scope="col">Gender</th>
                  <th scope="col">Email</th>
                  <th scope="col">Contact</th>
                  <th scope="col" style="min-width: 106px; max-width: 156px;  word-wrap: break-word; word-break: break-word; overflow-wrap: break-word;">Appoint-ment Date</th>
                  <th scope="col" style="min-width: 105px; max-width: 150px;  word-wrap: break-word; word-break: break-word; overflow-wrap: break-word;">Appoint-ment Time</th>
                  <th scope="col">Current Status</th>
                  <th scope="col">Action</th>
                  <th scope="col">Prescribe</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $con = mysqli_connect("localhost", "root", "", "myhmsdb");
                global $con;
                $dname = $_SESSION['dname'];
                $query = "select pid,ID,fname,lname,gender,email,contact,appdate,apptime,userStatus,doctorStatus from appointmenttb where doctor='$dname';";
                $result = mysqli_query($con, $query);
                while ($row = mysqli_fetch_array($result)) {
                ?>
                  <tr>
                    <td><?php echo $row['pid']; ?></td>
                    <td><?php echo $row['ID']; ?></td>
                    <td style="min-width: 105px; max-width: 105px; word-wrap: break-word; word-break: break-word; overflow-wrap: break-word;"><?php echo $row['fname']; ?></td>
                    <td style="min-width: 105px; max-width: 105px; word-wrap: break-word; word-break: break-word; overflow-wrap: break-word;"><?php echo $row['lname']; ?></td>
                    <td><?php echo $row['gender']; ?></td>
                    <td style="min-width: 210px; max-width: 210px; word-wrap: break-word; word-break: break-word; overflow-wrap: break-word;"><?php echo $row['email']; ?></td>
                    <td><?php echo $row['contact']; ?></td>
                    <td><?php echo $row['appdate']; ?></td>
                    <td><?php echo $row['apptime']; ?></td>
                    <td>
                      <?php
                      if (($row['userStatus'] == 1) && ($row['doctorStatus'] == 1)) {
                        echo "Active";
                      } elseif (($row['userStatus'] == 0) && ($row['doctorStatus'] == 1)) {
                        echo "Cancelled by Patient";
                      } elseif (($row['userStatus'] == 1) && ($row['doctorStatus'] == 0)) {
                        echo "Cancelled by You";
                      } elseif (($row['doctorStatus'] == 2)) {
                        echo "Accepted by You";
                      }
                      ?>
                    </td>
                    <td>
                      <?php if (($row['userStatus'] == 1) && ($row['doctorStatus'] == 1)) { ?>
                        <a href="doctor-panel.php?ID=<?php echo $row['ID'] ?>&cancel=update"
                          onClick="return confirm('Are you sure you want to cancel this appointment ?')"
                          title="Cancel Appointment" tooltip-placement="top" tooltip="Remove">
                          <button class="btn btn-danger">Cancel</button>
                        </a>
                        <a href="doctor-panel.php?ID=<?php echo $row['ID'] ?>&accept=update"
                          onClick="return confirm('Are you sure you want to accept this appointment ?')"
                          title="Accept Appointment" tooltip-placement="top" tooltip="Accept">
                          <button class="btn btn-success">Accept</button>
                        </a>
                      <?php } elseif ($row['doctorStatus'] == 2) {
                        echo "Accepted";
                      } elseif ($row['doctorStatus'] == 0) {
                        echo "Cancelled";
                      }
                      elseif ($row['doctorStatus'] == 3) {
                        echo "Prescribed";
                      } else {
                        echo "Cancelled";
                      }
                      ?>
                    </td>
                    <td>
                      <?php
                      $prescriptionQuery = mysqli_query($con, "SELECT * FROM prestb WHERE ID = '" . $row['ID'] . "'");
                      if ($row['doctorStatus'] == 2) {
                        if (mysqli_num_rows($prescriptionQuery) == 0 && ($row['userStatus'] == 1)) {
                      ?>

                          <!-- <a href="prescribe.php?pid=<?php echo $row['pid'] ?>&ID=<?php echo $row['ID'] ?>&fname=<?php echo $row['fname'] ?>&lname=<?php echo $row['lname'] ?>
                           &appdate=<?php echo $row['appdate'] ?>&apptime=<?php echo $row['apptime'] ?>"
                            tooltip-placement="top" tooltip="Remove" title="prescribe">
                            <button class="btn btn-success" id="prescribe-btn-<?php echo $row['ID'] ?>" onclick="hideButton(<?php echo $row['ID'] ?>)">Prescribe</button>
                          </a> -->

                          <!--// incase prescribed by doctor needs to be removed comment above anchor tag and uncomment the above anchor tag-->

                          <a href="prescribe.php?pid=<?php echo $row['pid'] ?>&ID=<?php echo $row['ID'] ?>&fname=<?php echo $row['fname'] ?>&lname=<?php echo $row['lname'] ?>
                          &appdate=<?php echo $row['appdate'] ?>&apptime=<?php echo $row['apptime'] ?>&prescribe=true" tooltip-placement="top" tooltip="Remove" title="prescribe">
                            <button class="btn btn-success" id="prescribe-btn-<?php echo $row['ID'] ?>" onclick="hideButton(<?php echo $row['ID'] ?>)">Prescribe</button>
                          </a>

                      <?php
                        } else {
                          echo "Prescription Sent";
                        }
                      } else {
                        echo "-";
                      }
                      ?>
                    </td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
            <br>
          </div>



          <div class="tab-pane fade" id="list-pres" role="tabpanel" aria-labelledby="list-pres-list">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th scope="col">Patient ID</th>
                  <th scope="col">First Name</th>
                  <th scope="col">Last Name</th>
                  <th scope="col">Appointment ID</th>
                  <th scope="col">Appointment Date</th>
                  <th scope="col">Appointment Time</th>
                  <th scope="col">Disease</th>
                  <th scope="col">Allergy</th>
                  <th scope="col">Prescribe</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $con = mysqli_connect("localhost", "root", "", "myhmsdb");
                global $con;
                $query = "select   pid,fname,lname,ID,appdate,apptime,disease,allergy,prescription from prestb 
                          where doctor='$dname' ;";
                $result = mysqli_query($con, $query);
                if (!$result) {
                  echo mysqli_error($con);
                }
                while ($row = mysqli_fetch_array($result)) {
                ?>
                  <tr>
                    <td><?php echo $row['pid']; ?></td>
                    <td style="min-width: 105px; max-width: 105px; word-wrap: break-word; word-break: break-word; overflow-wrap: break-word;"><?php echo $row['fname']; ?></td>
                    <td style="min-width: 105px; max-width: 105px; word-wrap: break-word; word-break: break-word; overflow-wrap: break-word;"><?php echo $row['lname']; ?></td>
                    <td><?php echo $row['ID']; ?></td>
                    <td><?php echo $row['appdate']; ?></td>
                    <td><?php echo $row['apptime']; ?></td>
                    <td style="min-width: 105px; max-width: 105px; word-wrap: break-word; word-break: break-word; overflow-wrap: break-word;"><?php echo $row['disease']; ?></td>
                    <td style="min-width: 240px; max-width: 240px;  word-wrap: break-word; word-break: break-word; overflow-wrap: break-word;"><?php echo $row['allergy']; ?></td>
                    <td style="min-width: 250px; max-width: 250px;  word-wrap: break-word; word-break: break-word; overflow-wrap: break-word;"><?php echo $row['prescription']; ?></td>

                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
          <div class="tab-pane fade" id="list-messages" role="tabpanel" aria-labelledby="list-messages-list">...</div>
          <div class="tab-pane fade" id="list-settings" role="tabpanel" aria-labelledby="list-settings-list">
            <form class="form-group" method="post" action="admin-panel1.php">
              <div class="row">
                <div class="col-md-4"><label>Doctor Name:</label></div>
                <div class="col-md-8"><input type="text" class="form-control" name="doctor" required></div><br><br>
                <div class="col-md-4"><label>Password:</label></div>
                <div class="col-md-8"><input type="password" class="form-control" name="dpassword" required></div><br><br>
                <div class="col-md-4"><label>Email ID:</label></div>
                <div class="col-md-8"><input type="email" class="form-control" name="demail" required></div><br><br>
                <div class="col-md-4"><label>Consultancy Fees:</label></div>
                <div class="col-md-8"><input type="text" class="form-control" name="docFees" required></div><br><br>
              </div>
              <input type="submit" name="docsub" value="Add Doctor" class="btn btn-primary">
            </form>
          </div>
          <div class="tab-pane fade" id="list-attend" role="tabpanel" aria-labelledby="list-attend-list">...</div>
        </div>
      </div>
    </div>


    <!-- New Appointment Modal -->
    <div class="modal fade" id="newAppointmentModal" tabindex="-1" role="dialog" aria-labelledby="newAppointmentModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content filter">

          <div class="modal-body ">
            You have new appointment(s) booked!
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