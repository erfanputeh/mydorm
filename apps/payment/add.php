
<?php

//print_r($_POST);
if(isset($_POST['save'])){
  $query = $db->prepare('INSERT INTO payment (slip,dates) VALUES (:slip,:dates) ');
  $res = $query->execute([
    'slip'=>$_POST['slip'],
    'dates'=>$_POST['dates'],
  ]);
  if($res){
    echo "<script>alert('Success!')
    window.location = 'home.php?file=payment/index';
    </script>";
    //header("location: home.php?file=repair/index");
  }else{
    echo $query->errorInfo()[2];
  }
}

$isNewRecord = true;

include_once('form.php');
?>
