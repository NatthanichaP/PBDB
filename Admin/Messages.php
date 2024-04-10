<?php

session_start();
require_once '../config/db.php';

$session_useremail = $_SESSION['useremail'];
$sql = "SELECT * FROM tbuser WHERE useremail = '$session_useremail'";
$result = $conn->query($sql);

// Check if the form data is received
if(isset($_POST['name']) && isset($_POST['Phone']) && isset($_POST['subject']) && isset($_POST['message'])) {
    // Construct the new message
    $newMessage = "<div class='dropdown-item'>";
    $newMessage .= "<span class='font-weight-bold'>Name: </span>" . $_POST['name'] . "<br>";
    $newMessage .= "<span class='font-weight-bold'>Phone: </span>" . $_POST['Phone'] . "<br>";
    $newMessage .= "<span class='font-weight-bold'>Subject: </span>" . $_POST['subject'] . "<br>";
    $newMessage .= "<span class='font-weight-bold'>Message: </span>" . $_POST['message'] . "<br>";
    $newMessage .= "</div>";

    // Check if there are any stored messages in session
    if(isset($_SESSION['allMessages']) && is_array($_SESSION['allMessages'])) {
        // Add the new message to the beginning of the array
        array_unshift($_SESSION['allMessages'], $newMessage);

        // Remove old messages if there are more than 10 messages
        if (count($_SESSION['allMessages']) > 10) {
            array_pop($_SESSION['allMessages']);
        }
    } else {
        // If no messages exist, create a new array with the new message
        $_SESSION['allMessages'] = array($newMessage);
    }

    // Send success response
    echo "success";

    exit();
}

// Check if the form data for clearing messages is received
if(isset($_POST['clear_messages'])) {
    // Clear all messages from session
    unset($_SESSION['allMessages']);
    // Send success response
    echo "success";
    exit();
}

?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Admin_Messages</title>
    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <style>
    /* CSS เส้นกรอบของตาราง */
    .table-box {
        border-collapse: collapse;
    }

    .table-box th,
    .table-box td {
        border: 1px solid #ccc;
        padding: 8px;
    }

    .booking-box {
        padding: 5px 10px;
        background-color: rgb(28, 218, 25);
        /* เปลี่ยนสีพื้นหลังเป็นสีน้ำเงิน */
        color: white;
        /* เปลี่ยนสีตัวอักษรเป็นสีขาว */
        border-radius: 5px;
        text-align: center;
        width: 100px;
        /* กำหนดความกว้าง */
        height: 40px;
        /* กำหนดความสูง */
        font-size: 20px;
        /* ปรับขนาดข้อความใหญ่ขึ้น */
    }

    .message-box {
        padding: 20px;
        /* ปรับขนาดของกล่อง */
        margin-bottom: 10px;
        /* เพิ่มระยะห่างระหว่างกล่อง */

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
                    <i class="fas fa-fw fa-money-bill-alt"></i> <!-- Font Awesome icon for payment -->
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
                    <form id="messageForm"
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
                         <!-- Nav Item - Alerts -->
                        <!-- <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <span class="badge badge-danger badge-counter">3+</span>
                            </a>
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    Alerts Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-warning">
                                            <i class="fas fa-car text-white"></i> 
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">May 15, 2024</div>
                                        <span class="font-weight-bold">Patsadect จองที่จอดรถ G1</span>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-warning">
                                            <i class="fas fa-car text-white"></i> 
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">May 17, 2024</div>
                                        <span class="font-weight-bold"> Keerata จองที่จอดรถ G5</span>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-warning">
                                            <i class="fas fa-car text-white"></i> 
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">May 20, 2024</div>
                                        <span class="font-weight-bold"> Fais จองที่จอดรถ G6</span>
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                            </div>
                        </li> -->

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
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $row_username ?></span>
                                <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
                                <?php } ?>
                            </a>
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
                    <h1 class="h3 mb-4 text-gray-800">Messages</h1>
                    <form id="clearMessagesForm" method="post">
                        <button type="submit" name="clear_messages" class="btn btn-danger">Clear Messages</button>
                        <div class="row">
                            <div class="col-sm-6 py-2">
                                <!-- Content Row -->
                                <?php
        // Check if there are any stored messages in session
        if(isset($_SESSION['allMessages']) && is_array($_SESSION['allMessages']) && !empty($_SESSION['allMessages'])) {
            // Display all messages
            foreach($_SESSION['allMessages'] as $message) {
                echo '<div class="card mb-4">';
                echo '<div class="card-body message-box">';
                echo $message;
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo "<p>No messages found.</p>";
        }
        ?>
                            </div>
                        </div>
                    </form>

                    <!-- Modal for confirmation -->
                    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog"
                        aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="confirmDeleteModalLabel">Confirm Delete</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Are you sure you want to delete all messages?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                    <button type="button" id="confirmDeleteBtn" class="btn btn-danger">Delete</button>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- /.container-fluid -->
                    <!-- Footer -->
                    <footer class="sticky-footer bg-white">
                        <div class="container my-auto">
                            <div class="text-center my-auto">
                                <span>2024 </span>
                            </div>
                        </div>
                    </footer>
                    <!-- End of Footer -->
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
            <!-- Page level plugins -->
            <script src="vendor/chart.js/Chart.min.js"></script>
            <!-- Page level custom scripts -->
            <script src="js/demo/chart-area-demo.js"></script>
            <script src="js/demo/chart-pie-demo.js"></script>
            <!-- Custom script for handling messages -->

            <!-- สคริปต์ JavaScript สำหรับการส่งคำขอการลบข้อความ -->
            <script>
            $(document).ready(function() {
                // Function to update message counter
                function updateMessageCounter(count) {
                    // Update badge counter in the navbar
                    $('#messagesDropdown .badge-counter').text(count);
                }

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