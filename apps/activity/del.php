<?php
if(isset($_GET['id'])){

  $query = $db->prepare("DELETE FROM activity WHERE activity.activity_id= :id");
  $result = $query->execute([
    "id" => $_GET['id'],
  ]);
  if($result){
    echo "<script>
            alert('Delete Success!');
            window.location = 'home.php?file=activity/index';
          </script>";
  }else{
    echo "Delet fail!";
  }
}
// echo $_GET['id'];
?>
