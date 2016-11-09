<?php
require_once("../../libs/Db.php");

$query = $db->prepare("UPDATE notifications SET notifi_status = :notifi_status
                      WHERE notifications.notifi_id = :member_id ");
$result = $query->execute([
  "member_id" => $_GET["member_id"],
  "notifi_id" =>2,
]); // รัน sql
if($result){
 echo json_encode(array('status' => 'success','message' => 'อ่านแล้ว'));
}else {
echo json_encode(array('status' => 'success','message' => 'ผิดพลาด'));
}
