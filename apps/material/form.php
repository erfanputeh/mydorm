<?php
if($isNewRecord){
  $record=[
    'material_name'=>'',
    'amount'=>'',
  ];
}else{
  $query = $db->prepare("SELECT * FROM material WHERE material.material_id=:id");
  $query->execute([
    'id'=>$_GET['id']
  ]);
  if($query->rowCount()>0){
    $data = $query->fetch(PDO::FETCH_OBJ);
    $record=[
      'material_name'=>$data->material_name,
      'amount'=>$data->amount,
    ];
  }
}
 ?>

<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
           <div class="box-header with-border">
              <h3 class="box-title">อุปกรณ์ภายในหอพัก</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
          <!-- /.box-header -->
          <!-- form start -->
        <div class="box-body">
            <tr><td><a href="javascript:history.back();"> <i class='fa fa-fast-backward '></i></a></td></tr>
          <form action="" method="post" role="form" class="form-horizontal">
            <div class="box-body">

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">ชื่ออุปกรณ์</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" class="form-control" id="material_name" name="material_name"
                  value="<?=$record['material_name']?>">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">จำนวน</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" class="form-control" id="amount" name="amount"
                   value="<?=$record['amount']?>">
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
        </div>
        </div>
      </section>
