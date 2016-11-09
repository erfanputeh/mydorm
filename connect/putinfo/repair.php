<?php
date_default_timezone_set("Asia/Bangkok");


require_once('../../libs/Db.php');
$query = $db->prepare("INSERT INTO repair (member_id, dorm_id, room_id, material_id, detail_repair, dates,time_repair, repair_status)
                       VALUES (:id ,:dorm ,:room ,:material ,:detail_repair ,:dates ,:time_repair ,:repair_status)");
$result=$query->execute([
  "id"=>$_POST["id"],
  "dorm"=>$_POST["dorm"],
  "room"=>$_POST["room"],
  "material"=>$_POST["material"],
  "detail_repair"=>$_POST["detail_repair"],
  "dates"=>date("Y-m-d"),
  "time_repair"=>date("H:i:sa"),
  "repair_status"=>2

]);
if ($result) {
  echo json_encode(array('status'=>'success','message'=>'แจ้งซ่อมเรียบร้อย'));
}else {
  echo json_encode(array('status'=>'errors','message'=>'ผิดพลาด'));
}
?>
