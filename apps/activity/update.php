<?php

//ดึงข้อมูลหอพักมาแสดง
$query = $db->prepare("SELECT * FROM dorm ");
$query->execute();
$dorm = $query->fetchAll(PDO::FETCH_OBJ);


// print_r($_POST);
if(isset($_POST['save'])){
  $query = $db->prepare('UPDATE activity SET
    dorm_id = :dorm_id,
    activity_name = :activity_name,
    detail_activity = :detail_activity
    WHERE activity.activity_id = :id');

  $result = $query->execute([
    'id'=>$_GET['id'],
    'dorm_id'=>$_POST['dorm_id'],
    'activity_name'=>$_POST['activity_name'],
    'detail_activity'=>$_POST['detail_activity']
  ]);
  if($result){
echo "<script>alert('Success!')
      window.location = 'home.php?file=activity/index';
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
      'activity_id'=>'',
      'activity_name'=>'',
      'detail_activity'=>'',

    ];
  }else{

    $query = $db->prepare("SELECT * FROM activity WHERE activity.activity_id =:id");
    $query->execute(['id'=>$_GET['id']]);
    if($query->rowCount()>0){
      $data = $query->fetch(PDO::FETCH_OBJ);
      $record=[
        'activity_id'=>$data->activity_id,
        'dorm_id'=>$data->dorm_id,
        'activity_name'=>$data->activity_name,
        'detail_activity'=>$data->detail_activity,
      ];
    }


  }
?>

<section class="content">
<div class="box">
    <div class="box-header with-border">
            <h3 class="box-title">กิจกรรมหอพัก</h3>
          </div>

          <form action="" method="post" role="form" class="form-horizontal" enctype="multipart/form-data">
            <div class="box-body">

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">หอพัก</label>
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
                <label class="control-label col-md-3 col-sm-3 col-xs-12">ชื่อกิจกรรม</label>
                <div class="col-md-7 col-sm-7 col-xs-10">
                  <input type="text" class="form-control" id="activity_name" name="activity_name"
                   placeholder="ชื่อกิจกรรม" value="<?=$data->activity_name?>">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">รายละเอียดกิจกรรม</label>
                <div class="col-md-7 col-sm-7 col-xs-10">
                  <input type="text" class="form-control" id="detail_activity" name="detail_activity"
                   placeholder="รายละเอียดกิจกรรม" value="<?=$data->detail_activity?>">
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
