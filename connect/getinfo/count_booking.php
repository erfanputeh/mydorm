<?php
require_once("../../libs/Db.php");

$query = $db->prepare("SELECT * FROM booking WHERE room_id = :id ");
$query->execute([
  "id"=>$_GET["id"]
]);
if($query->rowCount() > 0){

      $data[]=$query->rowCount();

}else {
$data[]=0;
}
print(json_encode($data));

?>
