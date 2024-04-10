<?php
            session_start();
            require_once 'config/db.php';


        if (isset($_POST['signup']))  {
            // เพิ่มข้อมูลในตาราง tbuser
            $userfname = $_POST['userfname'];
            $userlname = $_POST['userlname'];
            $useremail = $_POST['useremail'];
            $userpassword = $_POST['userpassword'];
            $c_password = $_POST['c_password'];
            $userphone = $_POST['userphone'];
            $Rank_id = $_POST['rank'];

            $phone = mysqli_real_escape_string($conn, $userphone);
            $sql_check_phone = "SELECT * FROM tbuser WHERE userphone = '$phone'";
            $result_check_phone = $conn->query($sql_check_phone);
        
            if ($result_check_phone->num_rows > 0) {
                $_SESSION['error'] = 'หมายเลขโทรศัพท์นี้ถูกใช้งานแล้ว';
                header("location: register.php");
                exit;
            }

            $useremail = mysqli_real_escape_string($conn, $useremail);
            $sql_check_email = "SELECT * FROM tbuser WHERE useremail = '$useremail'";
            $result_check_email = $conn->query($sql_check_email);

            if ($result_check_email->num_rows > 0) {
                $_SESSION['error'] = 'อีเมล์นี้ถูกใช้งานแล้ว';
                header("location: register.php");
                exit;
            }

            if (empty($userfname)) {
                $_SESSION['error'] = 'กรุณากรอกชื่อ';
                header("location: register.php");
            } else if (empty($userlname)) {
                $_SESSION['error'] = 'กรุณากรอกนามสกุล';
                header("location: register.php");
            } else if (empty($useremail)) {
                $_SESSION['error'] = 'กรุณากรอกอีเมล';
                header("location: register.php");
            } else if (!filter_var($useremail, FILTER_VALIDATE_EMAIL)) {
                $_SESSION['error'] = 'รูปแบบอีเมลไม่ถูกต้อง';
                header("location: register.php");
            } else if (empty($userpassword)) {
                $_SESSION['error'] = 'กรุณากรอกรหัสผ่าน';
                header("location: register.php");
            } else if (strlen($_POST['password']) > 20 || strlen($_POST['password']) < 5) {
                $_SESSION['error'] = 'รหัสผ่านต้องมีความยาวระหว่าง 5 ถึง 20 ตัวอักษร';
                header("location: register.php");
            } else if (empty($c_password)) {
                $_SESSION['error'] = 'กรุณายีนยันรหัสผ่าน';
                header("location: register.php");
            } else if ($userpassword != $c_password) {
                $_SESSION['error'] = 'รหัสผ่านไม่ตรงกัน';
                header("location: register.php");
            } 
            
       
            
            $userpasswordHash = password_hash ($userpassword, PASSWORD_DEFAULT);   

            $Rank_id = $_POST['rank'];
            $sql_rankid = "SELECT Rankid FROM tbRank WHERE Ranktype = '$Rank_id'";
            $result_rankid = $conn->query($sql_rankid);

                // ถ้าค้นหา Rankid ได้ผลลัพธ์
            if ($result_rankid->num_rows > 0) {
                // เพิ่มข้อมูลในตาราง tbuser โดยใช้ Rankid ที่ค้นหาได้
                while ($row_rankid = $result_rankid->fetch_assoc()) {
                    $Rank_id = $row_rankid['Rankid']; // กำหนด Rank_id ให้เป็นค่า Rankid ที่ค้นหาได้
                    
                    // คำสั่ง SQL เพื่อเพิ่มข้อมูลใน tbuser
                    $sql_insert = "INSERT INTO tbuser (userfname, userlname, useremail, userpassword, userphone, Rankid)
                                VALUES ('$userfname', '$userlname', '$useremail', '$userpasswordHash', '$userphone', '$Rank_id')";
                                
                    if ($conn->query($sql_insert) === TRUE) {
                        echo "บันทึกข้อมูลเรียบร้อยแล้ว (Rankid: $Rank_id)<br>";
                    } else {
                        echo "เกิดข้อผิดพลาดในการเพิ่มข้อมูล: " . $conn->error;
                    }
                }
            } else {
                echo "ไม่พบข้อมูล Rankid";
            }

            if ($conn->affected_rows > 0) {
                $_SESSION['success'] = "ลงทะเบียนเรียบร้อยแล้ว";
                header("location: index.php"); // แก้ไขเป็นหน้า signin.php หลังจากลงทะเบียนเสร็จสมบูรณ์
                exit; // เพิ่มคำสั่ง exit เพื่อหยุดการทำงานของสคริปต์
            } else {
                $_SESSION['error'] = "เกิดข้อผิดพลาดในการลงทะเบียน";
                header("location: register.php");
                exit; // เพิ่มคำสั่ง exit เพื่อหยุดการทำงานของสคริปต์
            }

            // ปิดการเชื่อมต่อ
            $conn->close();
          
        }
     
?>