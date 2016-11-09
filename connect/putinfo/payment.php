<?php
date_default_timezone_set("Asia/Bangkok");
require_once('../../libs/Db.php');
$query = $db->prepare('INSERT INTO payment (member_id, booking_id, payment_date ,time_payment, payment_status)
                       VALUES (:id, :booking_id, :payment_date, :time_payment, :payment_status)');
$result=$query->execute([
  "id"=>$_POST["id"],
  "booking_id"=>$_POST["booking_id"],
  "payment_date"=>date("Y-m-d"),
  "time_payment"=>date("H:i:sa"),
  "payment_status"=>2
]);
$payment_id = $db->lastInsertId();
if ($result) {
  echo json_encode(array('status'=>'success','message'=>'ชำระเงินเรียบร้อย','payment'=> $payment_id));
}else {
  echo json_encode(array('status'=>'errors','message'=>'ผิดพลาด'));
}

?>
