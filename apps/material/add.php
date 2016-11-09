<?php

//print_r($_POST);
if(isset($_POST['save'])){
  $query = $db->prepare('INSERT INTO Material (material_name,amount) VALUES (:material_name,:amount)');
  $res = $query->execute([
    'material_name'=>$_POST['material_name'],
    'amount'=>$_POST['amount'],
  ]);
  if($res){
    echo "<script>alert('Success!')
    window.location = 'home.php?file=material/index';
    </script>";
    //header("location: home.php?file=material/index");
  }else{
    echo $query->errorInfo()[2];
  }
}

$isNewRecord = true;

include_once('form.php');
?>
