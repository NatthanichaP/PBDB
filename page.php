<?php
    session_start();
    require_once 'config/db.php';

    
    $session_useremail = $_SESSION['useremail'];
    
    $sql = "SELECT u.userid, u.useremail, u.userphone, CONCAT(u.userfname, ' ', u.userlname) AS fullname , c.barcode, DATE(c.issuedate) AS issuedate, DATE(c.expirationdate) AS expirationdate
    FROM tbuser u
    INNER JOIN tbmember m ON u.userid = m.userid
    INNER JOIN tbcard c ON m.cardid = c.cardid
    WHERE u.useremail = '$session_useremail'";
    
    $result = $conn->query($sql);

    // ตรวจสอบว่ามี session ที่ระบุว่าผู้ใช้เข้าสู่ระบบแล้วหรือไม่
    if (!isset($_SESSION['useremail'])) {
        // ถ้าไม่มี session ให้เปลี่ยนเส้นทางไปยังหน้า signin.php เพื่อให้ผู้ใช้เข้าสู่ระบบ
        header("location: index.php");
        exit;
    }
    
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parking Lot</title>
    <link rel="stylesheet" href="custom.css">
    <script src="slide.js"></script>
    <!-- <link rel='stylesheet' href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css'> -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.5.5/css/simple-line-icons.min.css"
        rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,300italic,400italic,700italic"
        rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

     <!-- generate barcode  -->   
     <script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.0/dist/JsBarcode.all.min.js"></script>


    <!-- Usig Swipe.css-->
    <!-- <link rel="stylesheet" href="assets/css/swiper-bundle.min.css.css"> -->
</head>

