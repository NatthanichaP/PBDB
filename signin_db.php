<?php
session_start();
require_once 'config/db.php';

if (isset($_POST['signin'])) {
    $useremail = $_POST['useremail'];
    $userpassword = $_POST['userpassword'];

    $useremail = mysqli_real_escape_string($conn, $useremail);
    $sql = "SELECT * FROM tbuser WHERE useremail = '$useremail'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($userpassword, $row['userpassword'])) {
            // เข้าสู่ระบบสำเร็จ
            $_SESSION['useremail'] = $useremail;
            
            $rank_id = $row['Rankid'];
            if ($rank_id == '1') {
                // ถ้าเป็นประเภท normal ไปยังหน้า page.php
                echo "<script>window.location.href='page.php';</script>";
                exit;
            } elseif ($rank_id == '2') {
                // ถ้าเป็นประเภท member ไปยังหน้า payment.php
                echo "<script>window.location.href='payment.php';</script>";
                exit;
            } elseif ($rank_id == '3') {
                // ถ้าเป็นประเภท member ไปยังหน้า payment.php
                echo "<script>window.location.href='Admin/index.php';</script>";
                exit;
            }
        } else {
            $_SESSION['error'] = "รหัสผ่านไม่ถูกต้อง";
            echo "<script>alert('รหัสผ่านไม่ถูกต้อง');</script>";
            echo "<script>window.location.href='index.php';</script>";
            exit;
        }
    } else {
        $_SESSION['error'] = "ไม่พบบัญชีผู้ใช้";
        echo "<script>alert('ไม่พบบัญชีผู้ใช้');</script>"; 
        echo "<script>window.location.href='index.php';</script>";
        exit;
    }
}
?>
