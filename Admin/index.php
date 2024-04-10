<?php 
    session_start();
    require_once '../config/db.php';

    $session_useremail = $_SESSION['useremail'];
    $sql = "SELECT * FROM tbuser WHERE useremail = '$session_useremail'";
    $result = $conn->query($sql);

    $user_count_sql = "SELECT COUNT(*) AS user_count FROM tbuser WHERE rankid IN (1, 2)";
    $user_count_result = $conn->query($user_count_sql);
    $user_count_row = $user_count_result->fetch_assoc();
    $user_count = $user_count_row['user_count'];

    $channel_count_sql = "SELECT COUNT(*) AS channel_count FROM tbparkingslot";
    $channel_count_result = $conn->query($channel_count_sql);
    $channel_count_row = $channel_count_result->fetch_assoc();
    $channel_count = $channel_count_row['channel_count'];

    $user_sql = "SELECT tbuser.userfname, tbuser.userlname, tbuser.userphone, tbuser.useremail, tbrank.RankType
    FROM tbuser
    INNER JOIN tbrank ON tbuser.Rankid = tbrank.Rankid
    WHERE tbuser.rankid IN (1, 2)";
    $user_result = $conn->query($user_sql);



?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-16">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin </title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <style>

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


            <!-- Nav Item - Payment -->
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
                <div class="container-fluid ">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">ตารางการจองรถ</h1>

                    <div class="row">

                        <!-- User -->
                        <div class="col-lg-3 col-md-4 mb-3">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                User</div>
                                            <div class="h1 mb-0 font-weight-bold font-size-lg text-gray-800"><?php echo $user_count; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-user fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!--  Parking Slot -->
                        <div class="col-lg-3 col-md-4 mb-3">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Parking Slot</div>
                                            <div class="h1 mb-0 font-weight-bold text-gray-800"><?php echo $channel_count; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-car fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                    <!-- DataTales Example -->

                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="row">
                            <?php if ($user_result->num_rows > 0) {
                                    while ($row = $user_result->fetch_assoc()) { 
                            ?>
                                <div class="col-md-4 mb-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title"><?php echo $row['userfname'] . ' ' . $row['userlname']; ?></h5>
                                            <p class="card-text">Phone: <?php echo $row['userphone']; ?></p>
                                            <p class="card-text">email:<?php echo $row['useremail']; ?> </p>
                                        </div>
                                    </div>
                                </div> 
                            <?php 
                                  }
                                }
                            ?>
                            </div>
                        </div>
                    </div>
                </div>
           


            </div>
            <!-- End of Main Content -->


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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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

            // Listen for new messages and update counter
            // Assuming you have some mechanism to trigger this function when a new message arrives
            // For example, you can call handleNewMessage() after successfully adding a new message in your PHP code
        });
        </script>





</body>

</html>