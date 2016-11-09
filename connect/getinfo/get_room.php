<?php
require_once("../../libs/Db.php");

$query = $db->prepare("SELECT * FROM room WHERE floor_id = :id AND dorm_id = :dorm_id");
$query->execute([
  "id"=>$_GET["id"],
  "dorm_id"=>$_GET["dorm_id"],


]);
if($query->rowCount() > 0){
  while($row = $query->fetch(PDO::FETCH_OBJ)){
      $data[]=$row;
  }
}
print(json_encode($data));

?>
