<?php

if($isNewRecord){
  $record=[
    'dorm_name'=>'',
    'activity_name'=>'',
    'detail_activity'=>'',
    'activity_picture'=>'',
    'newactivity_picture'=>'',
  ];

  //ดึงข้อมูลหอพักมาแสดง
  $query = $db->prepare("SELECT * FROM dorm ");
  $query->execute();
  $dorm = $query->fetchAll(PDO::FETCH_OBJ);

}else{
  //ดึงข้อมูลหอพักมาแสดง
  $query = $db->prepare("SELECT * FROM dorm ");
  $query->execute();
  $dorm = $query->fetchAll(PDO::FETCH_OBJ);


  //ดึงข้อมูลห้องมาแสดง
  $query = $db->prepare("SELECT * FROM activity INNER JOIN dorm ON activity.dorm_id=dorm.dorm_id
                         WHERE activity.activity_id=:id");
  $query->execute(['id'=>$_GET['id']]);
  if($query->rowCount()>0){
    $data = $query->fetch(PDO::FETCH_OBJ);
    $record=[
      'dorm_name'=>$data->dorm_name,
      'activity_name'=>$data->activity_name,
      'detail_activity'=>$data->detail_activity,
      'activity_picture'=>$data->activity_picture,
      'newactivity_picture'=>$data->newactivity_picture,
    ];
  }
}
 ?>

<section class="content">
<div class="box">
    <div class="box-header with-border">
            <h3 class="box-title">กิจกรรมหอพัก</h3>
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
                <label class="control-label col-md-3 col-sm-3 col-xs-12">ชื่อกิจกรรม</label>
                <div class="col-md-7 col-sm-7 col-xs-10">
                  <input type="text" class="form-control" id="activity_name" name="activity_name"
                  value="<?=$record['activity_name']?>" placeholder="ชื่อกิจกรรม">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">รายละเอียดกิจกรรม</label>
                <div class="col-md-7 col-sm-7 col-xs-10">
                  <textarea type="text" class="form-control" id="detail_activity" name="detail_activity"
                  value="<?=$record['detail_activity']?>" placeholder="รายละเอียดกิจกรรม"></textarea>
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">รูปกิกรรม <span class="required">*</span>
                </label>
                <div class="col-md-7 col-sm-7 col-xs-10">
                  <input type="file" name="activity_picture" required="required"  accept="image/*">
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
