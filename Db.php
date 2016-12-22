<?php
$db_host = '185.28.20.231'; // Sever database
$db_name = 'u419451405_dorm1'; // ฐานข้อมูล
$db_user = 'u419451405_root1'; // ชื่อผู้ใช้
$db_pass = '123456'; // รหัสผ่าน
$db = null;

try { // ให้พยายามทำงานคำสั่งต่อไปนี้
  $db = new PDO("mysql:host=$db_host; dbname=$db_name", $db_user, $db_pass);
  $db->exec("SET CHARACTER SET utf8"); // ให้รองรับภาษาไทย
  //echo "ติดต่อฐานข้อมูลได้แล้ว เย้!";
}catch (PDOException $e) { //กรณีทำงานผิดพลาด
  echo "พบปัญหา : ".$e->getMessage(); //แสดง Error
}

 ?>
