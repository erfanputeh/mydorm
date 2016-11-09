<?php
require_once("../../libs/Db.php");

$query = $db->prepare("SELECT * FROM repair WHERE repair.member_id = :id ");
$query->execute([
  "id"=>$_GET["id"]
]);
if($query->rowCount() > 0){
  while($row = $query->fetch(PDO::FETCH_OBJ)){
      $status = $row->repair_status;
  }
}
print(json_encode(array('repair_status' => $status)));

?>
