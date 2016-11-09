<?php
require_once('../../libs/Db.php');
$query = $db->prepare('INSERT INTO member_dp (username,password,student_id,name,surname,faculty,major,email,address,level)
VALUES (:username,:password,:student_id,:name,:surname,:faculty,:major,:email,:address,:level)');
$result=$query->execute([
  "username"=>$_POST["username"],
  "password"=>$_POST["password"],
  "student_id"=>$_POST["student_id"],
  "name"=>$_POST["name"],
  "surname"=>$_POST["surname"],
  "faculty"=>$_POST["faculty"],
  "major"=>$_POST["major"],
  "email"=>$_POST["email"],
  "address"=>$_POST["address"],
  "level"=>2

]);
if ($result) {
  echo json_encode(array('status'=>'success','message'=>'สมัครสมาชิกเรียบร้อย'));
}else {
  echo json_encode(array('status'=>'errors','message'=>'ผิดพลาด'));
}
?>
