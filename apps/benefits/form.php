<?php

if($isNewRecord){
  $record=[
    'dorm_name'=>'',
    'benefits_name'=>'',
    'detail_benefits'=>'',
    'benefits_picture'=>'',
    'newbenefits_picture'=>'',
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
  $query = $db->prepare("SELECT * FROM benefits INNER JOIN dorm ON benefits.dorm_id=dorm.dorm_id
                         WHERE benefits.benefits_id=:id");
  $query->execute(['id'=>$_GET['id']]);
  if($query->rowCount()>0){
    $data = $query->fetch(PDO::FETCH_OBJ);
    $record=[
      'benefits_name'=>$data->benefits_name,
      'dorm_name'=>$data->dorm_name,
      'detail_benefits'=>$data->detail_benefits,
      'benefits_picture'=>$data->benefits_picture,
      'newbenefits_picture'=>$data->newbenefits_picture,
    ];
  }
}
 ?>

<section class="content">
<div class="box">
    <div class="box-header with-border">
            <h3 class="box-title">สวัสดิการหอพัก</h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->

          <form action="" method="post" role="form" class="form-horizontal" enctype="multipart/form-data">
            <div class="box-body">

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">สวัสดิการหอพัก</label>
                <div class="col-md-7 col-sm-7 col-xs-10">
                  <input type="text" class="form-control" id="benefits_name" name="benefits_name"
                  value="<?=$record['benefits_name']?>" placeholder="ชื่อสวัสดิการ">
                </div>
              </div>

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
              <label class="control-label col-md-3 col-sm-3 col-xs-12">ประเภทสวัสดิการหอพัก</label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <select class="form-control" name="benefits_category">
                  <option>ประเภทสวัสดิการหอพัก</option>
                  <option  value="ภายในหอพัก">ภายในหอพัก</option>
                  <option  value="ภายนอกหอพัก">ภายนอกหอพัก</option>
                </select>
              </div>
          </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">รายละเอียดสวัสดิการหอพัก</label>
                <div class="col-md-7 col-sm-7 col-xs-10">
                  <textarea type="text" class="form-control" id="detail_benefits" name="detail_benefits"
                  value="<?=$record['detail_benefits']?>" placeholder="รายละเอียดสวัสดิการ"></textarea>
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">รูปสวัสดิการหอพัก <span class="required">*</span>
                </label>
                <div class="col-md-7 col-sm-7 col-xs-10">
                  <input type="file" name="benefits_picture" required="required"  accept="image/*">
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
