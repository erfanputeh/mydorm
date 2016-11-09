<?php
if(isset($_GET['id'])){

  $query = $db->prepare("DELETE FROM material WHERE material.material_id = :id");
  $result = $query->execute([
    "id" => $_GET['id'],
  ]);
  if($result){
    echo "<script>
            alert('Delete Success!');
            window.location = 'home.php?file=material/index';
          </script>";
  }else{
    echo "Delet fail!";
  }
}
// echo $_GET['id'];
?>
