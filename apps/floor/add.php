<?php
if(isset($_POST['save'])){
          // เพิ่มลงฐานข้อมูล
        $query = $db->prepare('INSERT INTO floor
              (floor_name)
        VALUES
              (:floor_name)
        ');
        $res = $query->execute([

          "floor_name"=>$_POST["floor_name"]

          ]);
        if($res){
            echo "<script>alert('Success!')
            window.location = 'home.php?file=floor/index';
            </script>";
            //header("location: home.php?file=repair/index");
          }else{
            echo $query->errorInfo()[2];
            }
        }



$isNewRecord = true;

include_once('form.php');
?>
