<?php
require_once("../../libs/Db.php");

$query = $db->prepare("SELECT * FROM room WHERE room_id = :id ");
$query->execute([
  "id"=>$_GET["id"]
]);
if($query->rowCount() > 0){
  while($row = $query->fetch(PDO::FETCH_OBJ)){
      $data[]=$row;
      $status = $row->room_status;
  }
}
print(json_encode(array('data' => $data,'room_status' => $status)));

?>
