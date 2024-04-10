<?php 
session_start();
require_once '../config/db.php';
   

$session_useremail = $_SESSION['useremail'];
$sql = "SELECT * FROM tbuser WHERE useremail = '$session_useremail'";
$result = $conn->query($sql);




?>



<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-16">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin_Parking </title>


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

<body id="page-top">

    <!-- Page Wrapper -->
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
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Parking Slot</h1>
<div class="row">
    <?php
    $sql_parkingslots = "SELECT * FROM tbparkingslot";
    $result_parkingslots = $conn->query($sql_parkingslots);

    if ($result_parkingslots->num_rows > 0) {
        // แสดงช่องจอดรถแต่ละช่อง
        while ($row_parkingslots = $result_parkingslots->fetch_assoc()) {
            if ($row_parkingslots['p_status'] == 0) {
                echo '<div class="col-md-4">
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <div style="text-align: center;">
                            <i class="fas fa-car fa-5x text-success"></i>
                        </div>
                        <h4 class="mt-2" style="text-align: center;">' . $row_parkingslots['channelnumber'] . '</h4>
                        <button class="btn btn-primary btn-block book-btn" data-slotid="' . $row_parkingslots["p_slotid"] . '" onclick="goToDetails(this)">ข้อมูลการจอง</button>
                        </div>
                </div>
            </div>';
            } else {
                echo '   <div class="col-md-4">
        <!-- Slot 2 -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <!-- Replace the existing content with the desired content -->
                <div style="text-align: center;">
                    <i class=" fas fa-car fa-5x text-danger"></i> <!-- Font Awesome icon for car -->
                </div>
                <h4 class="mt-2" style="text-align: center;"> ' . $row_parkingslots['channelnumber'] . ' </h4>
                <button class="btn btn-primary btn-block book-btn" data-slotid="' . $row_parkingslots["p_slotid"] . '" onclick="goToDetails(this)">ข้อมูลการจอง</button>
                <!-- Heading for the slot -->
';
                $id = $row_parkingslots["bookingid"];
                $sqltime = "SELECT  tbbooking.timein, tbbooking.timeout , bookingid , booking_date FROM tbbooking
                            WHERE bookingid = $id";
                $check_time = $conn->query($sqltime);
                $row = $check_time->fetch_assoc();

                $datebook = $row["booking_date"];
                $timein = $row["timein"];
                $timeout = $row["timeout"];
                $date =  date("Y-m-d H:i:s");

                $timestamp = strtotime($datebook);

                $datetimein = date("Y-m-d H:i:s", strtotime($timein, $timestamp));
                $datetimeout = date("Y-m-d H:i:s", strtotime($timeout, $timestamp));
            
                if ($date >= $datetimein && $date <= $datetimeout) {
                } else {
                    echo ' <button class="btn btn-warning btn-block book-btn" data-slotid="' . $row_parkingslots["p_slotid"] . '" onclick="goToupdate(this)">รีเซ็ตค่า</button>';
                }
                echo ' </div>
        </div>
    </div>';
            }
        }
    }

    ?>
                        <!-- Slot 1 -->



                    </div>
                    <!-- /.container-fluid -->
                </div>

                <!-- Modal -->
                <!-- Modal -->
                <div class="modal fade" id="bookingModal" tabindex="-1" role="dialog"
                    aria-labelledby="bookingModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="bookingModalLabel">ข้อมูลการจอง</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
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
                                            <p>ช่องจอดรถ :</p>
                                            <p>ชื่อ :</p>
                                            <p>นามสกุล :</p>
                                            <p>เบอร์โทรศัพท์ :</p>
                                            <p>เวลาเข้า :</p>
                                            <p>เวลาออก :</p>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><?php echo $row['channelnumber']; ?></td>
                                            <td><?php echo $row['userfname']; ?></td>
                                            <td><?php echo $row['userlname']; ?></td>
                                            <td><?php echo $row['userphone']; ?></td>
                                            <td><?php echo $row['timein']; ?></td>
                                            <td><?php echo $row['timeout']; ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <?php 
                        }
                    } else {
                        echo "<p>ไม่พบข้อมูลการจอง</p>";
                    }
                
                ?>

                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                                <button type="button" class="btn btn-primary release-btn">ว่าง</button>
                                <!-- ตัวอย่างปุ่มอื่น ๆ -->
                            </div>
                        </div>
                    </div>
                </div>



            </div>
            <!-- End of Content Wrapper -->

        </div>
        <!-- End of Page Wrapper -->

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>



        <!-- Bootstrap core JavaScript-->
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="js/sb-admin-2.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

        <script>
        function goToupdate(button) {
            // ดึงค่า p_slotid จาก attribute data-slotid ของปุ่ม
            const slotId = button.getAttribute("data-slotid");

            // ประกอบ URL สำหรับหน้า details.php พร้อมส่งค่า p_slotid
            const url = "update.book.php?slotId=" + slotId;

            // Redirect ไปยังหน้า details.php
            window.location.href = url;
        }

        function goToDetails(button) {
            // ดึงค่า p_slotid จาก attribute data-slotid ของปุ่ม
            const slotId = button.getAttribute("data-slotid");

            // ประกอบ URL สำหรับหน้า details.php พร้อมส่งค่า p_slotid
            const url = "details.booking.php?slotId=" + slotId;

            // Redirect ไปยังหน้า details.php
            window.location.href = url;
        }
        $(document).ready(function() {
            // Function to update message counter
            function updateMessageCounter(count) {
                // Update badge counter in the navbar
                $('#messagesDropdown .badge-counter').text(count);
            }
            $(".book-btn").click(function() {
                var slotNumber = $(this).data('slot');
                var personName, lastName, phoneNumber, entryTime, exitTime;
                var slotData = {};

                // ตัวแปร slotData ใช้เก็บข้อมูลของแต่ละ Slot
                switch (slotNumber) {
                    case 1:
                    case 2:
                        // กำหนดข้อมูลสำหรับ Slot 1 และ Slot 2
                        personName = "อาริฟีน";
                        lastName = "เจ๊ะเฮง";
                        phoneNumber = "0951031806";
                        entryTime = "16:06";
                        exitTime = "18:06";
                        break;
                    case 3:
                        // กำหนดข้อมูลสำหรับ Slot 3
                        personName = "ชื่อตัวอย่าง";
                        lastName = "นามสกุลตัวอย่าง";
                        phoneNumber = "0123456789";
                        entryTime = "10:00";
                        exitTime = "12:00";
                        break;
                    case 4:
                        // กำหนดข้อมูลสำหรับ Slot 4
                        personName = "ชื่อตัวอย่าง";
                        lastName = "นามสกุลตัวอย่าง";
                        phoneNumber = "0123456789";
                        entryTime = "10:00";
                        exitTime = "12:00";
                        break;
                    case 5:
                        // กำหนดข้อมูลสำหรับ Slot 5
                        personName = "ชื่อตัวอย่าง";
                        lastName = "นามสกุลตัวอย่าง";
                        phoneNumber = "0123456789";
                        entryTime = "10:00";
                        exitTime = "12:00";
                        break;
                    case 6:
                        // กำหนดข้อมูลสำหรับ Slot 6
                        personName = "ชื่อตัวอย่าง";
                        lastName = "นามสกุลตัวอย่าง";
                        phoneNumber = "0123456789";
                        entryTime = "10:00";
                        exitTime = "12:00";
                        break;
                    case 7:
                        // กำหนดข้อมูลสำหรับ Slot 7
                        personName = "ชื่อตัวอย่าง";
                        lastName = "นามสกุลตัวอย่าง";
                        phoneNumber = "0123456789";
                        entryTime = "10:00";
                        exitTime = "12:00";
                        break;
                    case 8:
                        // กำหนดข้อมูลสำหรับ Slot 8
                        personName = "ชื่อตัวอย่าง";
                        lastName = "นามสกุลตัวอย่าง";
                        phoneNumber = "0123456789";
                        entryTime = "10:00";
                        exitTime = "12:00";
                        break;
                    case 9:
                        // กำหนดข้อมูลสำหรับ Slot 9
                        personName = "ชื่อตัวอย่าง";
                        lastName = "นามสกุลตัวอย่าง";
                        phoneNumber = "0123456789";
                        entryTime = "10:00";
                        exitTime = "12:00";
                        break;
                    default:
                        personName = "";
                        lastName = "";
                        phoneNumber = "";
                        entryTime = "";
                        exitTime = "";
                        break;
                }

                // เช็คว่าข้อมูลใน personName ไม่เป็นค่าว่างหรือ null ก่อนที่จะแสดงข้อมูลใน Modal
                if (personName) {
                    // สร้าง HTML สำหรับแสดงข้อมูลการจอง
                    var bookingHTML =
                        '<tr>' +
                        '<td>ช่องจอดรถ ' + slotNumber + '</td>' +
                        '<td>ชื่อ: ' + personName + '</td>' +
                        '<td>นามสกุล: ' + lastName + '</td>' +
                        '<td>เบอร์โทรศัพท์: ' + phoneNumber + '</td>' +
                        '<td>เวลาเข้า: ' + entryTime + '</td>' +
                        '<td>เวลาออก: ' + exitTime + '</td>' +
                        '</tr>';

                    // แทรก HTML ลงในตารางของโมดัล
                    $("#bookingData").html(bookingHTML);

                    // เปิดโมดัลเพื่อแสดงข้อมูลการจอง
                    $('#bookingModal').modal('show');
                }
            });



            $("#bookingModal").on("click", ".release-btn", function() {
                // ลบข้อมูลการจอง
                $("#bookingData").empty();
                // ปิดป๊อปอัพ
                $("#bookingModal").modal("hide");
            });


            // Submit form data via Ajax when form is submitted
            $('#clearMessagesForm').submit(function(event) {
                event.preventDefault(); // Prevent default form submission
                $('#confirmDeleteModal').modal('show'); // Show confirmation modal
            });

            // Handle delete confirmation
            $('#confirmDeleteBtn').click(function() {
                $.ajax({
                    type: 'POST',
                    url: 'messages.php',
                    data: {
                        clear_messages: true
                    },
                    success: function(response) {
                        if (response === "success") {
                            // Hide modal and reload page upon successful message deletion
                            $('#confirmDeleteModal').modal('hide');
                            location.reload();
                        } else {
                            alert('Error: Unable to clear messages.');
                        }
                    }
                });
            });

            // Update message counter initially
            updateMessageCounter(
                <?php echo isset($_SESSION['allMessages']) ? count($_SESSION['allMessages']) : 0; ?>);

            // Function to handle new message arrival
            function handleNewMessage() {
                // Increment the message counter and update
                var currentCount = parseInt($('#messagesDropdown .badge-counter').text());
                updateMessageCounter(currentCount + 1);
            }

            // Function to handle message read
            function handleMessageRead() {
                // Decrease the message counter and update
                var currentCount = parseInt($('#messagesDropdown .badge-counter').text());
                if (currentCount > 0) {
                    updateMessageCounter(currentCount - 1);
                }
            }

            // Call the appropriate function based on user action
            $('#messagesDropdown').on('shown.bs.dropdown', function() {
                handleMessageRead
                    (); // When dropdown is shown, it means the user is reading messages
            });


        });
        </script>

</body>

</html>