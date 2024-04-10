<?php
    session_start();
    require_once 'config/db.php';

    $session_useremail = $_SESSION['useremail'];
    $sql = "SELECT * FROM tbuser WHERE useremail = '$session_useremail'";
    $result = $conn->query($sql);


    if ($_SERVER['REQUEST_METHOD'] == "POST") {

    // ข้อมูลจากฟอร์ม
    $userid = $_POST['userid'];
    $useremail = $_POST['useremail'];
    $amountpaid = "300"; // จำนวนเงินที่จ่าย
    $paymentdate = date("d-m-Y H:i:s");
    $paymentdue = date("d-m-Y H:i:s", strtotime("+1 month"));
    $paymentstatus = "Already";

    $barcode = md5($useremail); 
    
    // เพิ่มข้อมูลในตาราง tbcard
    $issuedate = date("d-m-Y H:i:s");
    $expirationdate = date("d-m-Y H:i:s", strtotime("+1 year"));
    $cardstatus = "activenow";
    
     // Check if bardcode already exists in tbcard
     $check_barcode_sql = "SELECT * FROM tbcard WHERE barcode = '$barcode'";
     $check_barcode_result = $conn->query($check_barcode_sql);

     if ($check_barcode_result !== false && $check_barcode_result->num_rows == 0) {
        // กรณีไม่มี bardcode ที่ซ้ำกันใน tbcard ให้ทำการ insert
        $sql_card = "INSERT INTO tbcard (barcode, issuedate, expirationdate, cardstatus) 
                    VALUES ('$barcode', '$issuedate', '$expirationdate', '$cardstatus')";

        if ($conn->query($sql_card) === TRUE) {
            // รับค่า cardid ที่เพิ่มเข้าไปล่าสุด
            $cardid = $conn->insert_id;

            // เช็คว่ามี userid ซ้ำกันหรือไม่
            $check_sql = "SELECT * FROM tbmember WHERE userid = '$userid'";
            $check_result = $conn->query($check_sql);

            if ($check_result->num_rows == 0) {
                // เพิ่มข้อมูลในตาราง tbmember เมื่อไม่มี userid ที่ซ้ำ
                $sql_member = "INSERT INTO tbmember (cardid, userid) 
                            VALUES ('$cardid', '$userid')";
                if ($conn->query($sql_member) === TRUE) {
                    // รับค่า memberid ที่เพิ่มเข้าไปล่าสุด
                    $memberid = $conn->insert_id;

                    // เพิ่มข้อมูลในตาราง tbpayment
                    $sql_payment = "INSERT INTO tbpayment (memberid, amountpaid, amountdue, paymentdate, paymentdue, paymentstatus) 
                                    VALUES ('$memberid', '$amountpaid', '0', '$paymentdate', '$paymentdue', '$paymentstatus')";
                    if ($conn->query($sql_payment) === TRUE) {
                        echo '<script>
                        alert("สมัครสมาชิกสำเร็จ");
                        window.location = "page.php";

                        </script>';

                      
                    } else {
                        echo "Error inserting record into tbpayment: " . $conn->error;
                    }
                } else {
                    echo "Error inserting record into tbmember: " . $conn->error;
                }
            } else {
                echo '<script>
                        alert("ท่านได้สมัครสมาชิกแล้ว");
                        window.location = "page.php";
                        </script>';
            }
        } else {
            echo "Error inserting record into tbcard: " . $conn->error;
        }
    } else {
        // กรณีมี bardcode ที่ซ้ำกันใน tbcard ให้แจ้งเตือน
        echo '<script>
        alert("ท่านได้สมัครสมาชิกแล้ว");
        window.location = "page.php";
        </script>';
    }

    // ปิดการเชื่อมต่อ
    $conn->close();

    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <link rel="stylesheet" href="money.css">
    <script src="slide.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.5.5/css/simple-line-icons.min.css"
        rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="http://maxcdn.bootsrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,300italic,400italic,700italic"
        rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- Sweetalert2 -->
    <script src="
    https://cdn.jsdelivr.net/npm/sweetalert2@11.10.7/dist/sweetalert2.all.min.js
    "></script>
    <link href="
    https://cdn.jsdelivr.net/npm/sweetalert2@11.10.7/dist/sweetalert2.min.css
    " rel="stylesheet">
</head>
<script>
    function sweetalert2(){
                Swal.fire({
                    title: "สมัครสมาชิกสำเร็จ",
                    icon: "success",
                    confirmButtonText: "ตกลง"
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location = "page.php";
                    }
                });
            }
