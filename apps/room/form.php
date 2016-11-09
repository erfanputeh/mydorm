<?php
$status = require('room_status.php');

if($isNewRecord){
  $record=[
    'dorm_name'=>'',
    'floor_name'=>'',
    'room_name'=>'',
    'room_picture'=>'',
    'newroom_picture'=>'',
    'amount_bed'=>'',
    'room_status'=>'',
  ];

  //ดึงข้อมูลหอพักมาแสดง
  $query = $db->prepare("SELECT * FROM dorm ");
  $query->execute();
  $dorm = $query->fetchAll(PDO::FETCH_OBJ);

  //ดึงข้อมูลชั้น
  // $query = $db->prepare("SELECT * FROM dorm_detail ");
  // $query->execute();
  // $dorm_detail = $query->fetchAll(PDO::FETCH_OBJ);

  $query = $db->prepare("SELECT * FROM floor ");
  $query->execute();
  $floor = $query->fetchAll(PDO::FETCH_OBJ);

}else{
  //ดึงข้อมูลหอพักมาแสดง
  $query = $db->prepare("SELECT * FROM dorm ");
  $query->execute();
  $dorm = $query->fetchAll(PDO::FETCH_OBJ);

  // //ดึงข้อมูลห้องมาแสดง
  // $query = $db->prepare("SELECT * FROM room ");
  // $query->execute();
  // $room = $query->fetchAll(PDO::FETCH_OBJ);



  //ดึงข้อมูลห้องมาแสดง
  $query = $db->prepare("SELECT * FROM room INNER JOIN dorm ON (room.dorm_id=dorm.dorm_id)
                        (INNER JOIN dorm ON room.dorm_id=dorm.dorm_id)
                        (INNER JOIN floor ON room.floor_id=floor.floor_id)
                         WHERE room.room_id=:id");
  $query->execute(['id'=>$_GET['id']]);
  if($query->rowCount()>0){
    $data = $query->fetch(PDO::FETCH_OBJ);
    $record=[
      'dorm_name'=>$data->dorm_name,
      'floor_name'=>$data->floor_name,
      'room_name'=>$data->room_name,
      'room_picture'=>$data->room_picture,
      'newroom_picture'=>$data->room_picture,
      'amount_bed'=>$data->amount_bed,
      'room_status'=>$status[$data->room_status],
    ];
  }
}
 ?>

<script  type="text/javascript">
function check(dorm_name) {
  if (dorm_name.value=="1") {
      document.froms[0].floor_name.disabled=true;
  }else {
      document.froms[0].floor_name.disabled=false;
  }

}
</script>


<section class="content">
<div class="box">
    <div class="box-header with-border">
            <h3 class="box-title">ห้องพัก</h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->

          <form action="" method="post" role="form" class="form-horizontal" enctype="multipart/form-data">
            <div class="box-body">

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">หอพัก</label>
                <div class="col-md-7 col-sm-7 col-xs-10">
                  <select class="form-control" name="dorm_name" onchange="check(this);">
                    <option>เลือกหอพัก</option>
                    <?php foreach ($dorm as $value): ?>
                    <option  value="<?=$value->dorm_id?>"><?=$value->dorm_name?></option>
                  <?php endforeach; ?>
                  </select>
                </div>
            </div>

            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">ชั้นหอพัก</label>
              <div class="col-md-7 col-sm-7 col-xs-10">
                <select class="form-control" name="floor_name">
                  <option>เลือกชั้นหอพัก</option>
                  <?php foreach ($floor as $value): ?>
                  <option  value="<?=$value->floor_id?>"> <?=$value->floor_name?></option>
                <?php endforeach; ?>
                </select>
              </div>
            </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">ห้องพัก</label>
                <div class="col-md-7 col-sm-7 col-xs-10">
                  <input type="text" class="form-control" id="room_name" name="room_name"
                  value="<?=$record['room_name']?>" placeholder="ชื่อห้อง">
                </div>
              </div>


              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">จำนวนเตียง</label>
                <div class="col-md-7 col-sm-7 col-xs-10">
                  <input type="text" class="form-control" id="amount_bed" name="amount_bed"
                   value="<?=$record['amount_bed']?>" placeholder="จำนวนเตียง">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">สถานะห้องพัก</label>
                <div class="col-md-7 col-sm-7 col-xs-10">

                  <input type="text" class="form-control" id="status" name="room_status"
                   value="<?=$record['room_status']?>" placeholder="สถานะห้อง">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">รูปห้องพัก <span class="required">*</span>
                </label>
                <div class="col-md-7 col-sm-7 col-xs-10">
                  <input type="file" name="room_picture" required="required"  accept="image/*">
                </div>
              </div>

            </div>
            <!-- /.box-body -->
            <div class="ln_solid"></div>
            <div class="form-group">
              <div style="text-align:center;">
                <button type="submit" class="btn btn-primary" name="save">บันทึก</button>
                <button type="reset" class="btn btn-default">แก้ไข</button>
              </div>
            </div>
            <br>
            <!-- /.box-footer -->
          </form>
        </div>
      </section>
