<?php
if(isset($_POST['save'])){
  $objective_dir = "C:/xampp/htdocs/mydorm/images/room/";
  $objective_file = $objective_dir . basename($_FILES["room_picture"]["name"]);
  $uploadsuccess = 1;
  $pictureFileType = pathinfo($objective_file,PATHINFO_EXTENSION);

  //ฟังก์ชั่นวันที่
  date_default_timezone_set('Asia/Bangkok');
  $date = date("Ymd");
  //ฟังก์ชั่นสุ่มตัวเลข
  $numrand = (mt_rand());
  //เอาชื่อไฟล์เก่าออกให้เหลือแต่นามสกุล
  $type = strrchr($_FILES['room_picture']['name'],".");
  //ตั้งชื่อไฟล์ใหม่โดยเอาเวลาไว้หน้าชื่อไฟล์เดิม
  $newfilename = $date.$numrand.$type;
  $path_copy = $objective_dir.$newfilename;

  $check = getimagesize($_FILES["room_picture"]["tmp_name"]);
  if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadsuccess = 1;
  } else {
    echo "File is not an image.";
    $uploadsuccess = 0;
  }

  // เช็คไฟล์เมื่อไฟล์นั่นมีอยู่แล้ว
  if (file_exists($objective_file)) {
      echo "Sorry, file already exists.";
      $uploadsuccess = 0;
  }
  // เช็คขนาดรูป
  if ($_FILES["room_picture"]["size"] > 5000000) {
      echo "Sorry, your file is too large.";
      $uploadsuccess = 0;
  }
  // อนุญาติไฟล์ชนิดใดบ้างที่สามารถใช้ได้
  //
  if($pictureFileType != "jpg" && $pictureFileType != "png" && $pictureFileType != "gif" && $pictureFileType != "jpeg" && $pictureFileType != "JPG" && $pictureFileType != "PNG" ) {
      echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
      $uploadsuccess = 0;
  }
  // Check if $uploadOk is set to 0 by an error
  if ($uploadsuccess == 0) {
      echo "Sorry, your file was not uploaded.";
  // if everything is ok, try to upload file
  } else {
      if (move_uploaded_file($_FILES["room_picture"]["tmp_name"], $path_copy)) {
            //echo "The file ". basename( $_FILES["picture"]["name"]). " has been uploaded.";
          // เพิ่มลงฐานข้อมูล
  $query = $db->prepare('INSERT INTO room (room_name ,dorm_id , floor_id , room_picture , newroom_picture , amount_bed , room_status)
  VALUES (:room_name,:dorm_name,:floor_name,:room_picture,:newroom_picture,:amount_bed,:room_status)');
  $res = $query->execute([

    'room_name'=>$_POST['room_name'],
    'dorm_name'=>$_POST['dorm_name'],
    'floor_name'=>$_POST['floor_name'],
    'room_picture'=>$_FILES['room_picture']['name'],
    "newroom_picture"=> $newfilename,
    'amount_bed'=>$_POST['amount_bed'],
    'room_status'=>$_POST['room_status']
  ]);
  if($res){
    echo "<script>alert('Success!')
    window.location = 'home.php?file=room/index';
    </script>";
  }else{
    echo $query->errorInfo()[2];
    }
  }
}
}


$isNewRecord = true;

include_once('form.php');
?>
