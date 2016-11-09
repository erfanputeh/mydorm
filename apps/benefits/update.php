<?php

//ดึงข้อมูลหอพักมาแสดง
$query = $db->prepare("SELECT * FROM dorm ");
$query->execute();
$dorm = $query->fetchAll(PDO::FETCH_OBJ);

//print_r($_POST);
if(isset($_POST['save'])){
  $query = $db->prepare('UPDATE benefits SET
    dorm_id = :dorm_id,
    benefits_name = :benefits_name,
    benefits_category = :benefits_category,
    -- detail_benefits = :detail_benefits,
    WHERE benefits.benefits_id = :id');

  $result = $query->execute([
    'id'=>$_GET['id'],
    'dorm_id'=>$_POST['dorm_id'],
    'benefits_name'=>$_POST['benefits_name'],
    // 'benefits_category'=>$_POST['benefits_category'],
    'detail_benefits'=>$_POST['detail_benefits'],

  ]);
  if($result){
echo "<script>alert('Success!')
window.location = 'home.php?file=benefits/index';
</script>";
  }else{
    echo "<script>alert('Failed!')
    window.location =  echo $query->errorInfo()[2];
    </script>";
    // echo $query->errorInfo()[2];
  }
}$isNewRecord = false;
  if($isNewRecord){
    $record=[
      'benefits_id'=>'',
      'benefits_name'=>'',
      // 'benefits_category'=>'',
      'detail_benefits'=>'',

    ];
  }else{

    $query = $db->prepare("SELECT * FROM benefits WHERE benefits.benefits_id =:id");
    $query->execute(['id'=>$_GET['id']]);
    if($query->rowCount()>0){
      $data = $query->fetch(PDO::FETCH_OBJ);
      $record=[
        'benefits_id'=>$data->benefits_id,
        'dorm_id'=>$data->dorm_id,
        'benefits_name'=>$data->benefits_name,
        // 'benefits_category'=>$data->benefits_category,
        'detail_benefits'=>$data->detail_benefits,
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
                <label class="control-label col-md-3 col-sm-3 col-xs-12">หอพัก/label>
                <div class="col-md-7 col-sm-7 col-xs-10">
                  <select class="form-control"  name="dorm_id">
                    <option>-เลือกหอพัก-</option>
                     <?php foreach ($dorm as $value): ?>
                       <?php
                        $s='';
                       if($record['dorm_id']==$value->dorm_id){
                        // $s='';
                        // $s='+1';
                         $s = 'selected';
                       }
                       ?>
                      <option value="<?=$value->dorm_id?>" <?=$s?>> <?=$value->dorm_name?></option>
                     <?php endforeach; ?>
                </select>
                </div>
            </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">สวัสดิการหอพัก</label>
                <div class="col-md-7 col-sm-7 col-xs-10">
                  <input type="text" class="form-control" id="benefits_name" name="benefits_name"
                   placeholder="ชื่อสวัสดิการ" value="<?=$data->benefits_name?>">
                </div>
              </div>

              <!-- <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Benefits Category</label>
                <div class="col-md-7 col-sm-7 col-xs-10">
                  <input type="text" class="form-control" id="benefits_category" name="benefits_category"
                   placeholder="ประเภทสวัสดิการ" value="<?=$data->benefits_category?>">
                </div>
              </div> -->

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">รายละเอียดสวัสดิการหอพัก</label>
                <div class="col-md-7 col-sm-7 col-xs-10">
                  <input type="text" class="form-control" id="detail_benefits" name="detail_benefits"
                   placeholder="รายละเอียดสวัสดิการ" value="<?=$data->detail_benefits?>">
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
