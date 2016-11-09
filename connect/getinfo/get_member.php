<?php
require_once("../../libs/Db.php");

$query = $db->prepare("SELECT * FROM booking INNER JOIN member_dp ON (booking.member_id=member_dp.member_id)
                       WHERE booking.member_id = :id");
$query->execute([
  "id"=>$_GET["id"]
]);
if($query->rowCount() > 0){
  while($row = $query->fetch(PDO::FETCH_OBJ)){
      $data[]=$row;
      // $member = $row->member_id;
      $dorm = $row->dorm_id;
      $room = $row->room_id;
      $faculty = $row->faculty;
      $major = $row->major;
      $email = $row->email;
  }
  print(json_encode(array('data' => $data, 'dorm_id' => $dorm, 'room_id' => $room,
  'faculty' => $faculty, 'major' => $major, 'email' => $email)));
}


?>
