<?php
require_once("../../libs/Db.php");

$query = $db->prepare("SELECT * FROM material_detail
                       INNER JOIN material ON (material_detail.material_id = material.material_id)
                       WHERE material_detail.dorm_id = :dorm_id");
$query->execute([
  "dorm_id"=>$_GET["dorm_id"]
]);
if($query->rowCount() > 0){
  while($row = $query->fetch(PDO::FETCH_OBJ)){
       $material[] = $row;
  }
  print(json_encode(array('material' => $material)));
}

?>
