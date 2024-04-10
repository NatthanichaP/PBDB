<?php
session_start();
require_once 'config/db.php';
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

    // Store the new message in the session array
    if (!isset($_SESSION['allMessages'])) {
        $_SESSION['allMessages'] = array();
    }
    $_SESSION['allMessages'][] = $newMessage;

    // Redirect back to the homepage
    header("Location: Admin/Messages.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-16">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>User</title>
    <!-- Custom fonts for this template-->
    <link href="Admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="Admin/css/sb-admin-2.min.css" rel="stylesheet">
    <style>
    /* เพิ่มสไตล์ CSS สำหรับตกแต่งฟอร์ม */
    .contact-form {
        margin-top: 50px;
    }

    .form-group input[type="text"],
    .form-group input[type="email"],
    .form-group textarea {
        width: 100%;
        padding: 10px;
        margin-bottom: 20px;
        border-radius: 5px;
        border: 1px solid #ccc;
    }

    .form-group textarea {
        height: 150px;
    }

    .form-group button[type="submit"] {
        padding: 10px 20px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .form-group button[type="submit"]:hover {
        background-color: #0056b3;
    }

    /* เพิ่มสไตล์ CSS สำหรับเนื้อหาบนหน้าเว็บ */
    #content-wrapper {
        padding-top: 20px;
    }
    </style>
</head>

<body id="page-top">
    <!-- Page Wrapper -->

    <form id="messageForm" action="Admin/Message.php" method="post">
    <!-- ฟิลด์ข้อมูลฟอร์ม -->
            <div id="wrapper">
                <!-- Content Wrapper -->
                <div id="content-wrapper" class="d-flex flex-column">
                    <!-- Main Content -->
                    <div id="content">
                        <div class="container mt-5">
                            <h2><?php echo $_SESSION['useremail'] ?></h2>
                            <form id="messageForm">
                                <div class="row">
                                    <div class="col-sm-6 py-2">
                                        <label for='Name' class="fg-grey">Name</label>
                                        <input type="text" name="name" class="form-control" placeholder="Enter Your Name"
                                            required />
                                    </div>
                                    <div class="col-sm-6 py-2">
                                        <label for='Phone' class="fg-grey">Phone</label>
                                        <input type="Phone" name="Phone" class="form-control" placeholder="Enter Your Phone"
                                            required />
                                    </div>
                                    <div class="col-sm-12 py-2">
                                        <label for='Subject' class="fg-grey">Subject</label>
                                        <input type="text" name="subject" class="form-control" placeholder="Enter Subject"
                                            required />
                                    </div>
                                    <div class="col-sm-12 py-2">
                                        <label for='Message' class="fg-grey">Message</label>
                                        <textarea class="form-control" name="message" rows="5" placeholder="Enter Message"
                                            required></textarea>
                                    </div>
                                    <div class="col-sm-12 py-2">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Success Modal -->
            <div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="successModalLabel">Success!</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <i class="fas fa-check-circle text-success mr-2"></i> Message sent successfully!
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

    </form>







    <!-- End of Page Wrapper -->
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <!-- Bootstrap core JavaScript-->
    <script src="Admin/vendor/jquery/jquery.min.js"></script>
    <script src="Admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="Admin/vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="Admin/js/sb-admin-2.min.js"></script>
    <!-- Page level plugins -->
    <script src="Admin/vendor/chart.js/Chart.min.js"></script>
    <!-- Page level custom scripts -->
    <script src="Admin/js/demo/chart-area-demo.js"></script>
    <script src="Admin/js/demo/chart-pie-demo.js"></script>
    <script src="Admin/js/demo/chart-bar-demo.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="Admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script>
    $(document).ready(function() {
        // AJAX request to load received messages on page load
        $.ajax({
            type: 'GET',
            url: 'Admin/Messages.php',
            success: function(response) {
                $('#messageTable').html(response);
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                alert('An error occurred while loading received messages.');
            }
        });

        // AJAX request to send message
        $('#messageForm').submit(function(event) {
            event.preventDefault(); // Prevent default form submission
            var formData = $(this).serialize(); // Serialize form data
            $.ajax({
                type: 'POST',
                url: 'Admin/Messages.php',
                data: formData,
                success: function(response) {
                    // Clear the form fields if needed
                    $('#messageForm')[0].reset();
                    // Show success modal
                    $('#successModal').modal('show');
                    // Load received messages after submitting the form
                    $.ajax({
                        type: 'GET',
                        url: 'Admin/Messages.php',
                        success: function(response) {
                            $('#messageTable').html(response);
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                            alert(
                                'An error occurred while loading received messages.');
                        }
                    });
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    alert('An error occurred while sending the message.');
                }
            });
        });
    });
    </script>

</body>

</html>