<?php 
    session_start();
    require_once '../config/db.php';

    $session_useremail = $_SESSION['useremail'];
$sql = "SELECT * FROM tbuser WHERE useremail = '$session_useremail'";
$result = $conn->query($sql);

    $slotId = $_GET["slotId"];

      // คิวรี่ SQL เพื่อดึงข้อมูลการจอง
   


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-16">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
      
    <title>Document</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <style>
    /* สีแดง */
    .booked {
        background-color: red;
    }

    /* สีเขียว */
    .available {
        background-color: green;
    }

    tbody {
        display: none;
    }

    /* CSS */
    .alert-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(255, 255, 255, 0.5);
        /* สีพื้นหลังสีขาวทึบ */
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 9999;
        /* ให้ alert อยู่ข้างบนสุด */
    }

    .alert-box {
        background-color: #fff;
        /* สีพื้นหลังของ alert */
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        /* เงา */
    }

    .alert-box button {
        margin-top: 10px;
        /* ระยะห่างของปุ่ม */
    }
    </style>

</head>
<body>

<div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Admin <sup></sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">



            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Parking
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-parking"></i> <!-- Font Awesome icon for parking -->
                    <span>Parking</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Parking:</h6>
                        <a class="collapse-item" href="ParkingSlot.php">Parking Slot</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Information
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-user"></i> <!-- Font Awesome icon for user -->
                    <span>User</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">User information:</h6>
                        <a class="collapse-item" href="member.php">Member</a>
                    </div>
                </div>
            </li>


            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="Payment.php">
                    <i class="fas fa-fw fa-money-bill-alt"></i> <!-- Font Awesome icon for payment -->
                    <span>Payment</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="Messages.php">
                    <i class="fas fa-fw fa-envelope"></i> <!-- Font Awesome icon for envelope -->
                    <span>Messages</span>
                </a>
            </li>





            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>


        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <!-- Nav Item - Messages -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-envelope fa-fw"></i>
                                <span class="badge badge-danger badge-counter"></span>
                            </a>
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="messagesDropdown">
                                <h6 class="dropdown-header">
                                    Message Center
                                </h6>
                                <div id="messageCenter">
                                    <?php
                                    // Check if there are any stored messages in session
                                        if(isset($_SESSION['allMessages']) && is_array($_SESSION['allMessages']) && !empty($_SESSION['allMessages'])) {
                                    // Display messages, limited to 5
                                            $messageCount = 0;
                                            foreach($_SESSION['allMessages'] as $message) {
                                                echo '<a class="" href="Messages.php">' . $message . '</a>';
                                            $messageCount++;
                                                if ($messageCount >= 5) break; // Stop displaying messages after reaching 5
                                        }
                                        } 
                                    ?>
                                </div>
                                <a class="dropdown-item text-center small text-gray-500" href="Messages.php">Read More
                                    Messages</a>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <?php if($result->num_rows > 0) {
                                    $row = $result->fetch_assoc();
                                    $row_username = $row['userfname'] . ' ' . $row['userlname'];
                                    $row_useremail = $row['useremail'];
                                    $row_userid = $row['userid'];
                                ?>
                            <input type="hidden" name="userid" value="<?php echo $row_userid ?>">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span
                                    class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $row_username ?></span>
                                <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
                                <?php } ?>
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>

<div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="bookingModalLabel">ข้อมูลการจอง</h5>
                  
              </div>
              <div class="modal-body">
              <?php 
        
        // ดึงข้อมูลการจอง
        $booking_info_sql = "SELECT tbuser.userfname, tbuser.userlname, tbuser.userphone, tbbooking.timein, tbbooking.timeout, tbparkingslot.channelnumber
            FROM tbuser
            INNER JOIN tbmember ON tbuser.userid = tbmember.userid
            INNER JOIN tbbooking ON tbmember.memberid = tbbooking.memberid
            INNER JOIN tbparkingslot ON tbbooking.bookingid = tbparkingslot.bookingid";
        $booking_info_result = $conn->query($booking_info_sql);

        if ($booking_info_result && $booking_info_result->num_rows > 0) { // ตรวจสอบว่า $booking_info_result มีค่าและมีแถวข้อมูล
            while($row = $booking_info_result->fetch_assoc()) {
    ?>
                  <table>
                      <thead>
                          <tr>
                              <p>ช่องจอดรถ : <?php echo $row['channelnumber']; ?></p>
                              <p>ชื่อ : <?php echo $row['userfname']; ?></p>
                              <p>นามสกุล : <?php echo $row['userlname']; ?></p>
                              <p>เบอร์โทรศัพท์ : <?php echo $row['userphone']; ?></p>
                              <p>เวลาเข้า :<?php echo $row['timein']; ?> </p>
                              <p>เวลาออก : <?php echo $row['timeout']; ?></p>
                          </tr>
                      </thead>
                      <tbody>
                      <tbody>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <?php 
                        }
                    } else {
                        echo "<p>ไม่พบข้อมูลการจอง</p>";
                    }
                
                ?>
                      </tbody>
                  </table>
              </div>

             
          </div>
      </div>
  </div>
    
</body>
</html>