<?php
require_once("../../libs/Db.php");
$i=0;

$query = $db->prepare("SELECT * FROM notifications
                      INNER JOIN member_dp ON (notifications.member_id = member_dp.member_id)
                      INNER JOIN booking ON (notifications.booking_id = booking.booking_id)
                      WHERE notifications.member_id = :member_id AND notifications.notifi_status = 1  ORDER BY notifications.notifi_id DESC");
$query->execute([
  "member_id" => $_GET["member_id"]
]); // รัน sql
if($query->rowCount() > 0){
  while($row = $query->fetch(PDO::FETCH_OBJ)){
      $data[]=$row;
      if($row->notifi_status == 1){
        $i++;
      }
  }
  print(json_encode(array('data' => $data,'notifications' => $query->rowCount(), 'numbers' => $i)));
}else {
  print(json_encode(array('data' => '','notifications' => '', 'numbers' => '')));
}
