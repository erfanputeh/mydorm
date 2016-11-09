<?php
require_once('../../libs/Db.php');
date_default_timezone_set("Asia/Bangkok");
$date = date("Y-m-d");
$time = date("H:i:sa");

if (isset($_POST['booking'])) {
  $booking = json_decode($_POST['booking']);
  foreach ($booking as $value) {
    $query = $db->prepare("INSERT INTO booking (dorm_id,floor_id,room_id,member_id,booking_date,time_booking,booking_status)
                           VALUES (:dorm_id,:floor_id,:room_id,:member_id, :booking_date, :time_booking, :booking_status)");
    $result=$query->execute([
      "dorm_id"=>$value->dorm_id,
      "floor_id"=>$value->floor_id,
      "room_id"=>$value->room_id,
      "member_id"=>$value->member_id,
      "booking_date"=>$date,
      "time_booking"=>$time,
      "booking_status"=>2
    ]);
    if ($result) {
      echo json_encode(array('status'=>'success','message'=>'จองหอพักเรียบร้อย'));
    }else {
      echo json_encode(array('status'=>'errors','message'=>'ผิดพลาด'));
    }
  } // foreach

}

?>
