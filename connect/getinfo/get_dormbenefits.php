<?php
require_once("../../libs/Db.php");

$query = $db->prepare("SELECT * FROM dorm");
$query->execute();
if($query->rowCount() > 0){
  while($row = $query->fetch(PDO::FETCH_OBJ)){
      $data[]=$row;
  }
}
print(json_encode(array('data' => $data)));

?>
