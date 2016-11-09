<?php
require_once('../../libs/Db.php');
$query = $db->prepare("SELECT * FROM member_dp WHERE username = :user AND password = :pass ");
$query->execute([

  'user'=>$_POST['username'],
  'pass'=>$_POST['password'],

]);
if($query->rowCount()>0){ #กรณีมีค่ามากว่า 0 = ล็อกอินผ่าน
  $data = $query->fetch(PDO::FETCH_OBJ);//อ่านข้อมูลแถวนั้นทั้งแถว
  $query = $db->prepare("SELECT * FROM booking WHERE member_id = $data->member_id ");
  $query->execute();
  if($query->rowCount()>0){
    echo json_encode(array('status'=>'success','message'=>'ล็อกอินสำเร็จ','name' => $data->name,'surname' => $data->surname,'member_id' => $data->member_id, 'book'=>$query->rowCount()));
  }else {
    echo json_encode(array('status'=>'success','message'=>'ล็อกอินสำเร็จ','name' => $data->name,'surname' => $data->surname,'member_id' => $data->member_id, 'book'=>''));
  }
}else {
  echo json_encode(array('status'=>'errors','message'=>'ล็อกอินไม่สำเร็จ'));
}
?>
