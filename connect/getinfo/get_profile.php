<?php
require_once("../../libs/Db.php");

$query = $db->prepare("SELECT * FROM member_dp WHERE member_dp.member_id = :id");
$query->execute([
  "id"=>$_GET["id"]
]);
if($query->rowCount() > 0){
  while($row = $query->fetch(PDO::FETCH_OBJ)){
      $data[]=$row;
  }

}
print(json_encode(array('data' => $data)));
?>
