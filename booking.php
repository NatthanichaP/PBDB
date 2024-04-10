<?php 
session_start();
require_once 'config/db.php';

if(isset($_GET["p_slotid"])) {

    $session_useremail = $_SESSION['useremail'];
    $sql = "SELECT * FROM tbuser WHERE useremail = '$session_useremail'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // ผู้ใช้เป็นสมาชิกที่ลงทะเบียนแล้ว
        $row_user = $result->fetch_assoc();
        $userid = $row_user['userid'];
    }

    if($_SERVER["REQUEST_METHOD"] == "POST"){
      if(isset($_POST['p_slotid'])) {
        $member_sql = "SELECT * FROM tbmember WHERE userid = $userid";
        $member_result = $conn->query($member_sql);
        $member_row = $member_result->fetch_assoc();
        $p_slotid = $_POST['p_slotid'];
        $memberid = $member_row['memberid'];
        $username = $_POST['username'];
        $timein = $_POST['timein'];
        $timeout = $_POST['timeout'];
        $bookstatus = "reserve";
        $bookingdate = $_POST['booking_date'];

        $insert_tbbooking = "INSERT INTO tbbooking (memberid, username, timein, timeout, bookingstatus, booking_date) 
        VALUE ('$memberid', '$username', '$timein', '$timeout', '$bookstatus', '$bookingdate');";
        $qry_insert = $conn->query($insert_tbbooking);

        $last_inserted_id = $conn->insert_id;
        $update_parkingslot = "UPDATE tbparkingslot SET p_status = 1, bookingid = '$last_inserted_id' WHERE p_slotid = '$p_slotid';";
        $qry_update = $conn->query($update_parkingslot);

        if($qry_insert && $qry_update) {
            echo "<script>alert('จองที่จอดรถสำเร็จ'); window.location = 'page.php';</script>";
        } else {
            echo "<script>alert('จองที่จอดรถไม่สำเร็จ');</script>";
        }
    }
  } 
}

// ตรวจสอบสถานะการจองและเวลาออก


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking</title>
    <link rel="stylesheet" href="booking.css">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.5.5/css/simple-line-icons.min.css"
        rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,300italic,400italic,700italic"
        rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar navbar-expand-lg ">
        <div class="container">
            <h3>Parking</h3>

            <div class="collapse navbar-collapse" id="navbarToggler">
                <ul class="navbar-nav mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a href="page.php" class="nav-link text-light" aria-current="page">Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="payment.php">
                            <button class="btn btn-outline-primary text-white" type="submit">membershirp</button>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="index.html" class="nav-link text-light" aria-current="page">logout

                        </a>

                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row">
            <div class="col-sm-2 col-md-2"></div>
            <div class="col-12 col-sm-11 col-md-7 devbanban" style="margin-top: 0px;">
                <br>
                <div class="row booking-form">
                    <div class="col-sm-12 col-md-12">
                        <div class="alert  mt-4" role="alert">
                            <center>
                                <font color="red"> <b> Booking Form </b></font>
                            </center>
                        </div>
                        <hr>
                        <div style="margin-left: 20px;">
                    <form action="" method="post">
                                <?php
                          // Check if p_slotid is set through URL
                        if (isset($_GET['p_slotid'])) {
                    
                          $selected_p_slotid = $_GET['p_slotid'];
                          // Fetching data from tbparkingslot using the selected p_slotid
                          $sql_parkingslot = "SELECT * FROM tbparkingslot WHERE p_slotid = $selected_p_slotid";
                          $result_parkingslot = $conn->query($sql_parkingslot);
                          if ($result_parkingslot && $result_parkingslot->num_rows > 0) {
                              $row = $result_parkingslot->fetch_assoc();
                              echo '<div class="form-group row">
                                        <label class="col-sm-2">ช่อง</label>
                                        <div class="col-sm-2">
                                            <input type="hidden" name="p_slotid" value="' . $selected_p_slotid . '"> 
                                            <input type="text" name="channelnumber" class="form-control" disabled value="' . $row['channelnumber'] . '">
                                        </div>
                                    </div>';
                          }
                      }
                      ?>
                       <div class="form-group row">
                            <label class="col-sm-2">ผู้จอง</label>
                            <div class="col-sm-4">
                                <?php
                                // ตรวจสอบว่ามีผู้ใช้ที่เข้าสู่ระบบหรือไม่
                                if (isset($userid)) {
                                    // Query เพื่อดึงข้อมูลผู้ใช้ที่เข้าสู่ระบบอยู่จาก tbmember
                                    $sql_member = "SELECT tbuser.userfname, tbuser.userlname 
                                                    FROM tbmember 
                                                    JOIN tbuser ON tbmember.userid = tbuser.userid 
                                                    WHERE tbmember.userid = $userid";
                                    $result_member = $conn->query($sql_member);

                                    // ตรวจสอบว่าพบผู้ใช้ที่เข้าสู่ระบบหรือไม่
                                    if ($result_member->num_rows > 0) {
                                        // ดึงข้อมูลผู้ใช้เดียว
                                        $row_member = $result_member->fetch_assoc();
                                        $username_member = $row_member['userfname'] . ' ' . $row_member['userlname'];
                                ?>
                                        <input type="text" name="username" class="form-control" placeholder="ชื่อผู้จอง" minlength="5" value="<?php echo $username_member; ?>" readonly>
                                <?php
                                    }
                                }
                                ?>
                            </div>
                        </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 ">วันที่</label>
                                    <div class="col-sm-5">
                                        <input type="date" name="booking_date" class="form-control" required value=""
                                            minlength="5">
                                    </div>

                                </div>
                                <div class="from-group row">
                                    <label class="col-sm-2 mt-3 mb-2">เวลาเข้า</label>
                                    <div class="col-sm-3 " style="margin-right: 50px ">
                                        <input type="time" name="timein" class="form-control" required value=""
                                            minlength="5">
                                    </div>
                                </div>
                                <div class="from-group row">

                                    <label class="col-sm-2 mt-3 mb-2">เวลาออก</label>
                                    <div class="col-sm-3 mb-2">
                                        <input type="time" name="timeout" class="form-control" required value=""
                                            minlength="5">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 ">เบอร์โทร</label>
                                    <div class="col-sm-7 mb-2 ">
                                        <?php
                          if (isset($userid)) {
                          $sql_member = "SELECT tbuser.userphone
                                        FROM tbmember 
                                        JOIN tbuser ON tbmember.userid = tbuser.userid";
                          $result_member = $conn->query($sql_member);

                          // ตรวจสอบว่า $result_member ถูกกำหนดค่าหรือไม่
                          if ($result_member->num_rows > 0) {
                              // Loop เพื่อแสดงรายชื่อผู้ใช้ที่เป็นสมาชิกในฟอร์มการจอง
                              $row_member = $result_member->fetch_assoc();
                               $userphone_member = $row_member['userphone'];
                          ?>
                                        <input type="text" name="userphone" class="form-control" required
                                            placeholder="เบอร์โทร" value="<?php echo $userphone_member; ?>"
                                            minlength="10" maxlength="10" readonly>

                                        <?php 
                            }
                          }
                        ?>


                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 "></label>
                                    <div class="col-sm-10">

                                        <input type="hidden" name="p_slotid" value="<?php echo $_GET['p_slotid'];?>">
                                        <button type="submit" class="btn btn-success">บันทึกการจอง</button>

                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>