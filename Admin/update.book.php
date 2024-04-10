<?php

require_once '../config/db.php';

$slotId = $_GET["slotId"];

echo $slotId;

$update_booking_sql = "UPDATE tbbooking SET bookingstatus = 'none' WHERE bookingid IN (SELECT bookingid FROM tbparkingslot WHERE p_slotid = '$slotId')";
$update_booking_result = $conn->query($update_booking_sql);

$sql = "UPDATE tbparkingslot SET p_status = 0, bookingid = NULL WHERE p_slotid = '$slotId'";

if ($conn->query($sql) === TRUE) {
    $_SESSION['success'] = "อัพเดตเสร็จสิ้น";
    header("location:   ParkingSlot.php"); 
  } else {
    echo "Error updating record: " . $conn->error;
  }

?>