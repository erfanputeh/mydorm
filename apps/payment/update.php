<?php

// // //ดึงข้อมูลหอพักส่งมาเก็บในตัวแปร dorm
// $query = $db->prepare("SELECT * FROM dorm ");//เตรียมคำสั่ง sql
// $query->execute();
// $dorm = $query->fetchAll(PDO::FETCH_OBJ);
//
// // //ดึงข้อมูลห้องส่งมาเก็บในตัวแปร room
// $query = $db->prepare("SELECT * FROM room ");//เตรียมคำสั่ง sql
// $query->execute();
// $room = $query->fetchAll(PDO::FETCH_OBJ);

// //ดึงข้อมูลผู้ใช้ส่งมาเก็บในตัวแปร user
$query = $db->prepare("SELECT * FROM member_dp ");//เตรียมคำสั่ง sql
$query->execute();
$member = $query->fetchAll(PDO::FETCH_OBJ);


if(isset($_GET['id'])){
  $query = $db->prepare("SELECT * FROM payment  WHERE  payment.payment_id=:id");
  $query->execute(['id'=>$_GET['id']]);
  if($query->rowCount()>0){
    $data = $query->fetch(PDO::FETCH_OBJ);
    $record=[
      'member_id' => $data->member_id,
      // 'dorm_id' => $data->dorm_id,
      // 'room_id' => $data->room_id,
      'payment_status'=>$data->payment_status,
    ];
  }
}


if (isset($_POST['ok'])) {
  // อัพเดตลงฐานข้อมูล
  $query = $db->prepare("UPDATE payment SET
    payment_status = :payment_status
    WHERE payment.payment_id = :id ;");

  $result = $query->execute([
    "id" => $_GET["id"],
    "payment_status" => $_POST["payment_status"],
  ]);

  if($result){
    echo "<script>
    alert('Successfully');
    window.location = 'home.php?file=payment/index';
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
      <h3 class="box-title">ชำระเงินค่าหอพัก</h3>
      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
        </button>
        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
      </div>
  </div>

      <form action="" method="post" role="form" class="form-horizontal" enctype="multipart/form-data">
        &nbsp;  &nbsp;<tr><a href="javascript:history.back();"> <i class='fa fa-fast-backward '></i></a></tr>

        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">ชื่อ</label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" class="form-control" id="name" name="name"  disabled="disabled"
            <?php foreach ($member as $value): ?>
              <?php if ($value->member_id==$record['member_id']) {  ?>
                 value="<?=$value->name?>&nbsp;&nbsp;<?=$value->surname?>"  >  <!-- input type -->
               <?php } ?>
           <?php endforeach; ?>
          </div>
        </div>

        <!-- <div class="form-group">
          <label class="col-sm-2 control-label">Dorm name</label>
          <div class="col-sm-8">
            <input type="text" class="form-control" id="dorm_name" name="dorm_name" disabled="disabled"
             <?php foreach ($dorm as $value): ?>
               <?php if ($value->dorm_id==$record['dorm_id']) {  ?>
                  value="<?=$value->dorm_name?>"  >  <!-- input type -->
                <?php } ?>
            <?php endforeach; ?>
          </div>
        </div> -->

        <!-- <div class="form-group">
          <label class="col-sm-2 control-label">Room name</label>
          <div class="col-sm-8">
            <input type="text" class="form-control" id="room_name" name="room_name" disabled="disabled"
             <?php foreach ($room as $value): ?>
               <?php if ($value->room_id==$record['room_id']) {  ?>
                  value="<?=$value->room_name?>"  >  <!-- input type -->
                <?php } ?>
            <?php endforeach; ?>
          </div>
        </div> -->



          <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">สถานะการชำระเงิน</label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="btn-group" data-toggle="buttons">

              <label class="btn btn-primary <?php if ($record['payment_status']==1){ echo "active";} ?>">
                <input type="radio" name="payment_status" value="1" <?php if ($record['payment_status']==1){ echo "checked";} ?> > &nbsp; ชำระแล้ว &nbsp;
              </label>

              <label class="btn btn-primary <?php if ($record['payment_status']==2){ echo "active";} ?>">
                <input type="radio" name="payment_status" value="2" <?php if ($record['payment_status']==2){ echo "checked";} ?> > ยังไม่ชำระ &nbsp;
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
