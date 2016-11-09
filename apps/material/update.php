<?php

//print_r($_POST);
if(isset($_POST['save'])){
  $query = $db->prepare('UPDATE material SET
      material_name = :material_name,
      amount = :amount
     WHERE material.material_id = :id');
  $res = $query->execute([
    'id'=>$_GET['id'],
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

  $isNewRecord = false;

  include("form.php");
?>
