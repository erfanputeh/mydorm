<?php
if($isNewRecord){
  $record=[
    'dorm_name'=>'',
    'floor_amout'=>'',
    'room_amout'=>'',
    'dorm_category'=>'',
    'price'=>'',
    'picture'=>'',
    'pic_dorm'=>'',
  ];
}else{
  $query = $db->prepare("SELECT * FROM dorm WHERE dorm.dorm_id=:id");
  $query->execute(['id'=>$_GET['id']]);
  if($query->rowCount()>0){
    $data = $query->fetch(PDO::FETCH_OBJ);
    $record=[
      'dorm_name'=>$data->dorm_name,
      'floor_amout'=>$data->floor_amout,
      'room_amout'=>$data->room_amout,
      'dorm_category'=>$data->dorm_category,
      'price'=>$data->price,
      'picture'=>$data->picture,
      'pic_dorm'=>$data->pic_dorm,
    ];
  }
}
 ?>

<section class="content">
<div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">หอพัก</h3>
            <br><tr><a href="javascript:history.back();"> <i class='fa fa-fast-backward '></i></a></tr>
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
              </button>
              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
          </div>
          <!-- /.box-header -->
          <!-- form start -->

          <form action="" method="post" role="form" class="form-horizontal" enctype="multipart/form-data">
            <div class="box-body">

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">หอพัก</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <select class="form-control" name="dorm_name">
                    <option>เลือกหอพัก</option>
                    <option  value="หอพัก 5">หอพัก 5 </option>
                    <option  value="หอพัก 6">หอพัก 6 </option>
                    <option  value="หอพัก 7 ">หอพัก 7 </option>
                    <option  value="หอพัก 8">หอพัก 8 </option>
                    <option  value="หอพัก 9">หอพัก 9 </option>
                    <option  value="หอพัก 10">หอพัก 10 </option>
                  </select>
                </div>
            </div>


              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">จำนวนชั้น</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" class="form-control" id="floor_amout" name="floor_amout"
                  value="<?=$record['floor_amout']?>" placeholder="จำนวนชั้น">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">จำนวนห้องพัก</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" class="form-control" id="room_amout" name="room_amout"
                   value="<?=$record['room_amout']?>" placeholder="จำนวนห้องพัก">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">ประเภทหอพัก</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <select class="form-control" name="dorm_category">
                    <option>เลือกประเภทหอพัก</option>
                    <option value="หอพักชาย">หอพักชาย</option>
                    <option value="หอพักหญิง">หอพักหญิง</option>
                  </select>
                </div>
            </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">ราคาหอพัก</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" class="form-control" id="price" name="price"
                   value="<?=$record['price']?>" placeholder="ราคาหอพัก">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">รูปหอพัก <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="file" name="picture" required="required"  accept="image/*">
                </div>
              </div>

            </div>
            <!-- /.box-body -->
            <div class="form-group">
              <div style="text-align:center;">
                <button type="submit" class="btn btn-success" name="ok">บันทึก</button>
                <button type="reset" class="btn btn-default">แก้ไข</button>
              </div>
            </div>
            <br>
            <!-- /.box-footer -->
          </form>
        </div>
      </section>