<body>

    <a class="menu-toggle rounded" href="#"><i class="fas fa-bars"></i></a>
    <nav id="sidebar-wrapper">
        <ul class="sidebar-nav">
            <li class="sidebar-brand">
                <a href="#page-top"> <?php echo $_SESSION['useremail']; ?></a>

            </li>
            <li class="sidebar-nav-item dropdown"><a href="" id="section-card">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor"
                        class="bi bi-credit-card-2-back" viewBox="0 0 16 16">
                        <path d="M11 5.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5z" />
                        <path
                            d="M2 2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2zm13 2v5H1V4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1m-1 9H2a1 1 0 0 1-1-1v-1h14v1a1 1 0 0 1-1 1" />
                    </svg>
                    Card profile
                    <h5 class="text-item"> กดเพื่อดูโปรไฟล์ของคุณ</h5>
                </a>
            </li>
                            <?php
                    // Query เพื่อดึงข้อมูลจาก tbbooking
                    $booking_sql = "SELECT tbbooking.memberid, tbparkingslot.channelnumber 
                                    FROM tbbooking 
                                    JOIN tbparkingslot ON tbbooking.bookingid = tbparkingslot.bookingid";
                    $result_booking = $conn->query($booking_sql);

                    // ตรวจสอบว่ามีผลลัพธ์จากคำสั่ง SQL หรือไม่
                    if ($result_booking->num_rows > 0) {
                        // ดึงข้อมูลผู้ใช้เดียว
                        $row_booking = $result_booking->fetch_assoc();
                        $memberid = $row_booking['memberid'];
                        $channelnumber = $row_booking['channelnumber'];
                ?>
                <li class="sidebar-nav-item dropdown" id="parking-reservation">            
                    <a href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor"
                            class="bi bi-p-circle" viewBox="0 0 16 16">
                            <path
                                d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0M5.5 4.002h2.962C10.045 4.002 11 5.104 11 6.586c0 1.494-.967 2.578-2.55 2.578H6.784V12H5.5zm2.77 4.072c.893 0 1.419-.545 1.419-1.488s-.526-1.482-1.42-1.482H6.778v2.97z" />
                        </svg>
                        Parking reservation status
                        <h5 class="text-item"> คุณได้จองที่จอดรถช่อง <?php echo $channelnumber; ?></h5>
                    </a>
                </li>
                <?php
                    }
                ?>
            <li class="sidebar-nav-item dropdown" id="payment-status"><a href="#services">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor"
                        class="bi bi-stripe" viewBox="0 0 16 16">
                        <path
                            d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm6.226 5.385c-.584 0-.937.164-.937.593 0 .468.607.674 1.36.93 1.228.415 2.844.963 2.851 2.993C11.5 11.868 9.924 13 7.63 13a7.7 7.7 0 0 1-3.009-.626V9.758c.926.506 2.095.88 3.01.88.617 0 1.058-.165 1.058-.671 0-.518-.658-.755-1.453-1.041C6.026 8.49 4.5 7.94 4.5 6.11 4.5 4.165 5.988 3 8.226 3a7.3 7.3 0 0 1 2.734.505v2.583c-.838-.45-1.896-.703-2.734-.703" />
                    </svg>
                    Payment status
                    <h5 class="text-item"> ใช้จ่ายรอบถัดไป </h5>
                </a>
            </li>


            <li class="sidebar-nav-item dropdown" id="contact-admin"><a href="#contact">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor"
                        class="bi bi-person-lines-fill" viewBox="0 0 16 16">
                        <path
                            d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5m.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1z" />
                    </svg>
                    Contact admin</a>
            </li>
            <li class="sidebar-nav-item dropdown" id="contact-admin"><a href="Admin/user.php">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor"
                        class="bi bi-person-lines-fill" viewBox="0 0 16 16">
                        <path
                            d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5m.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1z" />
                    </svg>
                    Contact Us</a>
            </li>
        </ul>
    </nav>

    </nav>
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

    <div class="content">


        <section class="parking-container">
            <div class="parking-lot">
                <?php
                
                    if ($result->num_rows > 0) {
                        // เมื่อพบผู้ใช้ในระบบ
                        $row = $result->fetch_assoc();
                        $current_user_id = $row['userid']; // กำหนดค่าของ userid ให้กับตัวแปร $current_user_id
                    }
                        if(isset($current_user_id)) {
                            // ตรวจสอบสถานะของผู้ใช้ว่าเป็นสมาชิกหรือไม่
                            $sql_member_check = "SELECT * FROM tbmember WHERE userid = $current_user_id"; // $current_user_id เป็นตัวแปรที่เก็บค่า ID ของผู้ใช้ปัจจุบัน
                            $result_member_check = $conn->query($sql_member_check);
                        
                            if ($result_member_check->num_rows > 0) {
                                // ผู้ใช้เป็นสมาชิก สามารถแสดงไอคอนรถเพื่อทำการจองได้
                                $sql_parkingslots = "SELECT * FROM tbparkingslot";
                                $result_parkingslots = $conn->query($sql_parkingslots);
                                
                                if ($result_parkingslots->num_rows > 0) {
                                    // แสดงช่องจอดรถแต่ละช่อง
                                    while($row_parkingslots = $result_parkingslots->fetch_assoc()) {
                                        if($row_parkingslots['p_status'] == 0) {
                                            // ถ้าสถานะเป็น 0 (ว่าง) ให้แสดงเป็นสีเขียว
                                            echo '<div class="parking-slot available" ><a href="booking.php?p_slotid=' . $row_parkingslots['p_slotid'] . '">' . $row_parkingslots['channelnumber'] . '
                                                <br>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="green" class="bi bi-car-front-fill" viewBox="0 0 16 16">
                                                    <path d="M2.52 3.515A2.5 2.5 0 0 1 4.82 2h6.362c1 0 1.904.596 2.298 1.515l.792 1.848c.075.175.21.319.38.404.5.25.855.715.965 1.262l.335 1.679q.05.242.049.49v.413c0 .814-.39 1.543-1 1.997V13.5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-1.338c-1.292.048-2.745.088-4 .088s-2.708-.04-4-.088V13.5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-1.892c-.61-.454-1-1.183-1-1.997v-.413a2.5 2.5 0 0 1 .049-.49l.335-1.68c.11-.546.465-1.012.964-1.261a.8.8 0 0 0 .381-.404l.792-1.848ZM3 10a1 1 0 1 0 0-2 1 1 0 0 0 0 2m10 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2M6 8a1 1 0 0 0 0 2h4a1 1 0 1 0 0-2zM2.906 5.189a.51.51 0 0 0 .497.731c.91-.073 3.35-.17 4.597-.17s3.688.097 4.597.17a.51.51 0 0 0 .497-.731l-.956-1.913A.5.5 0 0 0 11.691 3H4.309a.5.5 0 0 0-.447.276L2.906 5.19Z"/>
                                                </svg>
                                            </a> </div>';
                                        } else {
                                            // ถ้าสถานะเป็น 1 (ถูกจอง) ให้แสดงเป็นสีแดง
                                            echo '<div class="parking-slot occupied "><a href="#" >' . $row_parkingslots['channelnumber'] . '
                                                <br>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="red" class="bi bi-car-front-fill" viewBox="0 0 16 16">
                                                    <path d="M2.52 3.515A2.5 2.5 0 0 1 4.82 2h6.362c1 0 1.904.596 2.298 1.515l.792 1.848c.075.175.21.319.38.404.5.25.855.715.965 1.262l.335 1.679q.05.242.049.49v.413c0 .814-.39 1.543-1 1.997V13.5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-1.338c-1.292.048-2.745.088-4 .088s-2.708-.04-4-.088V13.5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-1.892c-.61-.454-1-1.183-1-1.997v-.413a2.5 2.5 0 0 1 .049-.49l.335-1.68c.11-.546.465-1.012.964-1.261a.8.8 0 0 0 .381-.404l.792-1.848ZM3 10a1 1 0 1 0 0-2 1 1 0 0 0 0 2m10 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2M6 8a1 1 0 0 0 0 2h4a1 1 0 1 0 0-2zM2.906 5.189a.51.51 0 0 0 .497.731c.91-.073 3.35-.17 4.597-.17s3.688.097 4.597.17a.51.51 0 0 0 .497-.731l-.956-1.913A.5.5 0 0 0 11.691 3H4.309a.5.5 0 0 0-.447.276L2.906 5.19Z"/>
                                                </svg>
                                            </a> </div>';
                                            
                                        }
                                    }
                                } else {
                                    echo '<script>alert("ไม่พบข้อมูลช่องจอดรถ")</script>';
                                }
                            }
                        } else {
                                // ผู้ใช้ไม่เป็นสมาชิก แสดงข้อความแจ้งให้สมัครสมาชิกก่อนทำการจอง
                                echo '<script>alert("คุณต้องสมัครสมาชิกก่อนทำการจองได้")</script>';
                                // แสดงที่ไอคอนจอดรถแต่ไม่สามารถกดได้
                                $sql_parkingslots = "SELECT * FROM tbparkingslot";
                                $result_parkingslots = $conn->query($sql_parkingslots);
                                    
                                if ($result_parkingslots->num_rows > 0) {
                                    // แสดงช่องจอดรถแต่ละช่อง
                                    while($row_parkingslots = $result_parkingslots->fetch_assoc()) {
                                        echo '<div class="parking-slot available"><span>' . $row_parkingslots['channelnumber'] . '</span>
                                            <br>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-car-front-fill" viewBox="0 0 16 16">
                                                <path d="M2.52 3.515A2.5 2.5 0 0 1 4.82 2h6.362c1 0 1.904.596 2.298 1.515l.792 1.848c.075.175.21.319.38.404.5.25.855.715.965 1.262l.335 1.679q.05.242.049.49v.413c0 .814-.39 1.543-1 1.997V13.5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-1.338c-1.292.048-2.745.088-4 .088s-2.708-.04-4-.088V13.5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-1.892c-.61-.454-1-1.183-1-1.997v-.413a2.5 2.5 0 0 1 .049-.49l.335-1.68c.11-.546.465-1.012.964-1.261a.8.8 0 0 0 .381-.404l.792-1.848ZM3 10a1 1 0 1 0 0-2 1 1 0 0 0 0 2m10 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2M6 8a1 1 0 0 0 0 2h4a1 1 0 1 0 0-2zM2.906 5.189a.51.51 0 0 0 .497.731c.91-.073 3.35-.17 4.597-.17s3.688.097 4.597.17a.51.51 0 0 0 .497-.731l-.956-1.913A.5.5 0 0 0 11.691 3H4.309a.5.5 0 0 0-.447.276L2.906 5.19Z"/>
                                            </svg>
                                        </div>';
                                    }
                                } else {
                                    echo '<script>alert("ไม่พบข้อมูลช่องจอดรถ")</script>';
                                }
                            }


                    mysqli_data_seek($result, 0);        
                    ?>
            </div>
        </section>
     

        <script>
               function bookParking(slotId) {
        // ทำการส่งคำขอ AJAX เพื่อจองช่องจอดรถ
        
        // เมื่อสำเร็จ ทำการเปลี่ยนสีไอคอนรถเป็นสีแดง
        var icon = document.querySelector('[data-slotid="' + slotId + '"] .bi-car-front-fill');
        if (icon) {
            icon.setAttribute('fill', 'red');
        }
    }

    function releaseParking(slotId) {
        // ทำการส่งคำขอ AJAX เพื่อยกเลิกการจองช่องจอดรถ
        
        // เมื่อสำเร็จ ทำการเปลี่ยนสีไอคอนรถเป็นสีเขียว
        var icon = document.querySelector('[data-slotid="' + slotId + '"] .bi-car-front-fill');
        if (icon) {
            icon.setAttribute('fill', 'green');
        }
    }
        </script>
        
        <section class="section-card">
            <div class="container card-visa">
            <?php 
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                ?>
                    <div class="card front-face">
                        <header>
                            <span class="logo">
                                <!--<img src="images/logo.png" alt="" />-->
                                <h5> <?php echo $row['useremail']; ?></h5>
                            </span>
                            <!--<img src="images/chip.png" alt="" class="chip" />-->
                        </header>
                        <div class="card-details">
                            <div class="name-number">
                                <h6> <?php echo $row['userphone']; ?></h6>
                                <h5 class="name"><?php echo $row['fullname']; ?></h5>
                            </div>
                        </div>
                    </div>
                    <div class="card back-face">
                        <span class="magnetic-strip">
                        <svg id="barcode"></svg>
                        </span>
                        
                        <div class="signature"><i> <?php echo $row['issuedate']; ?> </i></div>
                        <div class="signature"><i> <?php echo $row['expirationdate']; ?> </i></div>
                    </div>
                    <script>
                        <?php if (isset($row['barcode']) && !empty($row['barcode'])) { ?>
                            var barcodeData = "<?php echo $row['barcode']; ?>";
                            JsBarcode("#barcode", barcodeData, {
                                format: "CODE128",
                                lineColor: "#000",
                                width: 1,
                                height:25,
                                font: 0,
                                displayValue: false
                            });
                               // เลื่อนเส้นบาร์โค้ดไปอยู่ตรงกลาง
                            var barcodeElement = document.getElementById("barcode");
                            var barcodeWidth = barcodeElement.getBoundingClientRect().width;
                            var containerWidth = barcodeElement.parentElement.getBoundingClientRect().width;
                            var marginLeft = (containerWidth - barcodeWidth) / 2;
                            barcodeElement.style.marginLeft = marginLeft + "px";
                        <?php } ?>
                    </script>
                <?php 
                    }
                }
                ?>
            </div>
        </section>
                

        
       

        <div class="payment-details">
            <?php
                      $sql = "SELECT m.memberid
                      FROM tbuser u
                      INNER JOIN tbmember m ON u.userid = m.userid
                      WHERE u.useremail = '$session_useremail'";
              
              $result = $conn->query($sql);
          
              if ($result->num_rows > 0) {
                  $row = $result->fetch_assoc();
                  $memberid = $row['memberid'];
          
                  // ดึงข้อมูลการชำระเงินของสมาชิกจากตาราง tbpayment
                  $sql_payment = "SELECT paymentdate, paymentdue
                                  FROM tbpayment
                                  WHERE memberid = $memberid";
                  $result_payment = $conn->query($sql_payment);
          
                  if ($result_payment->num_rows > 0) {
                      $row_payment = $result_payment->fetch_assoc();
                      $paymentdate = date('Y-m-d', strtotime($row_payment['paymentdate']));
                      $paymentdue = date('Y-m-d', strtotime($row_payment['paymentdue']));
                ?>
            <div class="form-group1">
                <label for="inputEmail3" class=" control-label">
                    <h4>วันที่เริ่มจ่าย</h4>
                </label>
                <div class="form text-center">
                    <input type="text" value="<?php echo $paymentdate; ?>" class="form-control" name="datestartr2"
                        id="datestartr2" readonly="">
                </div>
            </div>

            <div class="form-group2">
                <label for="inputEmail3" class=" control-label">
                    <h4>วันที่จ่ายเดือนถัดไป</h4>
                </label>
                <div class="form text-center">
                    <input type="text" value="<?php echo $paymentdue; ?>" class="form-control" name="datestopr2"
                        id="datestopr2" readonly="">
                </div>
            </div>
        </div>
        <?php 
                }else {
                    // ถ้าไม่พบข้อมูลการชำระเงิน
                    $paymentdate = "N/A";
                    $paymentdue = "N/A";
                }
             } else {
                    // ถ้าไม่พบข้อมูลสมาชิก
                    $paymentdate = "N/A";
                    $paymentdue = "N/A";
                }
             
            ?>

        <div class="contact-section">
            <div class="form-group2">
                <div class="card-body text-center">
                    <i class="fas fa-mobile-alt text-primary "></i>
                    <h3 class="text-uppercase m-0">เบอร์โทร</h3>
                    <hr class="my-4 mx-auto" />
                    <div class="big text-black-80">0-7431-7103 ต่อ 0</div>
                </div>
            </div>

            <div class="form-group2">
                <div class="card-body text-center">
                    <i class="fas fa-mobile-alt text-primary "></i>
                    <h3 class="text-uppercase m-0">เบอร์โทร</h3>
                    <hr class="my-4 mx-auto" />
                    <div class="big text-black-80">0-7431-7103 ต่อ 0</div>
                </div>
            </div>
        </div>

    </div>


    <!-- <div class="slide-card">
            <div class="slider">
                <div class="images">
                    <input type="radio" name="slide" id="img1" checked>
                    <input type="radio" name="slide" id="img2">
            
        
                    <img src="img/1.jpg" class="m1" alt="img1">
                    <img src="img/2.jpg" class="m2" alt="img2">
                
                </div>
                <div class="dots">
                    <label for="img1"></label>
                    <label for="img2"></label>
                </div>
            </div>
        </div>
       -->


    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var cardProfileLink = document.getElementById('section-card'); // ค้นหาลิงก์สำหรับ card profile
        var parkingReservationLink = document.getElementById(
            'parking-reservation'); // ค้นหาลิงก์สำหรับ parking reservation
        var paymentStatusLink = document.getElementById(
            'payment-status'); // ค้นหาลิงก์สำหรับ parking reservation
        var contactAdminLink = document.getElementById('contact-admin'); // ค้นหาลิงก์สำหรับ parking reservation

        var parkingContainer = document.querySelector('.parking-container'); // ค้นหาข้อมูล parking-container
        var sectionCard = document.querySelector('.section-card'); // ค้นหาข้อมูล section-card
        var paymentStatus = document.querySelector('.payment-details'); // ค้นหาข้อมูล form-group
        var contactAdmin = document.querySelector('.contact-section'); // ค้นหาข้อมูล form-group


        // แสดงแค่ cardprofile เมื่อคลิกที่ card profile
        cardProfileLink.addEventListener('click', function(event) {
            event.preventDefault(); // หยุดการทำงานของลิงก์
            if (parkingContainer) {
                parkingContainer.style.display = 'none'; // ซ่อน parking-container
            }
            if (paymentStatus) {
                paymentStatus.style.display = 'none'; // ซ่อน payment ของ form-group
            }
            if (contactAdmin) {
                contactAdmin.style.display = 'none'; // แสดง Admin ของ contact-section
            }
            if (sectionCard) {
                sectionCard.style.display = 'block'; // แสดง section-card
            }

        });

        // แสดงแค่ section-card เมื่อคลิกที่ parking reservation
        parkingReservationLink.addEventListener('click', function(event) {
            event.preventDefault(); // หยุดการทำงานของลิงก์
            if (sectionCard) {
                sectionCard.style.display = 'none'; // ซ่อน section-card
            }
            if (paymentStatus) {
                paymentStatus.style.display = 'none'; // ซ่อน payment ของ form-group
            }
            if (contactAdmin) {
                contactAdmin.style.display = 'none'; // แสดง Admin ของ contact-section
            }
            if (parkingContainer) {
                parkingContainer.style.display = 'block'; // แสดง parking-container
            }
        });

        // แสดงแค่ form-group เมื่อคลิกที่ payment status
        paymentStatusLink.addEventListener('click', function(event) {
            event.preventDefault(); // หยุดการทำงานของลิงก์
            if (parkingContainer) {
                parkingContainer.style.display = 'none'; // ซ่อน parking-container
            }
            if (sectionCard) {
                sectionCard.style.display = 'none'; // ซ่อน section-card
            }
            if (contactAdmin) {
                contactAdmin.style.display = 'none'; // แสดง Admin ของ contact-section
            }
            if (paymentStatus) {
                paymentStatus.style.display = 'block'; // แสดง payment ของ form-group
            }
        });

        // แสดงแค่ contact-section เมื่อคลิกที่ contact admin
        contactAdminLink.addEventListener('click', function(event) {
            event.preventDefault(); // หยุดการทำงานของลิงก์
            if (parkingContainer) {
                parkingContainer.style.display = 'none'; // ซ่อน parking-container
            }
            if (sectionCard) {
                sectionCard.style.display = 'none'; // ซ่อน section-card
            }
            if (paymentStatus) {
                paymentStatus.style.display = 'none'; // แสดง payment ของ form-group
            }
            if (contactAdmin) {
                contactAdmin.style.display = 'block'; // แสดง Admin ของ contact-section
            }
        });

    });
    </script>



    <!--Using Swipe-->
    <!-- <script src="assets/js/swiper-bundle.min.js"></script> -->
</body>

</html>