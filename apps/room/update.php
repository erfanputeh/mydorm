<?php

// //ดึงข้อมูลหอพักส่งมาเก็บในตัวแปร dorm
$query = $db->prepare("SELECT * FROM dorm ");//เตรียมคำสั่ง sql
$query->execute();
$dorm = $query->fetchAll(PDO::FETCH_OBJ);


if(isset($_GET['id'])){
  $query = $db->prepare("SELECT * FROM room  WHERE  room.room_id=:id");
  $query->execute(['id'=>$_GET['id']]);
  if($query->rowCount()>0){
    $data = $query->fetch(PDO::FETCH_OBJ);
    $record=[
      'dorm_id' => $data->dorm_id,
      'room_name' => $data->room_name,
      'room_status'=>$data->room_status,
    ];
  }
}


if (isset($_POST['ok'])) {
  // อัพเดตลงฐานข้อมูล
  $query = $db->prepare("UPDATE room SET
    room_status = :room_status
    WHERE room.room_id = :id ;");

  $result = $query->execute([
    "id" => $_GET["id"],
    "room_status" => $_POST["room_status"],
  ]);

  if($result){
    echo "<script>
    alert('Update Successfully');
    window.location = 'home.php?file=room/index';
    </script>";
  }else{
    echo "<script>
    alert('Save fail! '".$query->errorInfo()[2].");
    </script>";
  }
}
?>

<section class="content">
<div class="box">
  <div class="box-header with-border">
      <h3 class="box-title">แก้ไขข้อมูลห้อง</h3>
      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
        </button>
        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
      </div>
  </div>

      <form action="" method="post" role="form" class="form-horizontal" enctype="multipart/form-data">
        &nbsp;  &nbsp;<tr><a href="javascript:history.back();"> <i class='fa fa-fast-backward '></i></a></tr>

        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">หอพัก</label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" class="form-control" id="dorm_name" name="dorm_name" disabled="disabled"
             <?php foreach ($dorm as $value): ?>
               <?php if ($value->dorm_id==$record['dorm_id']) {  ?>
                  value="<?=$value->dorm_name?>"  >  <!-- input type -->
                <?php } ?>
            <?php endforeach; ?>
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">ห้องพัก</label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" class="form-control" id="room_name" name="room_name" disabled="disabled"
             value="<?=$record['room_name']?>"> <!-- input type -->
          </div>
        </div>

          <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">สถานะห้องพัก</label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="btn-group" data-toggle="buttons">

              <label class="btn btn-primary <?php if ($record['room_status']==1){ echo "active";} ?>">
                <input type="radio" name="room_status" value="1" <?php if ($record['room_status']==1){ echo "checked";} ?> > &nbsp; ห้องว่าง &nbsp;
              </label>

              <label class="btn btn-primary <?php if ($record['room_status']==2){ echo "active";} ?>">
                <input type="radio" name="room_status" value="2" <?php if ($record['room_status']==2){ echo "checked";} ?> > ห้องเต็มแล้ว &nbsp;
              </label>

            </div>
          </div>
        </div>

        <div class="ln_solid"></div>
        <div class="form-group">
          <div style="text-align:center;">
            <button type="submit" class="btn btn-success" name="ok">บันทึก</button>
            <button type="reset" class="btn btn-default">แก้ไข</button>
          </div>
        </div>
        <br>

      </form>
  </div>
</section>
