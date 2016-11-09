<?php
if($isNewRecord){
  $record=[
    'floor_name'=>'',
  ];
}else{
  $query = $db->prepare("SELECT * FROM floor WHERE floor.floor_id=:id");
  $query->execute(['id'=>$_GET['id']]);
  if($query->rowCount()>0){
    $data = $query->fetch(PDO::FETCH_OBJ);
    $record=[
      'floor_name'=>$data->floor_name,
    ];
  }
}
 ?>

<section class="content">
<div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">ชั้นหอพัก</h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->

          <form action="" method="post" role="form" class="form-horizontal" enctype="multipart/form-data">
            <div class="box-body">

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">ชั้นหอพัก</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" class="form-control" id="floor_name" name="floor_name"
                  value="<?=$record['floor_name']?>" placeholder="ชั้นหอพัก">
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
