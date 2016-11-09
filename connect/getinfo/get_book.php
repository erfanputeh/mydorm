<?php

require_once("../../libs/Db.php");

$query = $db->prepare("SELECT * FROM booking  INNER JOIN dorm ON (booking.dorm_id=dorm.dorm_id)
                      INNER JOIN room ON (booking.room_id=room.room_id)
                      INNER JOIN member_dp ON (booking.member_id=member_dp.member_id)
                      INNER JOIN floor ON (booking.floor_id=floor.floor_id)
                      WHERE booking.member_id = :id");
$query->execute([
  "id"=>$_GET["id"]
]);
if($query->rowCount() > 0){
  while($row = $query->fetch(PDO::FETCH_OBJ)){
      $data[]=$row;
      $dorm = $row->dorm_id;
      $floor = $row->floor_id;
      $room = $row->room_id;
      $date = $row->booking_date;
      $status = $row->booking_status;

  }
    print(json_encode(array('data' => $data , 'dorm_id' => $dorm , 'floor_id' => $floor , 'room_id' => $room , 'date' => $date , 'booking_status' => $status ,'book'=> $query->rowCount())));
}else{
    print(json_encode(array('data' => '', 'book' =>'')));
}

?>