</script>
<body>

    <!-- <script src="slide.js"></script> -->
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

    <div class="wrapper">
        <h2>Payment Form</h2>
        <form action="" method="post">
            <!--Account Information Start-->
            <h4>Account</h4>
            <?php if($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $row_username = $row['userfname'] . ' ' . $row['userlname'];
                $row_useremail = $row['useremail'];
                $row_userid = $row['userid'];
            ?>
            <input type="hidden" name="userid" value="<?php echo $row_userid ?>">
            <div class="input_group">
                <div class="input_box">
                    <input type="text" name="username" placeholder="ชื่อของคุณ" required class="name"
                        value="<?php echo $row_username ?>">
                    <i class="fa fa-user icon"></i>
                </div>
                <div class="input_box">
                    <input type="text" name="useremail" placeholder="อีเมลของคุณ" required class="name"
                        value="<?php echo $row_useremail ?>">
                    <i class="fa fa-envelope icon"></i>
                </div>
            </div>
            <?php } ?>

            <!--Account Information End-->


            <!--Payment Details Start-->
            <div class="input_group">
                <div class="input_box">
                    <h4>Payment Details</h4>
                    <input type="radio" name="pay" class="radio" id="bc1" checked>
                    <label for="bc1"><span>
                            <i class="fab fa-cc-visa"></i>Credit Card</span></label>
                    <input type="radio" name="pay" class="radio" id="bc2">
                    <label for="bc2"><span>
                            <i class="fab fa-cc-paypal"></i>Paypal</span></label>
                </div>
            </div>
            <div class="input_group visa-details">
                <div class="input_box">
                    <input type="tel" name="" class="name" placeholder="เลขบัตรเครดิต Visa" required>
                    <i class="fa fa-credit-card icon"></i>
                </div>
                <div class="input_box">
                    <input type="tel" class="name" placeholder="วันหมดอายุ" required>
                    <i class="fa fa-user icon"></i>
                </div>
                <div class="input_box">
                    <input type="tel" name="" class="name" placeholder="รหัส CVV (รหัสการยืนยันบัตร)" required>
                    <i class="fa fa-user icon"></i>
                </div>
            </div>

            <div class="input_group paypal-details" style="display: none;">
                <div class="input_box">
                    <input type="email" name="paypal-email" placeholder="Paypal Email" class="name">
                    <i class="far fa-envelope icon" aria-hidden="true"></i>
                </div>
                <div class="input_box">
                    <input type="password" name="paypal-password" placeholder="Paypal Password" class="name">
                    <i class="fa fa-lock icon" aria-hidden="true"></i>
                </div>
            </div>

            <!-- new -->

            <!--Payment Details End-->

            <div class="input_box">
                <input type="heidden" value="300" required class="name" disabled>
                <i class="far fa-money-bill-alt icon" aria-hidden="true"></i>
            </div>

            <div class="input_group">
                <div class="input_box">
                    <button type="submit" name="submit-pay">PAY NOW</button>
                </div>
            </div>

        </form>
    </div>

    <script>
    // document.querySelectorAll('input[name="pay"]').forEach(function(radio){
    //     radio.addEventListener('change', function(){
    //         var paymentType = this.id.substring(2); // Extracting payment type from radio button ID
    //         var visaDetails = document.querySelectorAll('.visa-details');
    //         var paypalDetails = document.querySelectorAll('.paypal-details');

    //         if (paymentType === 'bc1') { // If Credit Card selected
    //             visaDetails.forEach(function(item){
    //                 item.style.display = 'block';
    //             });
    //             paypalDetails.forEach(function(item){
    //                 item.style.display = 'none';
    //             });
    //         } else { // If PayPal selected
    //             visaDetails.forEach(function(item){
    //                 item.style.display = 'none';
    //             });
    //             paypalDetails.forEach(function(item){
    //                 item.style.display = 'block';
    //             });
    //         }
    //     });
    // });
    const radios = document.querySelectorAll('input[type="radio"][name="pay"]');
    const visaDetails = document.querySelector('.visa-details');
    const paypalDetails = document.querySelector('.paypal-details');

    radios.forEach(radio => {
        radio.addEventListener('change', (event) => {
            const selectedMethod = event.target.id;

            if (selectedMethod === 'bc1') {
                visaDetails.style.display = 'block';
                paypalDetails.style.display = 'none';
            } else if (selectedMethod === 'bc2') {
                visaDetails.style.display = 'none';
                paypalDetails.style.display = 'block';
            }
        });
    });
    </script>
</body>

</html>