<?php
require_once('../../libs/Db.php');
if (isset($_GET["id"])) {
$objective_dir = "../../images/slip/";
$tmp_name = $_FILES["mySlip"]["tmp_name"];
$name = $_FILES["mySlip"]["name"];

//ฟังก์ชั่นวันที่
date_default_timezone_set('Asia/Bangkok');
$date = date("Ymd")."_";
//ฟังก์ชั่นสุ่มตัวเลข
$numrand = (mt_rand());
$slip = "newslip";
//เอาชื่อไฟล์เก่าออกให้เหลือแต่นามสกุล
$type = strrchr($_FILES['mySlip']['name'],".");
//ตั้งชื่อไฟล์ใหม่โดยเอาเวลาไว้หน้าชื่อไฟล์เดิม
$newfilename = $date.$slip.$numrand.$type;
$path_copy = $objective_dir.$newfilename;

  if(move_uploaded_file($tmp_name,$path_copy)){ // ย้ายรูปสลิปไปที่ Server
      $query = $db->prepare("UPDATE payment SET slip = :slip WHERE payment.payment_id = :id ;");
      $result = $query->execute([
          "id" => $_GET["id"],
          "slip" => $newfilename
       ]);
  }
}
 ?>
