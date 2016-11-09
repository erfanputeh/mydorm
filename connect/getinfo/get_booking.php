<?php


require_once("../../libs/Db.php");

$query = $db->prepare("SELECT * FROM booking WHERE member_id = :member_id");
$query->execute([
  "member_id"=>$_GET["member_id"]
]);
if($query->rowCount() > 0){
  while($row = $query->fetch(PDO::FETCH_OBJ)){
      $data[]=$row;
      $status = $row->booking_status;
      $booking_id = $row->booking_id;
  }
  print(json_encode(array('data' => $data,'booking_status' => $status,'booking_id' => $booking_id)));
}else {
  print(json_encode(array('data' => null,'booking_status' => null,'booking_id' => null)));
}

?>
