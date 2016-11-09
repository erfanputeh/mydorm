<?php
require_once("../../libs/Db.php");

$query = $db->prepare("SELECT * FROM repair
                      INNER JOIN member_dp ON (repair.member_id=member_dp.member_id)
                      WHERE repair.member_id = :id ");
$query->execute([
  "id"=>$_GET["id"]
]);
if($query->rowCount() > 0){
  while($row = $query->fetch(PDO::FETCH_OBJ)){
      $data[]=$row;
      $status = $row->repair_status;
  }
  print(json_encode(array('data' => $data,'repair_status' => $status,'repair'=> $query->rowCount())));
}else {
  print(json_encode(array('data' => '', 'repair' =>'')));
}

?>
